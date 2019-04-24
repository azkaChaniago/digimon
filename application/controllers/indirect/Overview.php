<?php

class Overview extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        is_logged_in();
        
        $data = array(
            'status' => $this->session->userdata('login'),
            'access' => $this->session->userdata('access'),
            'id' => $this->session->userdata('id'),
            'user' => $this->session->userdata('user'),
            'chart' => $this->admin_model->getRelated(),
        );

        $this->load->view('admin/overview', $data);
    }
}