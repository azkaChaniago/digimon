<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Historiorder extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('historiorder_model');
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
        // $data['posts'] = $this->historiorder_model->getAll();
        $data = $this->userSession();
        $data += [
            'histori' => $this->historiorder_model->getHistori(),
        ];
        $this->load->view('admin/historiorder/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $histori = $this->historiorder_model;
        $validation = $this->form_validation;
        $validation->set_rules($histori->rules());   

        if ($validation->run())
        {
            $histori->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');   
            redirect(site_url('admin/historiorder'));
        }
        // else if (!$validation->run())
        // {
        //     echo validation_errors();
        // }
        // $data = $this->userSession();
        $data['users'] = $this->historiorder_model->userList();
        $data['marketing'] = $this->historiorder_model->getThisTableRecord('tbl_marketing');
        $data['outlet'] = $this->historiorder_model->getThisTableRecord('tbl_outlet');
        $this->load->view('admin/historiorder/new_form', $data);
    }

    // public function addProcess()
    // {
    //     $histori = $this->historiorder_model;
    //     $histori->save();
    //     echo "good";    

    // }

    public function edit($id=null)
    {
        is_logged_in();
        if (!isset($id)) redirect('admin/historiorder');

        $histori = $this->historiorder_model;
        $validation = $this->form_validation;
        $validation->set_rules($histori->rules());

        if ($validation->run())
        {
            $histori->update($id);
            $this->session->set_flashdata('success', 'Berhasil diperbarui');
            redirect(site_url('admin/historiorder'));
        }

        $data = $this->userSession();
        $data += [
            'histori' => $histori->getById($id),
            'users' => $histori->userList(),
            'outlet' => $histori->getThisTableRecord('tbl_outlet'),
            'marketing' => $histori->getThisTableRecord('tbl_marketing'),
        ];

        if (!$data['histori']) show_404();

        $this->load->view('admin/historiorder/edit_form', $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->historiorder_model->delete($id))
        {
            redirect(site_url('admin/historiorder'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['histori'] = $this->historiorder_model->getDetail($id);
        $this->load->view('admin/historiorder/detail', $data);
    }
}