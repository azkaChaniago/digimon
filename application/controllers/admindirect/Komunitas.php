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
            'export' => $this->komunitas_model->getRelated()
        ];

        $this->load->view('admindirect/komunitas/pdf_export', $data);
    }

    public function export()
    {
        $data = $this->userSession();
        $export = $this->komunitas_model->getRelated();
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
            ->setCreator('Digimon')
            ->setLastModifiedBy($this->session->userdata('user'))
            ->setTitle('Laporan Komunitas')
            ->setSubject('Laporan Komunitas')
            ->setDescription('Eksport Komunitas')
            ->setKeywords('Komunitas')
            ->setCategory('Komunitas');

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