<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Laporan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('laporan_model');
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
        // $data['posts'] = $this->distribusi_model->getAll();
        $data = $this->userSession();
        // $data += [
        //     'canvasser' => $this->laporan_model->getAll(),
        // ];
        $this->load->view('indirect/laporan', $data);
    }

    // public function getreport()
    // {
    //     $draw = intval($this->input->get("draw"));
    //     $start = intval($this->input->get("start"));
    //     $length = intval($this->input->get("length"));

    //     $query = $this->db->get('tbl_histori_order');

    //     $data = [];

    //     foreach ($query->result() as $r)
    //     {
    //         $data = array(
    //             $r->id_histori_order,
    //             $r->tanggal,
    //             $r->kode_marketing,
    //         );
    //     }

    //     $result = array(
    //         "draw" => $draw,
    //         "recordsTotal" => $query->num_rows(),
    //         "recordsFiltered" => $query->num_rows(),
    //         "data" => $data
    //     );

    //     echo json_encode($result);
    //     exit();
    // }

    public function getpivot()
    {
        $post = $this->input->post();
        $start = $post['start'];
        $end = $post['end'];
        $data = $this->laporan_model->getpivot($start, $end); 
        if ($data)
        {
            echo json_encode($data);
            exit();
        }
        else
        {
            $this->session->set_flashdata('error', $this->db->_error_message());
            $this->load->view('indirect/laporan');
        }
    }


    public function exportpdf()
    {
        $post = $this->input->post();
        $start = date('Y-m-d', strtotime($post['start']));
        $end = date('Y-m-d', strtotime($post['end']));
        
        if (isset($post['pdf']) ? $post['pdf'] : "")
        {
            $data = $this->userSession();
            $data += [
                'pivot' => $this->laporan_model->getpivot($this->session->userdata('tdc')),
                'awal' => $start,
                'akhir' => $end
            ];

            if ($data['pivot'])
            {
                $this->load->view('indirect/pdf_export', $data);
            }
            else
            {
                $this->session->set_flashdata('error', $this->db->error());
                $this->load->view('indirect/laporan');
            }
        }
        if (isset($post['xls']) ? $post['xls'] : "")
        {
            $this->export($start, $end);
        }
    }

    public function export($start, $end)
    {
        $export = $this->laporan_model->getpivot($this->session->userdata('tdc'));
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
            ->setCellValue('A1', 'Bulan')
            ->setCellValue('B1', 'Nama Marketing')
            ->setCellValue('C1', 'Nama Outlet')
            ->setCellValue('D1', 'Total As')
            ->setCellValue('E1', 'Total Simpati')
            ->setCellValue('F1', 'Total Loop')
            ->setCellValue('G1', 'Total NSB')
            ->setCellValue('H1', 'Total MKIOS Reguler')
            ->setCellValue('I1', 'Total MKIOS Bulk')
            ->setCellValue('J1', 'Total GT Pulsa');

        $i = 2;
        $curr = "";
        $prev = "";
        $len = count($export);
        foreach ($export as $ex => $e)
        {
            $curr = $e['bulan'];
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , $ex == $len - 1 ? "Total" : ($curr != $prev ? $curr : ""))
                ->setCellValue('B'. $i , $e['nama_marketing'])
                ->setCellValue('C'. $i , $e['nama_outlet'])
                ->setCellValue('D'. $i , $e['sum_of_as'])
                ->setCellValue('E'. $i , $e['sum_of_simpati'])
                ->setCellValue('F'. $i , $e['sum_of_loop'])
                ->setCellValue('G'. $i , $e['sum_of_nsb'])
                ->setCellValue('H'. $i , $e['sum_of_mkios_reguler'])
                ->setCellValue('I'. $i , $e['sum_of_mkios_bulk'])
                ->setCellValue('J'. $i , $e['sum_of_gt_pulsa']);
            $prev = $curr;
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