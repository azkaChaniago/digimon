<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Historiorder extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('historiorder_model');
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
        // $data['posts'] = $this->historiorder_model->getAll();
        $data = $this->userSession();
        $data += [
            'histori' => $this->historiorder_model->displayHistoriOrder(),
        ];
        $this->load->view('adminindirect/historiorder/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $histori = $this->historiorder_model;
        $validation = $this->form_validation;
        $validation->set_rules($histori->rules());   

        if ($validation->run())
        {
            $histori->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');   
            redirect(site_url('adminindirect/historiorder'));
        }
        else if (!$validation->run())
        {
            $this->session->set_flashdata('error', validation_errors());
        }
        $data = $this->userSession();
        $data['users'] = $this->historiorder_model->userList();
        $data['marketing'] = $this->historiorder_model->getThisTableRecord('tbl_marketing', $data['tdc']);
        $data['outlet'] = $this->historiorder_model->getThisTableRecord('tbl_outlet', $data['tdc']);
        $this->load->view('adminindirect/historiorder/new_form', $data);
    }

    // public function addProcess()
    // {
    //     $histori = $this->historiorder_model;
    //     $histori->save();
    //     echo "good";    

    // }

    public function edit($id=null)
    {
        is_logged_in();
        if (!isset($id)) redirect('adminindirect/historiorder');

        $histori = $this->historiorder_model;
        $validation = $this->form_validation;
        $validation->set_rules($histori->rules());

        if ($validation->run())
        {
            $histori->update($id);
            $this->session->set_flashdata('success', 'Berhasil diperbarui');
            redirect(site_url('adminindirect/historiorder'));
        }

        $data = $this->userSession();
        $data += [
            'histori' => $histori->getById($id),
            'users' => $histori->userList(),
            'outlet' => $histori->getThisTableRecord('tbl_outlet', $data['tdc']),
            'marketing' => $histori->getThisTableRecord('tbl_marketing', $data['tdc']),
        ];

        if (!$data['histori']) show_404();

        $this->load->view('adminindirect/historiorder/edit_form', $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->historiorder_model->delete($id))
        {
            redirect(site_url('adminindirect/historiorder'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['histori'] = $this->historiorder_model->getDetail($id);
        $this->load->view('adminindirect/historiorder/detail', $data);
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
            'histori' => $this->historiorder_model->displayHistoriOrder($start, $end)
        ];

        $this->load->view('adminindirect/historiorder/pdf_export', $data);
    }

    public function export($start, $end)
    {
        $data = $this->userSession();
        $export = $this->historiorder_model->displayHistoriOrder($start, $end);
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
            ->setCreator('Digimon')
            ->setLastModifiedBy($this->session->userdata('user'))
            ->setTitle('Laporan Target Assignment')
            ->setSubject('Laporan Target Assignment')
            ->setDescription('Eksport Target Assignment')
            ->setKeywords('Target Assignment')
            ->setCategory('Target Assignment');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Nama TDC')
            ->setCellValue('C1', 'Nama Marketing')
            ->setCellValue('D1', 'Nama Outlet')
            ->setCellValue('E1', 'Simpati')
            ->setCellValue('F1', 'AS')
            ->setCellValue('G1', 'Loop')
            ->setCellValue('H1', 'MKIOS Bulk')
            ->setCellValue('I1', 'MKIOS Reguler')
            ->setCellValue('J1', 'GT Pulsa');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'. $i , date('Y-m-d', strtotime($ex->tanggal)))
            ->setCellValue('B'. $i , $ex->nama_tdc)
            ->setCellValue('C'. $i , $ex->nama_marketing)
            ->setCellValue('D'. $i , $ex->nama_outlet)
            ->setCellValue('E'. $i , $ex->simpati)
            ->setCellValue('F'. $i , $ex->as)
            ->setCellValue('G'. $i , $ex->loop)
            ->setCellValue('H'. $i , $ex->mkios_bulk)
            ->setCellValue('I'. $i , $ex->mkios_reguler)
            ->setCellValue('J'. $i , $ex->gt_pulsa);
            $i++;
        }
        
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Histori Order '.date('d-m-Y H'));
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Histori Order' . date('d-m-Y H') . '.xlsx"');
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