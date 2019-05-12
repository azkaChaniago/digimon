<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Mercent extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mercent_model');
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
        $data['mercent'] = $this->mercent_model->getRelated($data['tdc']);
        $this->load->view('direct/mercent/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $mercent = $this->mercent_model;
        $validation = $this->form_validation;
        $validation->set_rules($mercent->rules());
        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $mercent->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
                redirect(site_url('direct/mercent'));
            }
            else
            {
                die(validation_errors());
            }
        }
        $data['mercent'] = $this->mercent_model->getAll();
        $data['tdc'] = $this->mercent_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->mercent_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->mercent_model->getThisTableRecord('tbl_user');
        $this->load->view('direct/mercent/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect(site_url('direct/mercent'));
        
        $mercent = $this->mercent_model;
        $validation = $this->form_validation;
        $validation->set_rules($mercent->rules());
        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $mercent->update($id);
                $this->session->set_flashdata('success', 'Berhasil diubah');
                redirect(site_url('direct/mercent'));
            }
            else
            {
                echo validation_errors();
            }
        }
        $data = $this->userSession();
        $data['mercent'] = $mercent->getById($id);
        $data['related'] = $mercent->getRelated($data['tdc']);
        $data['tdc'] = $this->mercent_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->mercent_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->mercent_model->getThisTableRecord('tbl_user');
        if (!$data['mercent']) show_404();
        
        $this->load->view('direct/mercent/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->mercent_model->delete($id))
        {
            redirect(site_url('direct/mercent'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['mercent'] = $this->mercent_model->getDetail($id);
        $this->load->view('direct/mercent/detail', $data);
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
        // die($start . $end);
        $data = $this->userSession();
        $data += [
            'export' => $this->mercent_model->getRelated($data['tdc'], $start, $end)
        ];

        $this->load->view('direct/mercent/pdf_export', $data);
    }

    public function export($start, $end)
    {
        $data = $this->userSession();
        $export = $this->mercent_model->getRelated($data['tdc'], $start, $end);
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
            ->setCreator('Digimon')
            ->setLastModifiedBy($this->session->userdata('user'))
            ->setTitle('Laporan Mercent')
            ->setSubject('Laporan Mercent')
            ->setDescription('Eksport Mercent')
            ->setKeywords('Mercent')
            ->setCategory('Mercent');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Nama TDC')
            ->setCellValue('C1', 'Nama Maketing')
            ->setCellValue('D1', 'Nama Mercent')
            ->setCellValue('E1', 'Nama Pic')
            ->setCellValue('F1', 'No HP Pic')
            ->setCellValue('G1', 'No KTP')
            ->setCellValue('H1', 'NPWP')
            ->setCellValue('I1', 'Longtitude')
            ->setCellValue('J1', 'Latitude')
            ->setCellValue('K1', 'Alamat')
            ->setCellValue('L1', 'Produk Diajukan');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , date('Y-m-d', strtotime($ex->tanggal)) )
                ->setCellValue('B'. $i , $ex->nama_tdc)
                ->setCellValue('C'. $i , $ex->nama_marketing)
                ->setCellValue('D'. $i , $ex->nama_mercent)
                ->setCellValue('E'. $i , $ex->nama_pic)
                ->setCellValue('F'. $i , $ex->no_hp_pic)
                ->setCellValue('G'. $i , $ex->no_ktp)
                ->setCellValue('H'. $i , $ex->npwp)
                ->setCellValue('I'. $i , $ex->longtitude)
                ->setCellValue('J'. $i , $ex->latitude)
                ->setCellValue('K'. $i , $ex->alamat)
                ->setCellValue('L'. $i , $ex->produk_diajukan);
            $i++;
        }
        
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Mercent '.date('d-m-Y H'));
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