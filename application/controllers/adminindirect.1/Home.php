<?php

class Home extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index()
    {
        is_logged_in();
        $post = $this->input->post();
        $bulan = date('F');
        $tdc = $this->session->userdata('tdc');
        
        if(isset($post['kode_tdc']) && isset($post['tanggal']))
        {
            $awal = date('Y-m-01', strtotime($post['tanggal']));
            $akhir = date('Y-m-t', strtotime($post['tanggal']));
            $kpi_canvasser = $this->admin_model->getCanvasserKPI($awal, $akhir, $post['kode_tdc'], 'canvasser');
        }
        else if (isset($post['tampil_can']))
        {
            $awal = date('Y-m-d', strtotime($post['awal']));
            $akhir = date('Y-m-d', strtotime($post['akhir']));
            $kpi_canvasser = $this->admin_model->getAllCanvasserKPI($awal, $akhir);        
        }
        else
        {
            $awal = date('Y-m-01');
            $akhir = date('Y-m-t');
            $kpi_canvasser = $this->admin_model->getAllCanvasserKPI($awal, $akhir);
        }

        if(isset($post['kode_tdc']) && isset($post['tanggal']))
        {
            $awal = date('Y-m-01', strtotime($post['tanggal']));
            $akhir = date('Y-m-t', strtotime($post['tanggal']));
            $kpi_collector = $this->admin_model->getCollectorKPI($awal, $akhir, $post['kode_tdc'], 'collector');
        }
        else if (isset($post['tampil_col']))
        {
            $awal = date('Y-m-d', strtotime($post['awal']));
            $akhir = date('Y-m-d', strtotime($post['akhir']));
            $kpi_collector = $this->admin_model->getAllCollectorKPI($awal, $akhir);        
        }
        else
        {
            $awal = date('Y-m-01');
            $akhir = date('Y-m-t');
            $kpi_collector = $this->admin_model->getAllCollectorKPI($awal, $akhir);
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

        $this->load->view('adminindirect/home', $data);
    }

    public function canPerformance()
    {
        $post = $this->input->post();
        $tdc = $post['kode_marketing'];
        $bulan = $post['bulan'];
        $tahun = $post['tahun'];
        $condition = array('year(tanggal)' =>  $tahun,'monthname(tanggal)' => $bulan, 'kode_marketing' => $tdc);
        
        $data['perform'] = $this->admin_model->performanceCanvasser($tdc, $bulan);
        $data['targetassignment'] = $this->admin_model->getThisTableRecord('tbl_target_assignment', $condition);
        $data['scorecard'] = $this->admin_model->getThisTableRecord('tbl_score_card', $condition);

        if ($data['perform'])
        {
            $this->load->view('adminindirect/home_can_kpi', $data);
        }
        else 
        {            
            $this->session->set_flashdata('error', $this->db->error() . $awal . $akhir . $tdc);
            $this->load->view('adminindirect/home');
        }
    }

    public function colPerformance()
    {
        $post = $this->input->post();
        $tdc = $post['kode_marketing'];
        $bulan = $post['bulan'];
        $tahun = $post['tahun'];
        $condition = array('year(tanggal)' =>  $tahun,'monthname(tanggal)' => $bulan, 'kode_marketing' => $tdc);

        $data['perform'] = $this->admin_model->performanceCollector($tdc, $bulan);
        $data['targetassignment'] = $this->admin_model->getThisTableRecord('tbl_target_assignment_collector', $condition);
        $data['scorecard'] = $this->admin_model->getThisTableRecord('tbl_score_card_collector', $condition);
        
        if ($data['perform'])
        {
            $this->load->view('adminindirect/home_col_kpi', $data);
        }
        else 
        {
            $this->session->set_flashdata('error', $this->db->error());
            $this->load->view('adminindirect/home');
        }
    }

}
