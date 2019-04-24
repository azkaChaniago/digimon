<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Komunitas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('komunitas_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        is_logged_in();
        
        $data['komunitas'] = $this->komunitas_model->getRelated();
        $this->load->view('direct/komunitas/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $komunitas = $this->komunitas_model;
        $validation = $this->form_validation;
        $validation->set_rules($komunitas->rules());

        if ($validation->run())
        {
            $komunitas->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('direct/komunitas'));
        }
        // else
        // {
        //     echo validation_errors();
        // }
        $data['komunitas'] = $this->komunitas_model->getAll();
        $data['tdc'] = $this->komunitas_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->komunitas_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->komunitas_model->getThisTableRecord('tbl_user');
        $this->load->view('direct/komunitas/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('direct/komunitas');
        
        $komunitas = $this->komunitas_model;
        $validation = $this->form_validation;
        $validation->set_rules($komunitas->rules());

        if ($validation->run())
        {
            $komunitas->update($id);
            $this->session->set_flashdata('success', 'Berhasil diubah');
            redirect(site_url('direct/komunitas'));
        }
        // else
        // {
        //     echo validation_errors();
        // }

        $data['komunitas'] = $komunitas->getById($id);
        $data['related'] = $komunitas->getRelated();
        $data['tdc'] = $this->komunitas_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->komunitas_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->komunitas_model->getThisTableRecord('tbl_user');
        if (!$data['komunitas']) show_404();

        $this->load->view('direct/komunitas/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->komunitas_model->delete($id))
        {
            redirect(site_url('direct/komunitas'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['komunitas'] = $this->komunitas_model->getDetail($id);
        $this->load->view('direct/komunitas/detail', $data);
    }

}