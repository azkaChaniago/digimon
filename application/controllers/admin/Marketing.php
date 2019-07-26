<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Marketing extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('marketing_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        is_logged_in();
        
        $data['marketing'] = $this->marketing_model->getRelated();
        $this->load->view('admin/marketing/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $marketing = $this->marketing_model;
        $validation = $this->form_validation;
        $validation->set_rules($marketing->rules());

        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $marketing->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
                redirect(site_url('admin/marketing'));
            }
            else
            {
                $this->session->set_flashdata('error', validation_errors());
                redirect(site_url('admin/marketing/add/'));
           }
        }
        
        $data['marketing'] = $this->marketing_model->getAll();
        $data['tdc'] = $this->marketing_model->getThisTableRecord('tbl_tdc');

        $this->load->view('admin/marketing/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('admin/marketing');
        
        $marketing = $this->marketing_model;
        $validation = $this->form_validation;
        $validation->set_rules($marketing->rules());

        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $marketing->update($id);
                $this->session->set_flashdata('success', 'Berhasil diubah');
                redirect(site_url('admin/marketing'));
            }
            else
            {
                $this->session->set_flashdata('error', validation_errors());
                redirect(site_url('admin/marketing/edit/' . $id));
            }
        }

        $data['marketing'] = $marketing->getById($id);
        $data['related'] = $marketing->getRelated();
        $data['tdc'] = $this->marketing_model->getThisTableRecord('tbl_tdc');
        $data['user'] = $this->marketing_model->getThisTableRecord('tbl_user');
        if (!$data['marketing']) show_404();

        $this->load->view('admin/marketing/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->marketing_model->delete($id))
        {
            redirect(site_url('admin/marketing'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['marketing'] = $this->marketing_model->getDetail($id);
        $this->load->view('admin/marketing/detail', $data);
    }

    public function export()
    {
        $export = $this->marketing_model->getRelated();
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
            ->setCreator('Digimon')
            ->setLastModifiedBy($this->session->userdata('user'))
            ->setTitle('Laporan Outlet')
            ->setSubject('Laporan Outlet')
            ->setDescription('Eksport Outlet')
            ->setKeywords('Outlet')
            ->setCategory('Outlet');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Kode_Marketing')
            ->setCellValue('B1', 'Kode_TDC')
            ->setCellValue('C1', 'Divisi')
            ->setCellValue('D1', 'Nama_Marketing')
            ->setCellValue('E1', 'Mkios')
            ->setCellValue('F1', 'Nomor_HP')
            ->setCellValue('G1', 'Alamat')
            ->setCellValue('H1', 'Email');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , $ex->kode_marketing)
                ->setCellValue('B'. $i , $ex->kode_tdc)
                ->setCellValue('C'. $i , $ex->divisi)
                ->setCellValue('D'. $i , $ex->nama_marketing)
                ->setCellValue('E'. $i , $ex->mkios)
                ->setCellValue('F'. $i , $ex->no_hp)
                ->setCellValue('G'. $i , $ex->alamat)
                ->setCellValue('H'. $i , $ex->email);
            $i++;
        }
        
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Data Pegawai '.date('d-m-Y H'));
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Data Pegawai ' . date('d-m-Y H') . '.xlsx"');
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