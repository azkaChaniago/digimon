<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Komunitas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('komunitas_model');
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
            'kode_tdc' => $this->session->userdata('tdc')
        );

        return $data;
    }

    public function index()
    {
        is_logged_in();
        $data = $this->userSession();
        $data['komunitas'] = $this->komunitas_model->getRelated($data['kode_tdc']);
        $this->load->view('direct/komunitas/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $komunitas = $this->komunitas_model;
        $validation = $this->form_validation;
        $validation->set_rules($komunitas->rules());
        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $komunitas->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
                redirect(site_url('direct/komunitas'));
            }
            else
            {
                die(validation_errors());
            }
        }
        $data = $this->userSession();
        $data['komunitas'] = $this->komunitas_model->getAll();
        $data['tdc'] = $this->komunitas_model->getThisTableRecord('tbl_tdc');
        $condition = "kode_tdc = '$data[kode_tdc]' AND (divisi = 'AO YNC' OR divisi = 'EVENT OFFICER' OR divisi = 'PROMOTOR')";
        $data['marketing'] = $this->komunitas_model->getThisTableRecord('tbl_marketing', $condition);
        $data['user'] = $this->komunitas_model->getThisTableRecord('tbl_user');
        $this->load->view('direct/komunitas/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('direct/komunitas');
        
        $komunitas = $this->komunitas_model;
        $validation = $this->form_validation;
        $validation->set_rules($komunitas->rules());
        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $komunitas->update($id);
                $this->session->set_flashdata('success', 'Berhasil diubah');
                redirect(site_url('direct/komunitas'));
            }
            else
            {
                die(validation_errors());
            }
        }

        $data = $this->userSession();
        $data['komunitas'] = $komunitas->getById($id);
        $data['related'] = $komunitas->getRelated();
        $data['tdc'] = $this->komunitas_model->getThisTableRecord('tbl_tdc');
        $condition = "kode_tdc = '$data[kode_tdc]' AND (divisi = 'AO YNC' OR divisi = 'EVENT OFFICER' OR divisi = 'PROMOTOR')";
        $data['marketing'] = $this->komunitas_model->getThisTableRecord('tbl_marketing', $condition);
        $data['user'] = $this->komunitas_model->getThisTableRecord('tbl_user');
        if (!$data['komunitas']) show_404();

        $this->load->view('direct/komunitas/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->komunitas_model->delete($id))
        {
            redirect(site_url('direct/komunitas'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['komunitas'] = $this->komunitas_model->getDetail($id);
        $this->load->view('direct/komunitas/detail', $data);
    }

    public function exportpdf()
    {
        // die($start . $end);
        $data = $this->userSession();
        $data += [
            'export' => $this->komunitas_model->getRelated($data['kode_tdc'])
        ];

        $this->load->view('direct/komunitas/pdf_export', $data);
    }

    public function export()
    {
        $data = $this->userSession();
        $export = $this->komunitas_model->getRelated($data['kode_tdc']);
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
            ->setCreator('Digimon')
            ->setLastModifiedBy($this->session->userdata('user'))
            ->setTitle('Laporan komunitas')
            ->setSubject('Laporan komunitas')
            ->setDescription('Eksport komunitas')
            ->setKeywords('komunitas')
            ->setCategory('komunitas');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama TDC')
            ->setCellValue('B1', 'Nama Petugas')
            ->setCellValue('C1', 'Nama Komunitas')
            ->setCellValue('D1', 'Nama Ketua')
            ->setCellValue('E1', 'No HP Ketua')
            ->setCellValue('F1', 'Alamat')
            ->setCellValue('G1', 'Jumlah Anggota')
            ->setCellValue('H1', 'Sosial Media');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , $ex->nama_tdc)
                ->setCellValue('B'. $i , $ex->nama_petugas)
                ->setCellValue('C'. $i , $ex->nama_komunitas)
                ->setCellValue('D'. $i , $ex->nama_ketua)
                ->setCellValue('E'. $i , $ex->no_hpketua)
                ->setCellValue('F'. $i , $ex->alamat)
                ->setCellValue('G'. $i , $ex->jumlah_anggota)
                ->setCellValue('H'. $i , $ex->nama_sosmed);
            $i++;
        }
        
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('komunitas '.date('d-m-Y H'));
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