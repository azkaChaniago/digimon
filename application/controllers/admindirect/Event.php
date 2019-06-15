<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
class Event extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('event_model');
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
        $data['event'] = $this->event_model->getRelated();
        $data['field'] = $this->event_model->getAllJSON();
        $data['pivot'] = $this->event_model->pivot();
        $this->load->view('admindirect/event/list', $data);
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['event'] = $this->event_model->getDetail($id);
        $this->load->view('admindirect/event/detail', $data);
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
            'export' => $this->event_model->getRecord(null, $start, $end)
        ];

        $this->load->view('admindirect/event/pdf_export', $data);
    }

    public function export($start, $end)
    {
        $data = $this->userSession();
        $export = $this->event_model->getRecord(null, $start, $end);
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
            ->setCellValue('A1', 'Tanggal Event')
            ->setCellValue('B1', 'Nama TDC')
            ->setCellValue('C1', 'Divisi')
            ->setCellValue('D1', 'Nama Marketing')
            ->setCellValue('E1', 'Lokasi Penjualan')
            ->setCellValue('F1', '5K')
            ->setCellValue('G1', '10K')
            ->setCellValue('H1', '20K')
            ->setCellValue('I1', '25K')
            ->setCellValue('J1', '50K')
            ->setCellValue('K1', '100K')
            ->setCellValue('L1', 'Mount Bulk')
            ->setCellValue('M1', 'Mount Bulk')
            ->setCellValue('N1', 'Mount Bulk')            
            ->setCellValue('O1', 'Mount Bulk')            
            ->setCellValue('P1', 'Low NSB')
            ->setCellValue('Q1', 'Middle NSB')
            ->setCellValue('R1', 'High NSB')           
            ->setCellValue('S1', 'AS NSB')
            ->setCellValue('T1', 'Simpati NSB')
            ->setCellValue('U1', 'Loop NSB');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , date('Y-m-d', strtotime($ex->tgl_event)))
                ->setCellValue('B'. $i , $ex->nama_tdc)
                ->setCellValue('C'. $i , $ex->divisi)
                ->setCellValue('D'. $i , $ex->nama_marketing)
                ->setCellValue('E'. $i , $ex->lokasi_penjualan)
                ->setCellValue('F'. $i , $ex->qty_5k)
                ->setCellValue('G'. $i , $ex->qty_10k)
                ->setCellValue('H'. $i , $ex->qty_20k)
                ->setCellValue('I'. $i , $ex->qty_25k)
                ->setCellValue('J'. $i , $ex->qty_50k)
                ->setCellValue('K'. $i , $ex->qty_100k)
                ->setCellValue('L'. $i , $ex->mount_bulk)
                ->setCellValue('M'. $i , $ex->mount_legacy)
                ->setCellValue('N'. $i , $ex->mount_digital)
                ->setCellValue('O'. $i , $ex->mount_tcash)
                ->setCellValue('P'. $i , $ex->qty_low_nsb)
                ->setCellValue('Q'. $i , $ex->qty_middle_nsb)
                ->setCellValue('R'. $i , $ex->qty_high_nsb)
                ->setCellValue('S'. $i , $ex->qty_as_nsb)
                ->setCellValue('T'. $i , $ex->qty_simpati_nsb)
                ->setCellValue('U'. $i , $ex->qty_loop_nsb);
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