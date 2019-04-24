<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Saleling extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('saleling_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        is_logged_in();
        
        $data['saleling'] = $this->saleling_model->getRelated();
        $this->load->view('admin/direct/saleling/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $saleling = $this->saleling_model;
        $validation = $this->form_validation;
        $validation->set_rules($saleling->rules());

        if ($validation->run())
        {
            $saleling->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('direct/saleling'));
        }
        // else
        // {
        //     echo validation_errors();
        // }
        $data['saleling'] = $this->saleling_model->getAll();
        $data['tdc'] = $this->saleling_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->saleling_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->saleling_model->getThisTableRecord('tbl_user');
        $this->load->view('admin/direct/saleling/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('admin/direct/tdc');
        
        $saleling = $this->saleling_model;
        $validation = $this->form_validation;
        $validation->set_rules($saleling->rules());

        if ($validation->run())
        {
            $saleling->update($id);
            $this->session->set_flashdata('success', 'Berhasil diubah');
            redirect(site_url('direct/saleling'));
        }
        // else
        // {
        //     echo validation_errors();
        // }

        $data['saleling'] = $saleling->getById($id);
        $data['related'] = $saleling->getRelated();
        $data['tdc'] = $this->saleling_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->saleling_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->saleling_model->getThisTableRecord('tbl_user');
        if (!$data['saleling']) show_404();

        $this->load->view('admin/direct/saleling/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->saleling_model->delete($id))
        {
            redirect(site_url('direct/saleling'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['saleling'] = $this->saleling_model->getDetail($id);
        $this->load->view('admin/direct/saleling/detail', $data);
    }

}