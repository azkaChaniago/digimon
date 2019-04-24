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

    public function index()
    {
        is_logged_in();
        
        $data['outlet'] = $this->coverage_model->getAll();
        $this->load->view('admin/outlet/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $user = $this->coverage_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run())
        {
            $user->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/outlet'));
        }
        // else
        // {
        //     $this->session->set_flashdata('error', validation_errors());
        //     redirect(site_url('admin/outlet/add'));
        // }
        $data['outlet'] = $this->coverage_model->getAll();
        $data['marketing'] = $this->coverage_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->coverage_model->getThisTableRecord('tbl_user');
        $data['tdc'] = $this->coverage_model->getThisTableRecord('tbl_tdc');
        $this->load->view('admin/outlet/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('admin/outlet');
        
        $user = $this->coverage_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run())
        {
            $user->update($id);
            $this->session->set_flashdata('success', 'Berhasil diubah');
            redirect(site_url('admin/outlet'));
        }
        // else
        // {
        //     echo validation_errors();
        // }

        $data['outlet'] = $user->getById($id);
        $data['related'] = $user->getRelated();
        $data['marketing'] = $this->coverage_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->coverage_model->getThisTableRecord('tbl_user');
        $data['tdc'] = $this->coverage_model->getThisTableRecord('tbl_tdc');
        if (!$data['outlet']) show_404();

        $this->load->view('admin/outlet/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->coverage_model->delete($id))
        {
            redirect(site_url('admin/outlet'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['outlet'] = $this->coverage_model->getDetail($id);
        $this->load->view('admin/outlet/detail', $data);
    }

}