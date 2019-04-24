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

    public function marketshare($kab=null)
    {
        is_logged_in();
        $data = $this->userSession();
        $data += [
            'sharereguler' => $this->sharereguler_model->getThisTableRecord('tbl_reg_marketshare'),
            'regular' => $this->sharereguler_model->chartMarketshare(),
            'kabupaten' => $this->sharereguler_model->chartMarketshareKab()
        ];
        if ($kab)
        {
            $kab = str_replace('%20', ' ', $kab);
            $data['kecamatan'] = $this->sharereguler_model->chartMarketKec($kab);
            $data['kab'] = str_replace(' ', '%20', $kab);
        }
        $this->load->view('adminindirect/sharereguler/marketshare', $data);
    }

    public function rechargeshare($kab=null)
    {
        is_logged_in();
        $data = $this->userSession();
        $data += [
            'sharereguler' => $this->sharereguler_model->getThisTableRecord('tbl_reg_rechargeshare'),
            'regular' => $this->sharereguler_model->chartRechargeshare(),
            'kabupaten' => $this->sharereguler_model->chartRechargeshareKab()
        ];
        if ($kab)
        {
            $kab = str_replace('%20', ' ', $kab);
            $data['kecamatan'] = $this->sharereguler_model->chartRechargeKec($kab);
            $data['kab'] = str_replace(' ', '%20', $kab);
        }
        $this->load->view('adminindirect/sharereguler/rechargeshare', $data);
    }

    public function salesshare($kab=null)
    {
        is_logged_in();
        $data = $this->userSession();
        $data += [
            'sharereguler' => $this->sharereguler_model->getThisTableRecord('tbl_reg_salesshare'),
            'regular' => $this->sharereguler_model->chartSalesshare(),
            'kabupaten' => $this->sharereguler_model->chartSalesshareKab()
        ];
        if ($kab)
        {
            $kab = str_replace('%20', ' ', $kab);
            $data['kecamatan'] = $this->sharereguler_model->chartSalesKec($kab);
            $data['kab'] = str_replace(' ', '%20', $kab);
        }
        $this->load->view('adminindirect/sharereguler/salesshare', $data);
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['sharereg'] = $this->sharereguler_model->getDetail($id);
        $this->load->view('adminindirect/sharereguler/detail', $data);
    }

    public function fetchmarket()
    {
        $post = $this->input->post();
        if (isset($post['pdf']))
        {
            $start = date('Y-m-d', strtotime($post['start']));
            $end = date('Y-m-d', strtotime($post['end']));
            $this->exportpdf('tbl_reg_marketshare', $start, $end);
        }
        else if (isset($post['xls']))
        {
            $start = date('Y-m-d', strtotime($post['start']));
            $end = date('Y-m-d', strtotime($post['end']));
            $this->exportMarket($start, $end);
        }
    }

    public function fetchrecharge()
    {
        $post = $this->input->post();
        if (isset($post['pdf']))
        {
            $start = date('Y-m-d', strtotime($post['start']));
            $end = date('Y-m-d', strtotime($post['end']));
            $this->exportpdf('tbl_reg_rechargeshare', $start, $end);
        }
        else if (isset($post['xls']))
        {
            $start = date('Y-m-d', strtotime($post['start']));
            $end = date('Y-m-d', strtotime($post['end']));
            $this->exportRecharge($start, $end);
        }
    }

    public function fetchsales()
    {
        $post = $this->input->post();
        if (isset($post['pdf']))
        {
            $start = date('Y-m-d', strtotime($post['start']));
            $end = date('Y-m-d', strtotime($post['end']));
            $this->exportpdf('tbl_reg_salesshare', $start, $end);
        }
        else if (isset($post['xls']))
        {
            $start = date('Y-m-d', strtotime($post['start']));
            $end = date('Y-m-d', strtotime($post['end']));
            $this->exportSales($start, $end);
        }
    }

    public function exportpdf($table, $start, $end)
    {
        $data = $this->userSession();
        $data += [
            'export' => $this->sharereguler_model->getThisTableRecord($table, $start, $end)
        ];

        $this->load->view('adminindirect/sharereguler/pdf_export', $data);
    }

    public function exportMarket($start, $end)
    {
        $data = $this->userSession();
        $export = $this->sharereguler_model->getThisTableRecord('tbl_reg_marketshare', $start, $end);
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
            ->setCreator('Digimon')
            ->setLastModifiedBy($this->session->userdata('user'))
            ->setTitle('Laporan Marketshare')
            ->setSubject('Laporan Marketshare')
            ->setDescription('Eksport Marketshare')
            ->setKeywords('Marketshare')
            ->setCategory('Marketshare');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Kabupaten')
            ->setCellValue('C1', 'Kecamatan')
            ->setCellValue('D1', 'QTY Telkomsel Marketshare')
            ->setCellValue('E1', 'QTY Indosat Marketshare')
            ->setCellValue('F1', 'QTY XL Marketshare')
            ->setCellValue('G1', 'QTY Tri Marketshare')
            ->setCellValue('H1', 'QTY Smartfrend Marketshare');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , $ex->tanggal)
                ->setCellValue('B'. $i , $ex->kabupaten)
                ->setCellValue('C'. $i , $ex->kecamatan)
                ->setCellValue('D'. $i , $ex->qty_telkomsel_marketshare)
                ->setCellValue('E'. $i , $ex->qty_indosat_marketshare)
                ->setCellValue('F'. $i , $ex->qty_xl_marketshare)
                ->setCellValue('G'. $i , $ex->qty_tri_marketshare)
                ->setCellValue('H'. $i , $ex->qty_smartfrend_marketshare);
            $i++;
        }
        
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Marketshare '.date('d-m-Y H'));
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Marketshare ' . date('d-m-Y H') . '.xlsx"');
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

    public function exportRecharge($start, $end)
    {
        $data = $this->userSession();
        $export = $this->sharereguler_model->getThisTableRecord('tbl_reg_rechargeshare', $start, $end);
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
            ->setCreator('Digimon')
            ->setLastModifiedBy($this->session->userdata('user'))
            ->setTitle('Laporan Rechargeshare ')
            ->setSubject('Laporan Rechargeshare ')
            ->setDescription('Eksport Rechargeshare ')
            ->setKeywords('Rechargeshare ')
            ->setCategory('Rechargeshare ');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Kabupaten')
            ->setCellValue('C1', 'Kecamatan')
            ->setCellValue('D1', 'Mount Telkomsel Rechargeshare')
            ->setCellValue('E1', 'Mount Indosat Rechargeshare')
            ->setCellValue('F1', 'Mount XL Rechargeshare')
            ->setCellValue('G1', 'Mount Tri Rechargeshare')
            ->setCellValue('H1', 'Mount Smartfrend Rechargeshare');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , $ex->tanggal)
                ->setCellValue('B'. $i , $ex->kabupaten)
                ->setCellValue('C'. $i , $ex->kecamatan)
                ->setCellValue('D'. $i , $ex->mount_telkomsel_rechargeshare)
                ->setCellValue('E'. $i , $ex->mount_indosat_rechargeshare)
                ->setCellValue('F'. $i , $ex->mount_xl_rechargeshare)
                ->setCellValue('G'. $i , $ex->mount_tri_rechargeshare)
                ->setCellValue('H'. $i , $ex->mount_smartfrend_rechargeshare);
            $i++;
        }
        
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Rechargeshare '.date('d-m-Y H'));
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Rechargeshare ' . date('d-m-Y H') . '.xlsx"');
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

    public function exportSales($start, $end)
    {
        $data = $this->userSession();
        $export = $this->sharereguler_model->getThisTableRecord('tbl_reg_salesshare', $start, $end);
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
            ->setCreator('Digimon')
            ->setLastModifiedBy($this->session->userdata('user'))
            ->setTitle('Laporan Salesshare')
            ->setSubject('Laporan Salesshare')
            ->setDescription('Eksport Salesshare')
            ->setKeywords('Salesshare')
            ->setCategory('Salesshare');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Tanggal')
            ->setCellValue('B1', 'Kabupaten')
            ->setCellValue('C1', 'Kecamatan')
            ->setCellValue('D1', 'QTY Telkomsel Salesshare')
            ->setCellValue('E1', 'QTY Indosat Salesshare')
            ->setCellValue('F1', 'QTY XL Salesshare')
            ->setCellValue('G1', 'QTY Tri Salesshare')
            ->setCellValue('H1', 'QTY Smartfrend Salesshare');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , $ex->tanggal)
                ->setCellValue('B'. $i , $ex->kabupaten)
                ->setCellValue('C'. $i , $ex->kecamatan)
                ->setCellValue('D'. $i , $ex->qty_telkomsel_salesshare)
                ->setCellValue('E'. $i , $ex->qty_indosat_salesshare)
                ->setCellValue('F'. $i , $ex->qty_xl_salesshare)
                ->setCellValue('G'. $i , $ex->qty_tri_salesshare)
                ->setCellValue('H'. $i , $ex->qty_smartfrend_salesshare);
            $i++;
        }
        
        // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Salesshare '.date('d-m-Y H'));
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Salesshare ' . date('d-m-Y H') . '.xlsx"');
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