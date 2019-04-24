<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hvc extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('hvc_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        is_logged_in();
        
        $data['hvc'] = $this->hvc_model->getRelated();
        $this->load->view('admin/direct/hvc/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $hvc = $this->hvc_model;
        $validation = $this->form_validation;
        $validation->set_rules($hvc->rules());

        if ($validation->run())
        {
            $hvc->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('direct/hvc'));
        }
        // else
        // {
        //     echo validation_errors();
        // }
        $data['hvc'] = $this->hvc_model->getAll();
        $data['tdc'] = $this->hvc_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->hvc_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->hvc_model->getThisTableRecord('tbl_user');
        $this->load->view('admin/direct/hvc/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('admin/direct/tdc');
        
        $hvc = $this->hvc_model;
        $validation = $this->form_validation;
        $validation->set_rules($hvc->rules());

        if ($validation->run())
        {
            $hvc->update($id);
            $this->session->set_flashdata('success', 'Berhasil diubah');
            redirect(site_url('direct/hvc'));
        }
        // else
        // {
        //     echo validation_errors();
        // }

        $data['hvc'] = $hvc->getById($id);
        $data['related'] = $hvc->getRelated();
        $data['tdc'] = $this->hvc_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->hvc_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->hvc_model->getThisTableRecord('tbl_user');
        if (!$data['hvc']) show_404();

        $this->load->view('admin/direct/hvc/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->hvc_model->delete($id))
        {
            redirect(site_url('direct/hvc'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['hvc'] = $this->hvc_model->getDetail($id);
        $this->load->view('admin/direct/hvc/detail', $data);
    }

}