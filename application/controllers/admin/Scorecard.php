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
    }

    public function userSession()
    {   
        $data = array(
            'status' => $this->session->userdata('login'),
            'access' => $this->session->userdata('access'),
            'id' => $this->session->userdata('id'),
            'user' => $this->session->userdata('user')
        );

        return $data;
    }

    public function index()
    {
        is_logged_in();
        // $data['posts'] = $this->scorecard_model->getAll();
        $data = $this->userSession();
        $data += [
            'scores' => $this->scorecard_model->getScorecard(),
        ];
        $this->load->view('indirect/scorecard/list', $data);
    }

    public function canvasser()
    {
        is_logged_in();
        // $data['posts'] = $this->scorecard_model->getAll();
        $data = $this->userSession();
        $data += [
            'scores' => $this->scorecard_model->getCanvasser(),
        ];
        $this->load->view('indirect/scorecard/list_canvasser', $data);
    }

    public function collector()
    {
        is_logged_in();
        // $data['posts'] = $this->scorecard_model->getAll();
        $data = $this->userSession();
        $data += [
            'scores' => $this->scorecard_model->getCollector(),
        ];
        $this->load->view('indirect/scorecard/list_collector', $data);
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
            redirect(site_url('indirect/scorecard'));
        }
        // else if (!$validation->run())
        // {
        //     echo validation_errors();
        // }
        // $data = $this->userSession();
        $data['users'] = $this->scorecard_model->userList();
        $data['marketing'] = $this->scorecard_model->getIndirectMarketing();
        $this->load->view('indirect/scorecard/new_form', $data);
    }

    // public function addProcess()
    // {
    //     $score = $this->scorecard_model;
    //     $score->save();
    //     echo "good";    

    // }

    public function edit($id=null)
    {
        is_logged_in();
        if (!isset($id)) redirect('indirect/historiorder');

        $score = $this->scorecard_model;
        $validation = $this->form_validation;
        $validation->set_rules($score->rules());

        if ($validation->run())
        {
            $score->update($id);
            $this->session->set_flashdata('success', 'Berhasil diperbarui');
            redirect(site_url('indirect/scorecard'));
        }
        // else if (!$validation->run())
        // {
        //     echo validation_errors();
        // }

        $data = $this->userSession();
        $data += [
            'score' => $score->getById($id),
            'users' => $score->userList(),
            'marketing' => $this->scorecard_model->getIndirectMarketing()
        ];
        
        if (!$data['score']) show_404();

        $this->load->view('indirect/scorecard/edit_form', $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->scorecard_model->delete($id))
        {
            redirect(site_url('indirect/scorecard'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['scorecard'] = $this->scorecard_model->getDetail($id);
        $this->load->view('indirect/scorecard/detail', $data);
    }

    public function export()
    {
        $export = $this->scorecard_model->getScorecard();
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
            ->setCellValue('D1', 'Actual Call')
            ->setCellValue('E1', 'Effective Call')
            ->setCellValue('F1', 'New Outlet')
            ->setCellValue('G1', 'Penjualan')
            ->setCellValue('H1', 'Simpati')
            ->setCellValue('I1', 'AS')
            ->setCellValue('J1', 'Loop')
            ->setCellValue('K1', 'NSB')
            ->setCellValue('L1', 'MKIOS Reguler')
            ->setCellValue('M1', 'MKIOS Bulk')
            ->setCellValue('N1', 'GT Pulsa');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , $ex->tanggal)
                ->setCellValue('B'. $i , $ex->nama_marketing)
                ->setCellValue('C'. $i , $ex->divisi)
                ->setCellValue('D'. $i , $ex->actual_call)
                ->setCellValue('E'. $i , $ex->efective_call)
                ->setCellValue('F'. $i , $ex->new_outlet)
                ->setCellValue('G'. $i , $ex->penjualan)
                ->setCellValue('H'. $i , $ex->simpati)
                ->setCellValue('I'. $i , $ex->as)
                ->setCellValue('J'. $i , $ex->loop)
                ->setCellValue('K'. $i , $ex->nsb)
                ->setCellValue('L'. $i , $ex->mkios_reguler)
                ->setCellValue('M'. $i , $ex->mkios_bulk)
                ->setCellValue('N'. $i , $ex->gt_pulsa);
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