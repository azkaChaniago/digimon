<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Coverage extends CI_Controller
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
        
        $data['coverage'] = $this->coverage_model->getAll();
        $this->load->view('indirect/coverage/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $coverage = $this->coverage_model;
        $validation = $this->form_validation;
        $validation->set_rules($coverage->rules());

        if ($validation->run())
        {
            $coverage->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view('indirect/coverage/new_form');
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('indirect/coverage');
        
        $coverage = $this->coverage_model;
        $validation = $this->form_validation;
        $validation->set_rules($coverage->rules());

        if ($validation->run())
        {
            $coverage->update($id);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data['coverage'] = $coverage->getById($id);
        if (!$data['coverage']) show_404();

        $this->load->view('indirect/coverage/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->coverage_model->delete($id))
        {
            redirect(site_url('indirect/coverage'));
        }
    }

    public function detail($id=null)
    {
        $this->load->view('indirect/coverage/detail');
    }

}