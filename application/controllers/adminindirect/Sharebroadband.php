<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Sharebroadband extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sharebroadband_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('pdf_helper');
    }

    public function userSession()
    {   
        $data = array(
            'status' => $this->session->userdata('login'),
            'access' => $this->session->userdata('access'),
            'id' => $this->session->userdata('id'),
            'user' => $this->session->userdata('user'),
            'tdc' => $this->session->userdata('tdc')
        );

        return $data;
    }

    public function index($kab=null)
    {
        is_logged_in();
        // $data['posts'] = $this->sharebroadband_model->getAll();
        $data = $this->userSession();
        $month = date('F');
        $data += [
            'sharebroadband' => $this->sharebroadband_model->displayBroadband(),
            'broadband' => $this->sharebroadband_model->chartBroadband($month),
            'kabupaten' => $this->sharebroadband_model->chartBroadbandKab($month)
        ];
        if($kab)
        {
            $kab = str_replace('%20', ' ', $kab);
            $data['kecamatan'] = $this->sharebroadband_model->chartBroadbandKec($kab, $month);
            $data['kab'] = str_replace(' ', '%20', $kab);
        }
        $this->load->view('adminindirect/sharebroadband/list', $data);
    }

    public function add()
    {
        is_logged_in();
        
        $sharebroadband = $this->sharebroadband_model;
        $validation = $this->form_validation;
        $validation->set_rules($sharebroadband->rules());   

        if ($validation->run())
        {
            $sharebroadband->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');   
            redirect(site_url('adminindirect/sharebroadband'));
        }
        // else if (!$validation->run())
        // {
        //     echo validation_errors();
        // }
        $data = $this->userSession();
        // $data['users'] = $this->sharebroadband_model->userList();
        $this->load->view('adminindirect/sharebroadband/new_form', $data);
    }

    // public function addProcess()
    // {
    //     sharebroadband = $this->sharebroadband_model;
    //     sharebroadband->save();
    //     echo "good";    

    // }

    public function edit($id=null)
    {
        is_logged_in();
        if (!isset($id)) redirect('adminindirect/sharebroadband');

        $sharebroadband = $this->sharebroadband_model;
        $validation = $this->form_validation;
        $validation->set_rules($sharebroadband->rules());

        if ($validation->run())
        {
            $sharebroadband->update($id);
            $this->session->set_flashdata('success', 'Berhasil diperbarui');
            redirect(site_url('adminindirect/sharebroadband'));
        }

        $data = $this->userSession();
        $data += [
            'sharebroadband' => $sharebroadband->getById($id),
        ];

        if (!$data['sharebroadband']) show_404();

        $this->load->view('adminindirect/sharebroadband/edit_form', $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->sharebroadband_model->delete($id))
        {
            redirect(site_url('adminindirect/sharebroadband'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['sharebroad'] = $this->sharebroadband_model->getDetail($id);
        $this->load->view('adminindirect/sharebroadband/detail', $data);
    }

    public function fetchperiode()
    {
        $post = $this->input->post();
        if (isset($post['pdf']))
        {
            $start = date('Y-m-d', strtotime($post['start']));
            $end = date('Y-m-d', strtotime($post['end']));
            $this->exportpdf($start, $end);
        }
        else if (isset($post['xls']))
        {
            $start = date('Y-m-d', strtotime($post['start']));
            $end = date('Y-m-d', strtotime($post['end']));
            $this->export($start, $end);
        }
    }

    public function exportpdf($start, $end)
    {
        $data = $this->userSession();
        $data += [
            'export' => $this->sharebroadband_model->displayBroadband($start, $end)
        ];

        $this->load->view('adminindirect/sharebroadband/pdf_export', $data);
    }

    public function export($start, $end)
    {
        $data = $this->userSession();
        $export = $this->sharebroadband_model->displayBroadband($start, $end);
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
            ->setCreator('Digimon')
            ->setLastModifiedBy($this->session->userdata('user'))
            ->setTitle('Laporan Scorecard')
            ->setSubject('Laporan Scorecard')
            ->setDescription('Eksport Scorecard')
            ->setKeywords('Scorecard')
            ->setCategory('Scorecard');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Nama TDC')
            ->setCellValue('C1', 'Kabupaten')
            ->setCellValue('D1', 'Kecamatan')
            ->setCellValue('E1', 'QTY Telkomsel Marketshare')
            ->setCellValue('F1', 'QTY Indosat Marketshare')
            ->setCellValue('G1', 'QTY XL Marketshare')
            ->setCellValue('H1', 'QTY Tri Marketshare')
            ->setCellValue('I1', 'QTY Smartfrend Marketshare');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , $ex->tanggal)
                ->setCellValue('B'. $i , $ex->nama_tdc)
                ->setCellValue('C'. $i , $ex->kecamatan)
                ->setCellValue('D'. $i , $ex->kabupaten)
                ->setCellValue('E'. $i , $ex->qty_telkomsel_marketshare)
                ->setCellValue('F'. $i , $ex->qty_indosat_marketshare)
                ->setCellValue('G'. $i , $ex->qty_xl_marketshare)
                ->setCellValue('H'. $i , $ex->qty_tri_marketshare)
                ->setCellValue('I'. $i , $ex->qty_smartfrend_marketshare);
            $i++;
        }
        
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Scorecard '.date('d-m-Y H'));
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Scorecard ' . date('d-m-Y H') . '.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

}