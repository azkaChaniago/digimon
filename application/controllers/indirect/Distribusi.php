<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Distribusi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('distribusi_model');
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
            'canvasser' => $this->distribusi_model->getAll('canvasser', $data['tdc']),
        ];
        $this->load->view('indirect/distribusi/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $distribusi = $this->distribusi_model;
        $validation = $this->form_validation;
        $validation->set_rules($distribusi->rules());   

        if ($validation->run())
        {
            $distribusi->save();
            $this->session->set_flashdata('success', 'Successfully saved');
            redirect(site_url('indirect/distribusi'));
        }
        // else if (!$validation->run())
        // {
        //     echo validation_errors();
        // }

        $data = $this->userSession();
        $data['users'] = $this->distribusi_model->userList();
        $data['canvasser'] = $this->distribusi_model->getCanvasser($data['tdc']);

        $this->load->view('indirect/distribusi/new_form', $data);
    }

    public function edit($id=null)
    {
        is_logged_in();
        if (!isset($id)) redirect('indirect/distribusi');

        $distribusi = $this->distribusi_model;
        $validation = $this->form_validation;
        $validation->set_rules($distribusi->rules());

        if ($validation->run())
        {
            $distribusi->update($id);
            $this->session->set_flashdata('success', 'Successfully updated');
            redirect(site_url('indirect/distribusi'));
        }
        // else if (!$validation->run())
        // {
        //     echo validation_errors();
        // }

        $data = $this->userSession();
        $data += [
            'distribusi' => $distribusi->getById($id),
            'users' => $distribusi->userList(),
            'canvasser' => $this->distribusi_model->getCanvasser($data['tdc'])
        ];

        if (!$data['distribusi']) show_404();

        $this->load->view('indirect/distribusi/edit_form', $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->distribusi_model->delete($id))
        {
            redirect(site_url('indirect/distribusi'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['distribusi'] = $this->distribusi_model->getDetail($id);
        $this->load->view('indirect/distribusi/detail', $data);
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
            'distribusi' => $this->distribusi_model->getDistribusi($data['tdc'], $start, $end)
        ];

        $this->load->view('indirect/distribusi/pdf_export', $data);
    }

    public function export($start, $end)
    {
        $data = $this->userSession();
        $export = $this->distribusi_model->getDistribusi($data['tdc'], $start, $end);
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
            ->setCellValue('A1', 'Tahun')
            ->setCellValue('B1', 'Nama Marketing')
            ->setCellValue('C1', 'New Opening Outlet')
            ->setCellValue('D1', 'Outlet Aktif Digital')
            ->setCellValue('E1', 'Outlet Aktif Voucher')
            ->setCellValue('F1', 'Outlet Aktif Bang Tcash')
            ->setCellValue('G1', 'Sales Perdana')
            ->setCellValue('H1', 'NSB')
            ->setCellValue('I1', 'MKIOS Bulk')
            ->setCellValue('J1', 'GT Pulsa')
            ->setCellValue('K1', 'MKIOS Reguler');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , date('Y-m-d', strtotime($ex->tanggal)))
                ->setCellValue('B'. $i , $ex->nama_marketing)
                ->setCellValue('C'. $i , $ex->new_opening_outlet)
                ->setCellValue('D'. $i , $ex->outlet_aktif_digital)
                ->setCellValue('E'. $i , $ex->outlet_aktif_voucher)
                ->setCellValue('F'. $i , $ex->outlet_aktif_bang_tcash)
                ->setCellValue('G'. $i , $ex->sales_perdana)
                ->setCellValue('H'. $i , $ex->nsb)
                ->setCellValue('I'. $i , $ex->mkios_bulk)
                ->setCellValue('J'. $i , $ex->gt_pulsa)
                ->setCellValue('K'. $i , $ex->mkios_reguler);
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