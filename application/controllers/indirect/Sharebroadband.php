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

    public function index()
    {
        is_logged_in();
        // $data['posts'] = $this->sharebroadband_model->getAll();
        $data = $this->userSession();
        $data += [
            'sharebroadband' => $this->sharebroadband_model->getAll($data['tdc']),
        ];
        $this->load->view('indirect/sharebroadband/list', $data);
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
            redirect(site_url('indirect/sharebroadband'));
        }
        // else if (!$validation->run())
        // {
        //     echo validation_errors();
        // }
        $data = $this->userSession();
        // $data['users'] = $this->sharebroadband_model->userList();
        $this->load->view('indirect/sharebroadband/new_form', $data);
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
        if (!isset($id)) redirect('indirect/sharebroadband');

        $sharebroadband = $this->sharebroadband_model;
        $validation = $this->form_validation;
        $validation->set_rules($sharebroadband->rules());

        if ($validation->run())
        {
            $sharebroadband->update($id);
            $this->session->set_flashdata('success', 'Berhasil diperbarui');
            redirect(site_url('indirect/sharebroadband'));
        }

        $data = $this->userSession();
        $data += [
            'sharebroadband' => $sharebroadband->getById($id),
        ];

        if (!$data['sharebroadband']) show_404();

        $this->load->view('indirect/sharebroadband/edit_form', $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->sharebroadband_model->delete($id))
        {
            redirect(site_url('indirect/sharebroadband'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['sharebroad'] = $this->sharebroadband_model->getDetail($id);
        $this->load->view('indirect/sharebroadband/detail', $data);
    }

    public function exportpdf()
    {
        $data = $this->userSession();
        $data += [
            'export' => $this->sharebroadband_model->getAll($data['tdc'])
        ];

        $this->load->view('indirect/sharebroadband/pdf_export', $data);
    }

    public function export()
    {
        $data = $this->userSession();
        $export = $this->sharebroadband_model->getAll($data['tdc']);
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
            ->setCellValue('B1', 'Kecamatan')
            ->setCellValue('C1', 'QTY Telkomsel Marketshare')
            ->setCellValue('D1', 'QTY Indosat Marketshare')
            ->setCellValue('E1', 'QTY XL Marketshare')
            ->setCellValue('F1', 'QTY Tri Marketshare')
            ->setCellValue('G1', 'QTY Smartfrend Marketshare');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , $ex->tanggal)
                ->setCellValue('B'. $i , $ex->kecamatan)
                ->setCellValue('C'. $i , $ex->qty_telkomsel_marketshare)
                ->setCellValue('D'. $i , $ex->qty_indosat_marketshare)
                ->setCellValue('E'. $i , $ex->qty_xl_marketshare)
                ->setCellValue('F'. $i , $ex->qty_tri_marketshare)
                ->setCellValue('G'. $i , $ex->qty_smartfrend_marketshare);
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