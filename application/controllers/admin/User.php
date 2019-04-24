<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        is_logged_in();
        
        $data['user'] = $this->users_model->getAll();        
        $data['tdc'] = $this->users_model->hasEmptyField('tbl_tdc', 'kode_user');
        $this->load->view('admin/users/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $user = $this->users_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run())
        {
            $user->save();
            // if (!$user->save())
            // {
            //     $this->session->set_flashdata('error', validation_errors());
            //     redirect(site_url('admin/user/add'));
            // }
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/user'));
        }

        $data['user'] = $this->users_model->getTDC();
        $data['tdc'] = $this->users_model->getThisTableRecord('tbl_tdc');
        $data['empty'] = $this->users_model->hasEmptyField('tbl_tdc', 'kode_user');
        $this->load->view('admin/users/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('admin/user');
        
        $user = $this->users_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run())
        {
            $user->update($id);
            $this->session->set_flashdata('success', 'Berhasil diubah');
            redirect(site_url('admin/user'));
        }

        $data['user'] = $user->getById($id);
        $data['tdc'] = $user->getThisTableRecord('tbl_tdc');
        $data['empty'] = $this->users_model->hasEmptyField('tbl_tdc', 'kode_user');
        if (!$data['user']) show_404();

        $this->load->view('admin/users/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->users_model->delete($id))
        {
            redirect(site_url('admin/user'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['user'] = $this->users_model->getDetail($id);
        $this->load->view('admin/users/detail', $data);
    }

}