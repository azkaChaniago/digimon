<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TDC extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('tdc_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        is_logged_in();
        
        $data['tdc'] = $this->tdc_model->getAll();
        $this->load->view('admin/tdc/list', $data);
    }

    public function add()
    {
        is_logged_in();
        
        $user = $this->tdc_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run())
        {
            $user->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('admin/tdc'));
        }
        // else
        // {
        //     echo validation_errors();
        // }
        $data['tdc'] = $this->tdc_model->getAll();
        $data['user'] = $this->tdc_model->getThisTableRecord('tbl_user');
        $this->load->view('admin/tdc/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('admin/tdc');
        
        $user = $this->tdc_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run())
        {
            $user->update($id);
            $this->session->set_flashdata('success', 'Berhasil diubah');
            redirect(site_url('admin/tdc'));
        }
        // else
        // {
        //     echo validation_errors();
        // }

        $data['tdc'] = $user->getById($id);
        $data['related'] = $user->getRelated();
        $data['user'] = $this->tdc_model->getThisTableRecord('tbl_user');
        if (!$data['tdc']) show_404();

        $this->load->view('admin/tdc/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->tdc_model->delete($id))
        {
            redirect(site_url('admin/tdc'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['tdc'] = $this->tdc_model->getDetail($id);
        $this->load->view('admin/tdc/detail', $data);
    }

}