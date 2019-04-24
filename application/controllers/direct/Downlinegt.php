<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Downlinegt extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('downlinegt_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        is_logged_in();
        
        $data['downlinegt'] = $this->downlinegt_model->getRelated();
        $this->load->view('direct/downlinegt/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $downlinegt = $this->downlinegt_model;
        $validation = $this->form_validation;
        $validation->set_rules($downlinegt->rules());

        if ($validation->run())
        {
            $downlinegt->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            $this->load->view('direct/downlinegt/detail', $data);
        }
        // else
        // {
        //     echo validation_errors();
        // }
        $data['downlinegt'] = $this->downlinegt_model->getAll();
        $data['tdc'] = $this->downlinegt_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->downlinegt_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->downlinegt_model->getThisTableRecord('tbl_user');
        $this->load->view('direct/downlinegt/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('direct/tdc');
        
        $downlinegt = $this->downlinegt_model;
        $validation = $this->form_validation;
        $validation->set_rules($downlinegt->rules());

        if ($validation->run())
        {
            $downlinegt->update($id);
            $this->session->set_flashdata('success', 'Berhasil diubah');
            $this->load->view('direct/downlinegt/detail', $data);
        }
        // else
        // {
        //     echo validation_errors();
        // }

        $data['downlinegt'] = $downlinegt->getById($id);
        $data['related'] = $downlinegt->getRelated();
        $data['tdc'] = $this->downlinegt_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->downlinegt_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->downlinegt_model->getThisTableRecord('tbl_user');
        if (!$data['downlinegt']) show_404();

        $this->load->view('direct/downlinegt/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->downlinegt_model->delete($id))
        {
            redirect(site_url('direct/downlinegt'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['downlinegt'] = $this->downlinegt_model->getDetail($id);
        $this->load->view('direct/downlinegt/detail', $data);
    }

}