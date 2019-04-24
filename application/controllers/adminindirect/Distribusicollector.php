<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Distribusicollector extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('distribusicollector_model');
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
        $data = $this->userSession();
        $data += [
            'collector' => $this->distribusicollector_model->displayTargetAssignment(),
        ];
        $this->load->view('adminindirect/distribusi/list_collector', $data);
    }

    public function add()
    {
        is_logged_in();
        $distribusi = $this->distribusicollector_model;
        $validation = $this->form_validation;
        $validation->set_rules($distribusi->rules());   

        if ($validation->run())
        {
            $distribusi->save();
            $this->session->set_flashdata('success', 'Successfully saved');
            redirect(site_url('adminindirect/distribusicollector'));
        }
        // else if (!$validation->run()) 
        // {
        //     echo validation_errors();
        // }

        $data = $this->userSession();
        $arr = array('kode_tdc' => $data['tdc'], 'divisi' => 'collector');
        $data['users'] = $this->distribusicollector_model->userList();
        $data['collector'] = $this->distribusicollector_model->getThisTableRecord('tbl_marketing', $arr);

        $this->load->view('adminindirect/distribusi/new_form_collector', $data);
    }

    public function edit($id=null)
    {
        is_logged_in();
        if (!isset($id)) redirect('adminindirect/distribusicollector');

        $distribusi = $this->distribusicollector_model;
        $validation = $this->form_validation;
        $validation->set_rules($distribusi->rules());

        if ($validation->run())
        {
            $distribusi->update($id);
            $this->session->set_flashdata('success', 'Successfully updated');
            redirect(site_url('adminindirect/distribusicollector'));
        }
        // else if (!$validation->run())
        // {
        //     echo validation_errors();
        // }

        $data = $this->userSession();
        $arr = array('kode_tdc' => $data['tdc'], 'divisi' => 'collector');
        $data += [
            'distribusi' => $distribusi->getById($id),
            'users' => $distribusi->userList(),
            'collector' => $this->distribusicollector_model->getThisTableRecord('tbl_marketing', $arr)
        ];

        if (!$data['distribusi']) show_404();

        $this->load->view('adminindirect/distribusi/edit_form_collector', $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->distribusicollector_model->delete($id))
        {
            redirect(site_url('adminindirect/distribusicollector'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['distribusi'] = $this->distribusicollector_model->getDetail($id);
        $this->load->view('adminindirect/distribusi/detail_collector', $data);
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
            'distribusi' => $this->distribusicollector_model->getCollector(null, $start, $end)
        ];

        $this->load->view('adminindirect/distribusi/pdf_export_collector', $data);
    }
    
    public function export($start, $end)
    {
        $data = $this->userSession();
        $export = $this->distribusicollector_model->getCollector(null, $start, $end);
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
            ->setCellValue('B1', 'Nama Marketing')
            ->setCellValue('C1', 'New RS Non Outlet')
            ->setCellValue('D1', 'NSB')
            ->setCellValue('E1', 'GT Pulsa')
            ->setCellValue('F1', 'Collecting');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A'. $i , date('Y-m-d', strtotime($ex->tanggal)))
            ->setCellValue('B'. $i , $ex->nama_marketing)
            ->setCellValue('C'. $i , $ex->new_rs_non_outlet)
            ->setCellValue('D'. $i , $ex->nsb)
            ->setCellValue('E'. $i , $ex->gt_pulsa)
            ->setCellValue('F'. $i , $ex->collecting);
            $i++;
        }
        
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Target Assignment '.date('d-m-Y H'));
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Target Assignment' . date('d-m-Y H') . '.xlsx"');
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