<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
class Saleling extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('saleling_model');
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
        $data['saleling'] = $this->saleling_model->getRelated($data['tdc']);
        $this->load->view('direct/saleling/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $saleling = $this->saleling_model;
        $validation = $this->form_validation;
        $validation->set_rules($saleling->rules());
        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $saleling->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
                redirect(site_url('direct/saleling'));
            }
            else
            {
                die(validation_errors());
            }
        }
        $data['saleling'] = $this->saleling_model->getAll();
        $data['tdc'] = $this->saleling_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->saleling_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->saleling_model->getThisTableRecord('tbl_user');
        $this->load->view('direct/saleling/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('direct/tdc');
        
        $saleling = $this->saleling_model;
        $validation = $this->form_validation;
        $validation->set_rules($saleling->rules());

        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $saleling->update($id);
                $this->session->set_flashdata('success', 'Berhasil diubah');
                redirect(site_url('direct/saleling'));
            }
            else
            {
                die(validation_errors());
            }
        }

        $data = $this->userSession();
        $data['saleling'] = $saleling->getById($id);
        $data['related'] = $saleling->getRelated($data['tdc']);
        $data['tdc'] = $this->saleling_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->saleling_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->saleling_model->getThisTableRecord('tbl_user');
        if (!$data['saleling']) show_404();

        $this->load->view('direct/saleling/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->saleling_model->delete($id))
        {
            redirect(site_url('direct/saleling'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['saleling'] = $this->saleling_model->getDetail($id);
        $this->load->view('direct/saleling/detail', $data);
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
            'export' => $this->saleling_model->getRelated($data['tdc'], $start, $end)
        ];

        $this->load->view('direct/saleling/pdf_export', $data);
    }

    public function export($start, $end)
    {
        $data = $this->userSession();
        $export = $this->saleling_model->getRelated($data['tdc'], $start, $end);
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
            ->setCellValue('A1', 'Nama TDC')
            ->setCellValue('B1', 'Divisi')
            ->setCellValue('C1', 'Tanggal')
            ->setCellValue('D1', 'Nama Marketing')
            ->setCellValue('E1', 'Lokasi Saleling');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , $ex->nama_tdc)
                ->setCellValue('B'. $i , $ex->divisi)
                ->setCellValue('C'. $i , date('Y-m-d', strtotime($ex->tanggal)))
                ->setCellValue('D'. $i , $ex->nama_marketing)
                ->setCellValue('E'. $i , $ex->lokasi_saleling);
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