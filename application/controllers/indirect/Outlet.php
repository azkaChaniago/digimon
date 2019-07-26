<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Outlet extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('coverage_model');
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
        $conditions = array('kode_tdc' => $data['tdc']);
        $data['outlet'] = $this->coverage_model->getThisTableRecord('tbl_outlet', $conditions);
        $this->load->view('indirect/outlet/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $user = $this->coverage_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run())
        {
            $user->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('indirect/outlet'));
        }
        // else
        // {
        //     $this->session->set_flashdata('error', validation_errors());
        //     redirect(site_url('indirect/outlet/add'));
        // }
        $data['outlet'] = $this->coverage_model->getAll();
        $data['marketing'] = $this->coverage_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->coverage_model->getThisTableRecord('tbl_user');
        $data['tdc'] = $this->coverage_model->getThisTableRecord('tbl_tdc');
        $this->load->view('indirect/outlet/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();

        if (!isset($id)) redirect('indirect/outlet');
        
        $user = $this->coverage_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run())
        {
            $user->update($id);
            $this->session->set_flashdata('success', 'Berhasil diubah'); 
            redirect(site_url('indirect/outlet/'));
        }

        $data['outlet'] = $user->getById($id);
        $data['related'] = $user->getRelated();
        $data['marketing'] = $this->coverage_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->coverage_model->getThisTableRecord('tbl_user');
        $data['tdc'] = $this->coverage_model->getThisTableRecord('tbl_tdc');

        if (!$data['outlet']) show_404();

        $this->load->view('indirect/outlet/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->coverage_model->delete($id))
        {
            redirect(site_url('indirect/outlet'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['outlet'] = $this->coverage_model->getDetail($id);
        $this->load->view('indirect/outlet/detail', $data);
    }

    public function fetchperiode()
    {
        $post = $this->input->post();
        if (isset($post['pdf']))
        {
            $start = date('Y-m-d', strtotime($post['start']));
            $end = date('Y-m-d', strtotime($post['end']));
            $this->exportpdf();
        }
        else if (isset($post['xls']))
        {
            $start = date('Y-m-d', strtotime($post['start']));
            $end = date('Y-m-d', strtotime($post['end']));
            $this->export();
        }
    }

    public function exportpdf()
    {
        $data = $this->userSession();
        // $conditions = array('kode_tdc' => $data['tdc']);     
        $data = $this->userSession();
        $data += [
            'outlet' => $this->coverage_model->getRelated($data['tdc'])
        ];

        $this->load->view('indirect/outlet/pdf_export', $data);
    }

    public function export()
    {
        $data = $this->userSession();
        // $conditions = array('kode_tdc' => $data['tdc']);
        $export = $this->coverage_model->getRelated($data['tdc']);
        $spreadsheet = new Spreadsheet();

        $spreadsheet->getProperties()
            ->setCreator('Digimon')
            ->setLastModifiedBy($this->session->userdata('user'))
            ->setTitle('Laporan Outlet')
            ->setSubject('Laporan Outlet')
            ->setDescription('Eksport Outlet')
            ->setKeywords('Outlet')
            ->setCategory('Outlet');

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama_Outlet')
            ->setCellValue('B1', 'Kabupaten')
            ->setCellValue('C1', 'Kecamatan')
            ->setCellValue('D1', 'Alamat')
            ->setCellValue('E1', 'Nama_Pemilik')
            ->setCellValue('F1', 'Nomor_HP')
            ->setCellValue('G1', 'Kode_Marketing')
            ->setCellValue('H1', 'Hari_Kunjungan')
            ->setCellValue('I1', 'Kode_TDC')
            ->setCellValue('J1', 'Nomor_RS')
            ->setCellValue('K1', 'Kategori_Outlet');

        $i = 2;
        foreach ($export as $ex)
        {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'. $i , $ex->nama_outlet)
                ->setCellValue('B'. $i , $ex->kabupaten)
                ->setCellValue('C'. $i , $ex->kecamatan)
                ->setCellValue('D'. $i , $ex->alamat)
                ->setCellValue('E'. $i , $ex->nama_pemilik)
                ->setCellValue('F'. $i , $ex->no_hp)
                ->setCellValue('G'. $i , $ex->kode_marketing)
                ->setCellValue('H'. $i , $ex->hari_kunjungan)
                ->setCellValue('I'. $i , $ex->kode_tdc)
                ->setCellValue('J'. $i , $ex->nomor_rs)
                ->setCellValue('K'. $i , $ex->kategori_outlet);
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

    public function import()
    {
        if(!empty($_FILES['import']['name'])) { 
            // get file extension
            $extension = pathinfo($_FILES['import']['name'], PATHINFO_EXTENSION);

            if($extension == 'csv'){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } elseif($extension == 'xlsx') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }
            // file path
            $spreadsheet = $reader->load($_FILES['import']['tmp_name']);
            $allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        
            // array Count
            $arrayCount = count($allDataInSheet);
            // die(print_r($arrayCount));
            $flag = 0;            
            $createArray = array(
                'Nama_Outlet',
                'Kabupaten',
                'Kecamatan',
                'Alamat',
                'Nama_Pemilik',
                'Nomor_HP',
                'Kode_Marketing',
                'Hari_Kunjungan',
                'Kode_TDC',
                'Nomor_RS',
                'Kategori_Outlet'
            );
            $makeArray = array(
                'Nama_Outlet' => 'Nama_Outlet',
                'Kabupaten' => 'Kabupaten',
                'Kecamatan' => 'Kecamatan',
                'Alamat' => 'Alamat',
                'Nama_Pemilik' => 'Nama_Pemilik',
                'Nomor_HP' => 'Nomor_HP',
                'Kode_Marketing' => 'Kode_Marketing',
                'Hari_Kunjungan' => 'Hari_Kunjungan',
                'Kode_TDC' => 'Kode_TDC',
                'Nomor_RS' => 'Nomor_RS',
                'Kategori_Outlet' => 'Kategori_Outlet'
            );
            $SheetDataKey = array();
            foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                    if (in_array(trim($value), $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[trim($value)] = $key;
                    } 
                }
            }

            $dataDiff = array_diff_key($makeArray, $SheetDataKey);
            if (empty($dataDiff)) {
                $flag = 1;
            }
            // match excel sheet column
            if ($flag == 1) {
                for ($i = 2; $i <= $arrayCount; $i++) {
                    $addresses = array();
                    $nama_outlet = $SheetDataKey['Nama_Outlet'];
                    $kabupaten = $SheetDataKey['Kabupaten'];
                    $kecamatan = $SheetDataKey['Kecamatan'];
                    $alamat = $SheetDataKey['Alamat'];
                    $nama_pemilik = $SheetDataKey['Nama_Pemilik'];
                    $no_hp = $SheetDataKey['Nomor_HP'];
                    $kode_marketing = $SheetDataKey['Kode_Marketing'];
                    $hari_kunjungan = $SheetDataKey['Hari_Kunjungan'];
                    $kode_tdc = $SheetDataKey['Kode_TDC'];
                    $nomor_rs = $SheetDataKey['Nomor_RS'];
                    $kategori_outlet = $SheetDataKey['Kategori_Outlet'];
                    
                    $nama_outlet = filter_var(trim($allDataInSheet[$i][$nama_outlet]), FILTER_SANITIZE_STRING);
                    $kabupaten = filter_var(trim($allDataInSheet[$i][$kabupaten]), FILTER_SANITIZE_STRING);
                    $kecamatan = filter_var(trim($allDataInSheet[$i][$kecamatan]), FILTER_SANITIZE_STRING);
                    $alamat = filter_var(trim($allDataInSheet[$i][$alamat]), FILTER_SANITIZE_STRING);
                    $nama_pemilik = filter_var(trim($allDataInSheet[$i][$nama_pemilik]), FILTER_SANITIZE_STRING);
                    $no_hp = filter_var(trim($allDataInSheet[$i][$no_hp]), FILTER_SANITIZE_STRING);
                    $kode_marketing = filter_var(trim($allDataInSheet[$i][$kode_marketing]), FILTER_SANITIZE_STRING);
                    $hari_kunjungan = filter_var(trim($allDataInSheet[$i][$hari_kunjungan]), FILTER_SANITIZE_STRING);
                    $kode_tdc = filter_var(trim($allDataInSheet[$i][$kode_tdc]), FILTER_SANITIZE_STRING);
                    $nomor_rs = filter_var(trim($allDataInSheet[$i][$nomor_rs]), FILTER_SANITIZE_STRING);
                    $kategori_outlet = filter_var(trim($allDataInSheet[$i][$kategori_outlet]), FILTER_SANITIZE_STRING);

                    $fetchData[] = array(
                        'nama_outlet' => $nama_outlet,
                        'kabupaten' => $kabupaten,
                        'kecamatan' => $kecamatan,
                        'alamat' => $alamat,
                        'nama_pemilik' => $nama_pemilik,
                        'no_hp' => $no_hp,
                        'kode_marketing' => $kode_marketing,
                        'hari_kunjungan' => $hari_kunjungan,
                        'kode_tdc' => $kode_tdc,
                        'nomor_rs' => $nomor_rs,
                        'kategori_outlet' => $kategori_outlet,
                    );
                }   
                $data['dataInfo'] = $fetchData;
                $filtered = array_filter($fetchData, function($v){return array_filter($v) != array();});
                $test = array();
                foreach ($filtered as $f => $filt) {
                    $temp = $filt + array('id_outlet' => $this->coverage_model->generateKodeOutlet($f+1), 'kode_user' => $this->session->userdata('id'));
                    array_push($test, $temp);
                    $temp = null;
                }
                $this->coverage_model->setBatchImport($test);
                $this->coverage_model->importData();
            } else {
                echo "Please import correct file, did not match excel sheet column";
            }
            // $this->load->view('indirect/outlet/list', $data);
            redirect(site_url('indirect/outlet'));
        }
    }

    // checkFileValidation
    public function checkFileValidation($string) 
    {
        $file_mimes = array('text/x-comma-separated-values', 
            'text/comma-separated-values', 
            'application/octet-stream', 
            'application/vnd.ms-excel', 
            'application/x-csv', 
            'text/x-csv', 
            'text/csv', 
            'application/csv', 
            'application/excel', 
            'application/vnd.msexcel', 
            'text/plain', 
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        if(isset($_FILES['fileURL']['name'])) {
            $arr_file = explode('.', $_FILES['fileURL']['name']);
            $extension = end($arr_file);
            if(($extension == 'xlsx' || $extension == 'xls' || $extension == 'csv') && in_array($_FILES['fileURL']['type'], $file_mimes)){
                return true;
            }else{
                $this->form_validation->set_message('checkFileValidation', 'Please choose correct file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('checkFileValidation', 'Please choose a file.');
            return false;
        }
    }

}

