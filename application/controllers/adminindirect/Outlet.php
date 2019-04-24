<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Outlet extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('coverage_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
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
        $data['outlet'] = $this->coverage_model->getThisTableRecord('tbl_outlet');
        $this->load->view('adminindirect/outlet/list', $data);
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['outlet'] = $this->coverage_model->getDetail($id);
        $this->load->view('adminindirect/outlet/detail', $data);
    }

}



// Line Number: 33

// Backtrace:

// File: E:\xampp\htdocs\digimon\application\controllers\adminindirect\Outlet.php
// Line: 33
// Function: _error_handler

// File: E:\xampp\htdocs\digimon\index.php
// Line: 315