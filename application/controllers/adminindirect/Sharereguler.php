<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Sharereguler extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sharereguler_model');
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

    public function marketshare()
    {
        is_logged_in();
        $data = $this->userSession();
        $data += [
            'sharereguler' => $this->sharereguler_model->getThisTableRecord('tbl_reg_marketshare'),
        ];
        $this->load->view('adminindirect/sharereguler/marketshare', $data);
    }

    public function rechargeshare()
    {
        is_logged_in();
        $data = $this->userSession();
        $data += [
            'sharereguler' => $this->sharereguler_model->getThisTableRecord('tbl_reg_rechargeshare'),
        ];
        $this->load->view('adminindirect/sharereguler/rechargeshare', $data);
    }

    public function salesshare()
    {
        is_logged_in();
        $data = $this->userSession();
        $data += [
            'sharereguler' => $this->sharereguler_model->getThisTableRecord('tbl_reg_salesshare'),
        ];
        $this->load->view('adminindirect/sharereguler/salesshare', $data);
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['sharereg'] = $this->sharereguler_model->getDetail($id);
        $this->load->view('adminindirect/sharereguler/detail', $data);
    }

    public function exportpdf()
    {
        $data = $this->userSession();
        $data += [
            'export' => $this->sharereguler_model->getAll($data['tdc'])
        ];

        $this->load->view('adminindirect/sharereguler/pdf_export', $data);
    }

    public function export()
    {
        $data = $this->userSession();
        $export = $this->sharereguler_model->getAll($data['tdc']);
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
            ->setCellValue('B1', 'Kecamatan')
            ->setCellValue('C1', 'QTY Telkomsel Marketshare')
            ->setCellValue('D1', 'QTY Indosat Marketshare')
            ->setCellValue('E1', 'QTY XL Marketshare')
            ->setCellValue('F1', 'QTY Tri Marketshare')
            ->setCellValue('G1', 'QTY Smartfrend Marketshare')
            ->setCellValue('H1', 'Mount Telkomsel Rechargeshare')
            ->setCellValue('I1', 'Mount Indosat Rechargeshare')
            ->setCellValue('J1', 'Mount XL Rechargeshare')
            ->setCellValue('K1', 'Mount Tri Rechargeshare')
            ->setCellValue('L1', 'Mount Smartfrend Rechargeshare')
            ->setCellValue('M1', 'QTY Telkomsel Salesshare')
            ->setCellValue('N1', 'QTY Indosat Salesshare')
            ->setCellValue('O1', 'QTY XL Salesshare')
            ->setCellValue('P1', 'QTY Tri Salesshare')
            ->setCellValue('Q1', 'QTY Smartfrend Salesshare');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , $ex->tanggal)
                ->setCellValue('B'. $i , $ex->kecamatan)
                ->setCellValue('C'. $i , $ex->qty_telkomsel_marketshare)
                ->setCellValue('D'. $i , $ex->qty_indosat_marketshare)
                ->setCellValue('E'. $i , $ex->qty_xl_marketshare)
                ->setCellValue('F'. $i , $ex->qty_tri_marketshare)
                ->setCellValue('G'. $i , $ex->qty_smartfrend_marketshare)
                ->setCellValue('H'. $i , $ex->mount_telkomsel_rechargeshare)
                ->setCellValue('I'. $i , $ex->mount_indosat_rechargeshare)
                ->setCellValue('J'. $i , $ex->mount_xl_rechargeshare)
                ->setCellValue('K'. $i , $ex->mount_tri_rechargeshare)
                ->setCellValue('L'. $i , $ex->mount_smartfrend_rechargeshare)
                ->setCellValue('M'. $i , $ex->qty_telkomsel_salesshare)
                ->setCellValue('N'. $i , $ex->qty_indosat_salesshare)
                ->setCellValue('O'. $i , $ex->qty_xl_salesshare)
                ->setCellValue('P'. $i , $ex->qty_tri_salesshare)
                ->setCellValue('Q'. $i , $ex->qty_smartfrend_salesshare);
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