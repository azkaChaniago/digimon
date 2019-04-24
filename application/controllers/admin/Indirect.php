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
        $indirect = $this->admin_model;
        $post = $this->input->post();
        // $div = $this->input->post['divisi'];
        // $lim = $this->input->post['limit'];

        $data = array(
            'status' => $this->session->userdata('login'),
            'access' => $this->session->userdata('access'),
            'id' => $this->session->userdata('id'),
            'user' => $this->session->userdata('user'),
            'chart' => $this->admin_model->getIndirectPerformance(),
            //'store' => $this->db->query("CALL performance('pogba','February')")->row(),
            // 'canvasser' => $this->admin_model->compare('canvasser', 5),
            // 'collector' => $this->admin_model->compare('collector', 5),
        );

        if(isset($post['send']) ? $post['send'] : "")
        {
            $data['canvasser'] = $indirect->compare();
        }

        if(isset($post['sendEmp']) ? $post['sendEmp'] : "")
        {
            $data['performance'] = $indirect->performance();
        }

        $this->load->view('admin/indirect', $data);
    }

}