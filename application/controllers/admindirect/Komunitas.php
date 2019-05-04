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
            'tdc' => $this->session->userdata('tdc')
        );

        return $data;
    }

    public function index()
    {
        is_logged_in();
        $data = $this->userSession();
        $data['komunitas'] = $this->komunitas_model->getRelated();
        $this->load->view('admindirect/komunitas/list', $data);
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
                redirect(site_url('admindirect/komunitas'));
            }
            else
            {
                die(validation_errors());
            }
        }
        $data['komunitas'] = $this->komunitas_model->getAll();
        $data['tdc'] = $this->komunitas_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->komunitas_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->komunitas_model->getThisTableRecord('tbl_user');
        $this->load->view('admindirect/komunitas/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('admindirect/komunitas');
        
        $komunitas = $this->komunitas_model;
        $validation = $this->form_validation;
        $validation->set_rules($komunitas->rules());
        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $komunitas->update($id);
                $this->session->set_flashdata('success', 'Berhasil diubah');
                redirect(site_url('admindirect/komunitas'));
            }
            else
            {
                die(validation_errors());
            }
        }

        $data['komunitas'] = $komunitas->getById($id);
        $data['related'] = $komunitas->getRelated();
        $data['tdc'] = $this->komunitas_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->komunitas_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->komunitas_model->getThisTableRecord('tbl_user');
        if (!$data['komunitas']) show_404();

        $this->load->view('admindirect/komunitas/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->komunitas_model->delete($id))
        {
            redirect(site_url('admindirect/komunitas'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['komunitas'] = $this->komunitas_model->getDetail($id);
        $this->load->view('admindirect/komunitas/detail', $data);
    }

    public function exportpdf()
    {
        // die($start . $end);
        $data = $this->userSession();
        $data += [
            'export' => $this->hvc_model->getRelated($data['tdc'])
        ];

        $this->load->view('admindirect/hvc/pdf_export', $data);
    }

    public function export()
    {
        $data = $this->userSession();
        $export = $this->hvc_model->getRelated($data['tdc']);
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
            ->setCreator('Digimon')
            ->setLastModifiedBy($this->session->userdata('user'))
            ->setTitle('Laporan HVC')
            ->setSubject('Laporan HVC')
            ->setDescription('Eksport HVC')
            ->setKeywords('HVC')
            ->setCategory('HVC');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama TDC')
            ->setCellValue('B1', 'Tanggal')
            ->setCellValue('C1', 'Nama Mercent')
            ->setCellValue('D1', 'Nama Marketing')
            ->setCellValue('E1', 'Alamat')
            ->setCellValue('F1', 'Longitude')
            ->setCellValue('G1', 'Latitude')
            ->setCellValue('H1', 'QTY 5K')
            ->setCellValue('I1', 'QTY 10K')
            ->setCellValue('J1', 'QTY 20K')
            ->setCellValue('K1', 'QTY 25K')
            ->setCellValue('L1', 'QTY 50K')
            ->setCellValue('M1', 'QTY 100K')
            ->setCellValue('N1', 'Mount Bulk')
            ->setCellValue('O1', 'QTY Low NSB')
            ->setCellValue('P1', 'QTY Middle NSB')
            ->setCellValue('Q1', 'QTY High NSB')
            ->setCellValue('R1', 'QTY AS NSB')
            ->setCellValue('S1', 'QTY Simpati NSB')
            ->setCellValue('T1', 'QTY Loop NSB')
            ->setCellValue('U1', 'Keterangan Kegiatan');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , $ex->nama_tdc)
                ->setCellValue('B'. $i , date('Y-m-d', strtotime($ex->tgl_hvc)))
                ->setCellValue('C'. $i , $ex->nama_mercent)
                ->setCellValue('D'. $i , $ex->nama_marketing)
                ->setCellValue('E'. $i , $ex->alamat)
                ->setCellValue('F'. $i , $ex->longlat_lokasi_mercent)
                ->setCellValue('G'. $i , $ex->latitude_lokasi_mercent)
                ->setCellValue('H'. $i , $ex->qty_5k)
                ->setCellValue('I'. $i , $ex->qty_10k)
                ->setCellValue('J'. $i , $ex->qty_20k)
                ->setCellValue('K'. $i , $ex->qty_25k)
                ->setCellValue('L'. $i , $ex->qty_50k)
                ->setCellValue('M'. $i , $ex->qty_100k)
                ->setCellValue('N'. $i , $ex->mount_bulk)
                ->setCellValue('O'. $i , $ex->qty_low_nsb)
                ->setCellValue('P'. $i , $ex->qty_middle_nsb)
                ->setCellValue('Q'. $i , $ex->qty_high_nsb)
                ->setCellValue('R'. $i , $ex->qty_as_nsb)
                ->setCellValue('S'. $i , $ex->qty_simpati_nsb)
                ->setCellValue('T'. $i , $ex->qty_loop_nsb)
                ->setCellValue('U'. $i , $ex->keterangan_kegiatan);
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