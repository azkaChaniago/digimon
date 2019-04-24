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

    public function index()
    {
        is_logged_in();
        $data = $this->userSession();
        $data += [
            'sharereguler' => $this->sharereguler_model->getAll($data['tdc']),
            'reguler_view' => $this->sharereguler_model->selectView('view_marketshare_reguler', $data['tdc']),
            'kabupaten' => $this->sharereguler_model->getGraphMS($data['id'], 'kabupaten'),
            'kecamatan' => $this->sharereguler_model->getGraphMS($data['id'], 'kecamatan')
        ];
        $this->load->view('indirect/sharereguler/list', $data);
    }

    public function market()
    {
        is_logged_in();
        $data = $this->userSession();
        $data += [
            // 'sharereguler' => $this->sharereguler_model->getAll($data['tdc']),
            'reguler_view' => $this->sharereguler_model->getThisTableRecord('tbl_reg_marketshare'),
        ];
        $this->load->view('indirect/sharereguler/list', $data);
    }

    public function recharge()
    {
        is_logged_in();
        $data = $this->userSession();
        $data += [
            // 'sharereguler' => $this->sharereguler_model->getAll($data['tdc']),
            'reguler_view' => $this->sharereguler_model->getThisTableRecord('tbl_reg_rechargeshare'),
        ];
        $this->load->view('indirect/sharereguler/list', $data);
    }

    public function sales()
    {
        is_logged_in();
        $data = $this->userSession();
        $data += [
            // 'sharereguler' => $this->sharereguler_model->getAll($data['tdc']),
            'reguler_view' => $this->sharereguler_model->getThisTableRecord('tbl_reg_salesshare'),
        ];
        $this->load->view('indirect/sharereguler/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $sharereguler = $this->sharereguler_model;
        $validation = $this->form_validation;
        $validation->set_rules($sharereguler->rules());   

        if ($validation->run())
        {
            $sharereguler->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');  
            redirect(site_url('indirect/sharereguler'));
        }
        // else if (!$validation->run())
        // {
        //     die(validation_errors());
        // }
        $data = $this->userSession();
        // $data['users'] = $this->sharereguler_model->userList();
        $this->load->view('indirect/sharereguler/new_form', $data);
    }

    public function marketAdd()
    {
        is_logged_in();
        $sharereguler = $this->sharereguler_model;
        $validation = $this->form_validation;
        $validation->set_rules($sharereguler->marketrules());   

        if ($validation->run())
        {
            $sharereguler->savemarket();
            $this->session->set_flashdata('success', 'Berhasil disimpan');  
            redirect(site_url('indirect/sharereguler/market'));
        }
        $data = $this->userSession();
        $this->load->view('indirect/sharereguler/new_form', $data);
    }

    public function rechargeAdd()
    {
        is_logged_in();
        $sharereguler = $this->sharereguler_model;
        $validation = $this->form_validation;
        $validation->set_rules($sharereguler->rechargerules());   

        if ($validation->run())
        {
            $sharereguler->saverecharge();
            $this->session->set_flashdata('success', 'Berhasil disimpan');  
            redirect(site_url('indirect/sharereguler/recharge'));
        }
        $data = $this->userSession();
        $this->load->view('indirect/sharereguler/new_form', $data);
    }

    public function salesAdd()
    {
        is_logged_in();
        $sharereguler = $this->sharereguler_model;
        $validation = $this->form_validation;
        $validation->set_rules($sharereguler->salesrules());   

        if ($validation->run())
        {
            $sharereguler->savesales();
            $this->session->set_flashdata('success', 'Berhasil disimpan');  
            redirect(site_url('indirect/sharereguler/sales'));
        }
        $data = $this->userSession();
        $this->load->view('indirect/sharereguler/new_form', $data);
    }

    public function edit($id=null)
    {
        is_logged_in();
        if (!isset($id)) redirect('indirect/sharereguler');

        $sharereguler = $this->sharereguler_model;
        $validation = $this->form_validation;
        $validation->set_rules($sharereguler->rules());

        if ($validation->run())
        {
            $sharereguler->update($id);
            $this->session->set_flashdata('success', 'Berhasil diperbarui');
            redirect(site_url('indirect/sharereguler'));
        }

        $data = $this->userSession();
        $data += [
            'sharereguler' => $sharereguler->getById('tbl_market_share_regular',$id),
        ];

        if (!$data['sharereguler']) show_404();

        $this->load->view('indirect/sharereguler/edit_form', $data);
    }

    public function marketedit($id=null)
    {
        is_logged_in();
        if (!isset($id)) redirect('indirect/sharereguler/market');

        $sharereguler = $this->sharereguler_model;
        $validation = $this->form_validation;
        $validation->set_rules($sharereguler->marketrules());

        if ($validation->run())
        {
            $sharereguler->updatemarket($id);
            $this->session->set_flashdata('success', 'Berhasil diperbarui');
            redirect(site_url('indirect/sharereguler/market'));
        }

        $data = $this->userSession();
        $data += [
            'sharereguler' => $sharereguler->getById('tbl_reg_marketshare', $id),
        ];

        if (!$data['sharereguler']) show_404();

        $this->load->view('indirect/sharereguler/edit_form', $data);
    }

    public function rechargeedit($id=null)
    {
        is_logged_in();
        if (!isset($id)) redirect('indirect/sharereguler/recharge');

        $sharereguler = $this->sharereguler_model;
        $validation = $this->form_validation;
        $validation->set_rules($sharereguler->rechargerules());

        if ($validation->run())
        {
            $sharereguler->updaterecharge($id);
            $this->session->set_flashdata('success', 'Berhasil diperbarui');
            redirect(site_url('indirect/sharereguler/recharge'));
        }

        $data = $this->userSession();
        $data += [
            'sharereguler' => $sharereguler->getById('tbl_reg_rechargeshare', $id),
        ];

        if (!$data['sharereguler']) show_404();

        $this->load->view('indirect/sharereguler/edit_form', $data);
    }

    public function salesedit($id=null)
    {
        is_logged_in();
        if (!isset($id)) redirect('indirect/sharereguler/sales');

        $sharereguler = $this->sharereguler_model;
        $validation = $this->form_validation;
        $validation->set_rules($sharereguler->salesrules());

        if ($validation->run())
        {
            $sharereguler->updatesales($id);
            $this->session->set_flashdata('success', 'Berhasil diperbarui');
            redirect(site_url('indirect/sharereguler/sales'));
        }

        $data = $this->userSession();
        $data += [
            'sharereguler' => $sharereguler->getById('tbl_reg_salesshare', $id),
        ];

        if (!$data['sharereguler']) show_404();

        $this->load->view('indirect/sharereguler/edit_form', $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->sharereguler_model->delete('tbl_market_share_regular', $id))
        {
            redirect(site_url('indirect/sharereguler'));
        }
    }

    public function marketdelete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->sharereguler_model->delete('tbl_reg_marketshare', $id))
        {
            redirect(site_url('indirect/sharereguler/market'));
        }
    }

    public function rechargedelete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->sharereguler_model->delete('tbl_reg_rechargeshare', $id))
        {
            redirect(site_url('indirect/sharereguler/recharge'));
        }
    }

    public function salesdelete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->sharereguler_model->delete('tbl_reg_salesshare', $id))
        {
            redirect(site_url('indirect/sharereguler/sales'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['sharereg'] = $this->sharereguler_model->getDetail('tbl_market_share_regular', $id);
        $this->load->view('indirect/sharereguler/detail', $data);
    }

    public function marketdetail($id=null)
    {
        is_logged_in();
        $data['sharereg'] = $this->sharereguler_model->getDetail('tbl_reg_marketshare' ,$id);
        $this->load->view('indirect/sharereguler/detail', $data);
    }

    public function rechargedetail($id=null)
    {
        is_logged_in();
        $data['sharereg'] = $this->sharereguler_model->getDetail('tbl_reg_rechargeshare' ,$id);
        $this->load->view('indirect/sharereguler/detail', $data);
    }

    public function salesdetail($id=null)
    {
        is_logged_in();
        $data['sharereg'] = $this->sharereguler_model->getDetail('tbl_reg_salesshare' ,$id);
        $this->load->view('indirect/sharereguler/detail', $data);
    }

    public function fetchmarket()
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
            $this->exportpdf($start, $end);
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
            $this->exportpdf($start, $end);
        }
        else if (isset($post['xls']))
        {
            $start = date('Y-m-d', strtotime($post['start']));
            $end = date('Y-m-d', strtotime($post['end']));
            $this->exportSales($start, $end);
        }
    }

    public function exportpdf($start, $end)
    {
        $data = $this->userSession();
        $data += [
            'export' => $this->sharereguler_model->getAll('tbl_market_share_regular', $data['tdc'], $start, $end),
            'market' => $this->sharereguler_model->getAll('tbl_reg_marketshare', $data['tdc'], $start, $end),
            'recharge' => $this->sharereguler_model->getAll('tbl_reg_rechargeshare', $data['tdc'], $start, $end),
            'sales' => $this->sharereguler_model->getAll('tbl_reg_salesshare', $data['tdc'], $start, $end),

        ];

        $this->load->view('indirect/sharereguler/pdf_export', $data);
    }

    public function export()
    {
        $data = $this->userSession();
        $export = $this->sharereguler_model->getAll('tbl_market_share_regular', $data['tdc']);
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
            ->setCreator('Digimon')
            ->setLastModifiedBy($this->session->userdata('user'))
            ->setTitle('Laporan Marketshare Regular')
            ->setSubject('Laporan Marketshare Regular')
            ->setDescription('Eksport Marketshare Regular')
            ->setKeywords('Marketshare Regular')
            ->setCategory('Marketshare Regular');

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

    public function exportMarket($start, $end)
    {
        $data = $this->userSession();
        $export = $this->sharereguler_model->getAll('tbl_reg_marketshare', $data['tdc'], $start, $end);
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
        $export = $this->sharereguler_model->getAll('tbl_reg_rechargeshare', $data['tdc'], $start, $end);
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

    public function exportsales($start, $end)
    {
        $data = $this->userSession();
        $export = $this->sharereguler_model->getAll('tbl_reg_salesshare', $data['tdc'], $start, $end);
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