<?php

class Indirect extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index()
    {
        is_logged_in();
        $bulan = date('F');
        $tdc = $this->session->userdata('tdc');
        
        if (isset($_POST['tampil_can']))
        {
            $awal = date('Y-m-d', strtotime($_POST['awal']));
            $akhir = date('Y-m-d', strtotime($_POST['akhir']));
            $kpi_canvasser = $this->admin_model->getCanvasserKPI($awal, $akhir, $tdc, 'canvasser');        
        }
        else
        {
            $awal = date('Y-m-01');
            $akhir = date('Y-m-t');
            $kpi_canvasser = $this->admin_model->getCanvasserKPI($awal, $akhir, $tdc, 'canvasser');
        }

        if (isset($_POST['tampil_col']))
        {
            $awal = date('Y-m-d', strtotime($_POST['awal']));
            $akhir = date('Y-m-d', strtotime($_POST['akhir']));
            $kpi_collector = $this->admin_model->getCollectorKPI($awal, $akhir, $tdc, 'collector');        
        }
        else
        {
            $awal = date('Y-m-01');
            $akhir = date('Y-m-t');
            $kpi_collector = $this->admin_model->getCollectorKPI($awal, $akhir, $tdc, 'collector');
        }

        $data = array(
            'status' => $this->session->userdata('login'),
            'access' => $this->session->userdata('access'),
            'id' => $this->session->userdata('id'),
            'user' => $this->session->userdata('user'),
            'kpi_canvasser' => $kpi_canvasser,
            'kpi_collector' => $kpi_collector
            // 'perform' => $this->admin_model->performance($div, $lim),
        );

        $this->load->view('indirect/indirect', $data);
    }

    public function canPerformance($nama, $bulan)
    {
        $nama = str_replace('%20', ' ', $nama);
        $data['perform'] = $this->admin_model->performanceCanvasser($nama, $bulan);
        $data['nama'] = str_replace(' ', '%20', $nama);
        
        if ($data['perform'])
        {
            $this->load->view('indirect/indirect_perform', $data);    
            // exit();
        }
        else 
        {
            $this->session->set_flashdata('error', $this->db->_error_message());
            $this->load->view('indirect/indirect');
        }
    }

    public function colPerformance($nama, $bulan)
    {
        $nama = str_replace('%20', ' ', $nama);
        $data['perform'] = $this->admin_model->performanceCollector($nama, $bulan);
        $data['nama'] = str_replace(' ', '%20', $nama);
        
        if ($data['perform'])
        {
            $this->load->view('indirect/indirect_perform_col', $data);    
            // exit();
        }
        else 
        {
            $this->session->set_flashdata('error', $this->db->_error_message());
            $this->load->view('indirect/indirect');
        }
    }

}