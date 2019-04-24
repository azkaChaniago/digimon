<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Scorecard extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('scorecard_model');
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
        // $data['posts'] = $this->scorecard_model->getAll();
        $data = $this->userSession();
        $data += [
            'scores' => $this->scorecard_model->displayTargetAssignment(),
        ];
        $this->load->view('adminindirect/scorecard/list', $data);
    }

    public function canvasser()
    {
        is_logged_in();
        // $data['posts'] = $this->scorecard_model->getAll();
        $data = $this->userSession();
        $data += [
            'scores' => $this->scorecard_model->getCanvasser(),
        ];
        $this->load->view('adminindirect/scorecard/list_canvasser', $data);
    }

    public function collector()
    {
        is_logged_in();
        // $data['posts'] = $this->scorecard_model->getAll();
        $data = $this->userSession();
        $data += [
            'scores' => $this->scorecard_model->getCollector(),
        ];
        $this->load->view('adminindirect/scorecard/list_collector', $data);
    }

    public function add()
    {
        is_logged_in();
        $score = $this->scorecard_model;
        $validation = $this->form_validation;
        $validation->set_rules($score->rules());   

        if ($validation->run())
        {
            $score->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');   
            redirect(site_url('adminindirect/scorecard'));
        }
        else if (!$validation->run())
        {
            $this->session->set_flashdata('error', validation_errors());
        }
        $data = $this->userSession();
        $data['users'] = $this->scorecard_model->userList();
        $data['marketing'] = $this->scorecard_model->getScorecard($data['tdc']);
        $this->load->view('adminindirect/scorecard/new_form', $data);
    }

    public function edit($id=null)
    {
        is_logged_in();
        if (!isset($id)) redirect('adminindirect/historiorder');

        $score = $this->scorecard_model;
        $validation = $this->form_validation;
        $validation->set_rules($score->rules());

        if ($validation->run())
        {
            $score->update($id);
            $this->session->set_flashdata('success', 'Berhasil diperbarui');
            redirect(site_url('adminindirect/scorecard'));
        }
        // else if (!$validation->run())
        // {
        //     echo validation_errors();
        // }

        $data = $this->userSession();
        $data += [
            'score' => $score->getById($id),
            'users' => $score->userList(),
            'marketing' => $this->scorecard_model->getScorecard($data['tdc'])
        ];
        
        if (!$data['score']) show_404();

        $this->load->view('adminindirect/scorecard/edit_form', $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->scorecard_model->delete($id))
        {
            redirect(site_url('adminindirect/scorecard'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['scorecard'] = $this->scorecard_model->getDetail($id);
        $this->load->view('adminindirect/scorecard/detail', $data);
    }

    public function exportpdf()
    {
        $data = $this->userSession();   
        $data += [
            'scorecard' => $this->scorecard_model->getAll($data['tdc'])
        ];

        $this->load->view('adminindirect/scorecard/pdf_export', $data);
    }

    public function export()
    {
        $data = $this->userSession();
        $export = $this->scorecard_model->getAll($data['tdc']);
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
            ->setCellValue('B1', 'Nama Marketing')
            ->setCellValue('C1', 'Divisi')
            ->setCellValue('D1', 'New Opening Outlet')
            ->setCellValue('E1', 'Outlet Aktif Digital')
            ->setCellValue('F1', 'Outlet Aktif Voucher')
            ->setCellValue('G1', 'Outlet Aktif Bang Tcash')
            ->setCellValue('H1', 'Sales Perdana')
            ->setCellValue('I1', 'NSB')
            ->setCellValue('J1', 'MKIOS Reguler')
            ->setCellValue('K1', 'MKIOS Bulk')
            ->setCellValue('L1', 'GT Pulsa');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , $ex->tanggal)
                ->setCellValue('B'. $i , $ex->nama_marketing)
                ->setCellValue('C'. $i , $ex->divisi)
                ->setCellValue('D'. $i , $ex->new_opening_outlet)
                ->setCellValue('E'. $i , $ex->outlet_aktif_digital)
                ->setCellValue('F'. $i , $ex->outlet_aktif_voucher)
                ->setCellValue('G'. $i , $ex->outlet_aktif_bang_tcash)
                ->setCellValue('H'. $i , $ex->sales_perdana)
                ->setCellValue('I'. $i , $ex->nsb)
                ->setCellValue('J'. $i , $ex->mkios_reguler)
                ->setCellValue('K'. $i , $ex->mkios_bulk)
                ->setCellValue('L'. $i , $ex->gt_pulsa);
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