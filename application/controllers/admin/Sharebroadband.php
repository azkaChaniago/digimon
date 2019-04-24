<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sharebroadband extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sharebroadband_model');
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
        // $data['posts'] = $this->sharebroadband_model->getAll();
        $data = $this->userSession();
        $data += [
            'sharebroadband' => $this->sharebroadband_model->getAll(),
        ];
        $this->load->view('admin/sharebroadband/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $sharebroadband = $this->sharebroadband_model;
        $validation = $this->form_validation;
        $validation->set_rules($sharebroadband->rules());   

        if ($validation->run())
        {
            $sharebroadband->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');   
            redirect(site_url('admin/sharebroadband'));
        }
        // else if (!$validation->run())
        // {
        //     echo validation_errors();
        // }
        // $data = $this->userSession();
        // $data['users'] = $this->sharebroadband_model->userList();
        $this->load->view('admin/sharebroadband/new_form');
    }

    // public function addProcess()
    // {
    //     sharebroadband = $this->sharebroadband_model;
    //     sharebroadband->save();
    //     echo "good";    

    // }

    public function edit($id=null)
    {
        is_logged_in();
        if (!isset($id)) redirect('admin/sharebroadband');

        $sharebroadband = $this->sharebroadband_model;
        $validation = $this->form_validation;
        $validation->set_rules($sharebroadband->rules());

        if ($validation->run())
        {
            $sharebroadband->update($id);
            $this->session->set_flashdata('success', 'Berhasil diperbarui');
            redirect(site_url('admin/sharebroadband'));
        }

        $data = $this->userSession();
        $data += [
            'sharebroadband' => $sharebroadband->getById($id),
        ];

        if (!$data['sharebroadband']) show_404();

        $this->load->view('admin/sharebroadband/edit_form', $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();

        if ($this->sharebroadband_model->delete($id))
        {
            redirect(site_url('admin/sharebroadband'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['sharebroad'] = $this->sharebroadband_model->getDetail($id);
        $this->load->view('admin/sharebroadband/detail', $data);
    }

}