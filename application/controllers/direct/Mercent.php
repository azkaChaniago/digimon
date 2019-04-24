<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mercent extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mercent_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        is_logged_in();
        
        $data['mercent'] = $this->mercent_model->getRelated();
        $this->load->view('direct/mercent/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $mercent = $this->mercent_model;
        $validation = $this->form_validation;
        $validation->set_rules($mercent->rules());

        if ($validation->run())
        {
            $mercent->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('direct/mercent'));
        }
        // else
        // {
        //     echo validation_errors();
        // }
        $data['mercent'] = $this->mercent_model->getAll();
        $data['tdc'] = $this->mercent_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->mercent_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->mercent_model->getThisTableRecord('tbl_user');
        $this->load->view('direct/mercent/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('direct/tdc');
        
        $mercent = $this->mercent_model;
        $validation = $this->form_validation;
        $validation->set_rules($mercent->rules());

        if ($validation->run())
        {
            $mercent->update($id);
            $this->session->set_flashdata('success', 'Berhasil diubah');
            redirect(site_url('direct/mercent'));
        }
        // else
        // {
        //     echo validation_errors();
        // }

        $data['mercent'] = $mercent->getById($id);
        $data['related'] = $mercent->getRelated();
        $data['tdc'] = $this->mercent_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->mercent_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->mercent_model->getThisTableRecord('tbl_user');
        if (!$data['mercent']) show_404();

        $this->load->view('direct/mercent/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->mercent_model->delete($id))
        {
            redirect(site_url('direct/mercent'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['mercent'] = $this->mercent_model->getDetail($id);
        $this->load->view('direct/mercent/detail', $data);
    }

}