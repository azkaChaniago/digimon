<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualanharian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('penjualanharian_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        is_logged_in();
        
        $data['penjualanharian'] = $this->penjualanharian_model->getRelated();
        $this->load->view('admin/direct/penjualanharian/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $penjualanharian = $this->penjualanharian_model;
        $validation = $this->form_validation;
        $validation->set_rules($penjualanharian->rules());

        if ($validation->run())
        {
            $penjualanharian->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('direct/penjualanharian'));
        }
        // else
        // {
        //     echo validation_errors();
        // }
        $data['penjualanharian'] = $this->penjualanharian_model->getAll();
        $data['tdc'] = $this->penjualanharian_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->penjualanharian_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->penjualanharian_model->getThisTableRecord('tbl_user');
        $this->load->view('admin/direct/penjualanharian/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('admin/direct/tdc');
        
        $penjualanharian = $this->penjualanharian_model;
        $validation = $this->form_validation;
        $validation->set_rules($penjualanharian->rules());

        if ($validation->run())
        {
            $penjualanharian->update($id);
            $this->session->set_flashdata('success', 'Berhasil diubah');
            redirect(site_url('direct/penjualanharian'));
        }
        // else
        // {
        //     echo validation_errors();
        // }

        $data['penjualanharian'] = $penjualanharian->getById($id);
        $data['related'] = $penjualanharian->getRelated();
        $data['tdc'] = $this->penjualanharian_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->penjualanharian_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->penjualanharian_model->getThisTableRecord('tbl_user');

        $this->load->view('admin/direct/penjualanharian/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->penjualanharian_model->delete($id))
        {
            redirect(site_url('direct/penjualanharian'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['penjualanharian'] = $this->penjualanharian_model->getDetail($id);
        $this->load->view('admin/direct/penjualanharian/detail', $data);
    }

}