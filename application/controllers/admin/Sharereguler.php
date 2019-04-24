<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sharereguler extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sharereguler_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function userSession()
    {   
        $data = array(
            'status' => $this->session->userdata('login'),
            'access' => $this->session->userdata('access'),
            'id' => $this->session->userdata('id'),
            'user' => $this->session->userdata('user')
        );

        return $data;
    }

    public function index()
    {
        is_logged_in();
        // $data['posts'] = $this->sharereguler_model->getAll();
        $data = $this->userSession();
        $data += [
            'sharereguler' => $this->sharereguler_model->getAll(),
        ];
        $this->load->view('admin/sharereguler/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $sharereguler = $this->sharereguler_model;
        $validation = $this->form_validation;
        $validation->set_rules($sharereguler->rules());   

        if ($validation->run())
        {
            $sharereguler->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');  
            redirect(site_url('admin/sharereguler')); 
        }
        // else if (!$validation->run())
        // {
        //     echo validation_errors();
        // }
        // $data = $this->userSession();
        // $data['users'] = $this->sharereguler_model->userList();
        $this->load->view('admin/sharereguler/new_form');
    }

    // public function addProcess()
    // {
    //     sharereguler = $this->sharereguler_model;
    //     sharereguler->save();
    //     echo "good";    

    // }

    public function edit($id=null)
    {
        is_logged_in();
        if (!isset($id)) redirect('admin/sharereguler');

        $sharereguler = $this->sharereguler_model;
        $validation = $this->form_validation;
        $validation->set_rules($sharereguler->rules());

        if ($validation->run())
        {
            $sharereguler->update($id);
            $this->session->set_flashdata('success', 'Berhasil diperbarui');
            redirect(site_url('admin/sharereguler'));
        }

        $data = $this->userSession();
        $data += [
            'sharereguler' => $sharereguler->getById($id),
        ];

        if (!$data['sharereguler']) show_404();

        $this->load->view('admin/sharereguler/edit_form', $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->sharereguler_model->delete($id))
        {
            redirect(site_url('admin/sharereguler'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['sharereg'] = $this->sharereguler_model->getDetail($id);
        $this->load->view('admin/sharereguler/detail', $data);
    }
}