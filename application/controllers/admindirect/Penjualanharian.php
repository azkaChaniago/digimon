<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
class Penjualanharian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('penjualanharian_model');
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
        $data['penjualanharian'] = $this->penjualanharian_model->getRelated($data['tdc']);
        $this->load->view('admindirect/penjualanharian/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $penjualanharian = $this->penjualanharian_model;
        $validation = $this->form_validation;
        $validation->set_rules($penjualanharian->rules());

        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $penjualanharian->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
                redirect(site_url('admindirect/penjualanharian'));
            }
            else
            {
                echo validation_errors();
            }
        }
        $data['penjualanharian'] = $this->penjualanharian_model->getAll();
        $data['tdc'] = $this->penjualanharian_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->penjualanharian_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->penjualanharian_model->getThisTableRecord('tbl_user');
        $this->load->view('admindirect/penjualanharian/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('admindirect/tdc');
        
        $penjualanharian = $this->penjualanharian_model;
        $validation = $this->form_validation;
        $validation->set_rules($penjualanharian->rules());

        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $penjualanharian->update($id);
                $this->session->set_flashdata('success', 'Berhasil diubah');
                redirect(site_url('admindirect/penjualanharian'));
            }
            else
            {
                $this->session->set_flashdata('error', validation_errors());
                redirect(site_url('admindirect/penjualanharian'));
            }
        }

        $data['penjualanharian'] = $penjualanharian->getById($id);
        $data['related'] = $penjualanharian->getRelated();
        $data['tdc'] = $this->penjualanharian_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->penjualanharian_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->penjualanharian_model->getThisTableRecord('tbl_user');

        $this->load->view('admindirect/penjualanharian/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->penjualanharian_model->delete($id))
        {
            redirect(site_url('admindirect/penjualanharian'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['penjualanharian'] = $this->penjualanharian_model->getDetail($id);
        $this->load->view('admindirect/penjualanharian/detail', $data);
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
            'export' => $this->penjualanharian_model->getRelated($data['tdc'], $start, $end)
        ];

        $this->load->view('admindirect/penjualanharian/pdf_export', $data);
    }

    public function export($start, $end)
    {
        $data = $this->userSession();
        $export = $this->penjualanharian_model->getRelated($data['tdc'],$start, $end);
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
            ->setCellValue('A1', 'Tanggal Penjualan')
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
            ->setCellValue('M1', 'Mount Legacy')
            ->setCellValue('N1', 'Paket Max Digital')            
            ->setCellValue('O1', 'No MSDN Digital')            
            ->setCellValue('P1', 'Price Digital')            
            ->setCellValue('Q1', 'MSDN Tcash')            
            ->setCellValue('R1', 'Cashin Tcash')            
            ->setCellValue('S1', 'Status Tcash')            
            ->setCellValue('T1', 'Low NSB')
            ->setCellValue('U1', 'Middle NSB')
            ->setCellValue('V1', 'High NSB')           
            ->setCellValue('W1', 'AS NSB')
            ->setCellValue('X1', 'Simpati NSB')
            ->setCellValue('Y1', 'Loop NSB');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , date('Y-m-d', strtotime($ex->tgl_penjualan)))
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
                ->setCellValue('N'. $i , $ex->paket_max_digital)
                ->setCellValue('O'. $i , $ex->no_msdn_digital)
                ->setCellValue('P'. $i , $ex->price_digital)
                ->setCellValue('Q'. $i , $ex->msdn_tcash)
                ->setCellValue('R'. $i , $ex->cashin_tcash)
                ->setCellValue('S'. $i , $ex->status_tcash)
                ->setCellValue('T'. $i , $ex->qty_low_nsb)
                ->setCellValue('U'. $i , $ex->qty_middle_nsb)
                ->setCellValue('V'. $i , $ex->qty_high_nsb)
                ->setCellValue('W'. $i , $ex->qty_as_nsb)
                ->setCellValue('X'. $i , $ex->qty_simpati_nsb)
                ->setCellValue('Y'. $i , $ex->qty_loop_nsb);
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