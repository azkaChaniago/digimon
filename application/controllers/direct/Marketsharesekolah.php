<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Marketsharesekolah extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('marketsharesekolah_model');
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
        $data['marketshare'] = $this->marketsharesekolah_model->getRelated($data['tdc']);
        $this->load->view('direct/sharesekolah/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $sekolah = $this->marketsharesekolah_model;
        $validation = $this->form_validation;
        $validation->set_rules($sekolah->rules());
        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $sekolah->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
                redirect(site_url('direct/marketsharesekolah'));
            }
            else
            {
                die(validation_errors());
            }
        }
        $data['marketshare'] = $this->marketsharesekolah_model->getAll();
        $data['tdc'] = $this->marketsharesekolah_model->getThisTableRecord('tbl_tdc');
        $data['sekolah'] = $this->marketsharesekolah_model->getThisTableRecord('tbl_sekolah');
        $data['user'] = $this->marketsharesekolah_model->getThisTableRecord('tbl_user');
        $this->load->view('direct/sharesekolah/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('direct/marketsharesekolah');
        
        $sekolah = $this->marketsharesekolah_model;
        $validation = $this->form_validation;
        $validation->set_rules($sekolah->rules());
        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $sekolah->update($id);
                $this->session->set_flashdata('success', 'Berhasil disimpan');
                redirect(site_url('direct/marketsharesekolah'));
            }
            else
            {
                die(validation_errors());
            }
        }
        $data = $this->userSession();
        $data['marketshare'] = $sekolah->getById($id);
        $data['related'] = $sekolah->getRelated($data['tdc']);
        $data['sekolah'] = $this->marketsharesekolah_model->getThisTableRecord('tbl_sekolah');
        $data['tdc'] = $this->marketsharesekolah_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->marketsharesekolah_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->marketsharesekolah_model->getThisTableRecord('tbl_user');
        if (!$data['marketshare']) show_404();

        $this->load->view('direct/sharesekolah/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->marketsharesekolah_model->delete($id))
        {
            redirect(site_url('direct/marketsharesekolah'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['marketshare'] = $this->marketsharesekolah_model->getDetail($id);
        $this->load->view('direct/sharesekolah/detail', $data);
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
            'export' => $this->marketsharesekolah_model->getRelated($data['tdc'], $start, $end)
        ];

        $this->load->view('direct/sharesekolah/pdf_export', $data);
    }

    public function export($start, $end)
    {
        $data = $this->userSession();
        $export = $this->marketsharesekolah_model->getRelated($data['tdc'], $start, $end);
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
            ->setCreator('Digimon')
            ->setLastModifiedBy($this->session->userdata('user'))
            ->setTitle('Laporan Marketshare Sekolah')
            ->setSubject('Laporan Marketshare Sekolah')
            ->setDescription('Eksport Marketshare Sekolah')
            ->setKeywords('Marketshare Sekolah')
            ->setCategory('Marketshare Sekolah');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Nama TDC')
            ->setCellValue('C1', 'NPSN')
            ->setCellValue('D1', 'Nama Sekolah')
            ->setCellValue('E1', 'Kabupaten')
            ->setCellValue('F1', 'Kecamatan')
            ->setCellValue('G1', 'Alamat')
            ->setCellValue('H1', 'Jumlah Siswa')
            ->setCellValue('I1', 'QTY Simpati')
            ->setCellValue('J1', 'QTY AS')
            ->setCellValue('K1', 'QTY Loop')
            ->setCellValue('L1', 'QTY Mentari')
            ->setCellValue('M1', 'QTY IM3')
            ->setCellValue('N1', 'QTY XL')
            ->setCellValue('O1', 'QTY Axsis')
            ->setCellValue('P1', 'QTY Tri')
            ->setCellValue('Q1', 'QTY Smartfrend');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , date('Y-m-d', strtotime($ex->tgl_marketshare)))
                ->setCellValue('B'. $i , $ex->nama_tdc)
                ->setCellValue('C'. $i , $ex->npsn)
                ->setCellValue('D'. $i , $ex->nama_sekolah)
                ->setCellValue('E'. $i , $ex->kabupaten)
                ->setCellValue('F'. $i , $ex->kecamatan)
                ->setCellValue('G'. $i , $ex->alamat)
                ->setCellValue('H'. $i , $ex->jumlah_siswa)
                ->setCellValue('I'. $i , $ex->qty_simpati)
                ->setCellValue('J'. $i , $ex->qty_as)
                ->setCellValue('K'. $i , $ex->qty_loop)
                ->setCellValue('L'. $i , $ex->qty_mentari)
                ->setCellValue('M'. $i , $ex->qty_im3)
                ->setCellValue('N'. $i , $ex->qty_xl)
                ->setCellValue('O'. $i , $ex->qty_axsis)
                ->setCellValue('P'. $i , $ex->qty_tri)
                ->setCellValue('Q'. $i , $ex->qty_smartfrend);
            $i++;
        }
        
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('sharesekolah '.date('d-m-Y H'));
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