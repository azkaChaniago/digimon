<?php

class Direct extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index()
    {
        is_logged_in();
        
        $data = array(
            'status' => $this->session->userdata('login'),
            'access' => $this->session->userdata('access'),
            'id' => $this->session->userdata('id'),
            'user' => $this->session->userdata('user'),
            'direct' => $this->admin_model->getDirectPerformance()
        );
        $this->load->view('admindirect/direct', $data);
    }
}