<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
class Sekolah extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sekolah_model');
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
        $data['sekolah'] = $this->sekolah_model->getRelated();
        $this->load->view('admindirect/sekolah/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $sekolah = $this->sekolah_model;
        $validation = $this->form_validation;
        $validation->set_rules($sekolah->rules());
        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $sekolah->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
                redirect(site_url('admindirect/sekolah'));
            }
            else
            {
                die(validation_errors());
            }
        }
        $data['sekolah'] = $this->sekolah_model->getAll();
        $data['tdc'] = $this->sekolah_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->sekolah_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->sekolah_model->getThisTableRecord('tbl_user');
        $this->load->view('admindirect/sekolah/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('admindirect/tdc');
        
        $sekolah = $this->sekolah_model;
        $validation = $this->form_validation;
        $validation->set_rules($sekolah->rules());
        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $sekolah->update($id);
                $this->session->set_flashdata('success', 'Berhasil diubah');
                redirect(site_url('admindirect/sekolah'));
            }
            else
            {
                die(validation_errors());
            }
        }
        $data = $this->userSession();
        $data['sekolah'] = $sekolah->getById($id);
        $data['related'] = $sekolah->getRelated($data['tdc']);
        $data['tdc'] = $this->sekolah_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->sekolah_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->sekolah_model->getThisTableRecord('tbl_user');
        if (!$data['sekolah']) show_404();

        $this->load->view('admindirect/sekolah/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->sekolah_model->delete($id))
        {
            redirect(site_url('admindirect/sekolah'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['sekolah'] = $this->sekolah_model->getDetail($id);
        $this->load->view('admindirect/sekolah/detail', $data);
    }

    public function exportpdf()
    {
        // die($start . $end);
        $data = $this->userSession();
        $data += [
            'export' => $this->sekolah_model->getRelated()
        ];

        $this->load->view('admindirect/sekolah/pdf_export', $data);
    }

    public function export()
    {
        $data = $this->userSession();
        $export = $this->sekolah_model->getRelated();
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
            ->setCreator('Digimon')
            ->setLastModifiedBy($this->session->userdata('user'))
            ->setTitle('Daftar Sekolah')
            ->setSubject('Daftar Sekolah')
            ->setDescription('Eksport Sekolah')
            ->setKeywords('Sekolah')
            ->setCategory('Sekolah');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama TDC')
            ->setCellValue('B1', 'NPSN')
            ->setCellValue('C1', 'Nama Sekolah')
            ->setCellValue('D1', 'Kabupaten')
            ->setCellValue('E1', 'Kecamatan')
            ->setCellValue('F1', 'Alamat Sekolah')
            ->setCellValue('G1', 'Jumlah Siswa')
            ->setCellValue('H1', 'Nama Marketing');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , $ex->nama_tdc)
                ->setCellValue('B'. $i , $ex->npsn)
                ->setCellValue('C'. $i , $ex->nama_sekolah)
                ->setCellValue('D'. $i , $ex->kabupaten)
                ->setCellValue('E'. $i , $ex->kecamatan)
                ->setCellValue('F'. $i , $ex->alamat_sekolah)
                ->setCellValue('G'. $i , $ex->jumlah_siswa)
                ->setCellValue('H'. $i , $ex->nama_marketing);
            $i++;
        }
        
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('HVC '.date('d-m-Y H'));
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