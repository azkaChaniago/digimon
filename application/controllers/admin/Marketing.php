<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('marketing_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        is_logged_in();
        
        $data['marketing'] = $this->marketing_model->getRelated();
        $this->load->view('admin/marketing/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $marketing = $this->marketing_model;
        $validation = $this->form_validation;
        $validation->set_rules($marketing->rules());

        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $marketing->save();
                $this->session->set_flashdata('success', 'Berhasil disimpan');
                redirect(site_url('admin/marketing'));
            }
            else
            {
                $this->session->set_flashdata('error', validation_errors());
                redirect(site_url('admin/marketing/add/'));
           }
        }
        
        $data['marketing'] = $this->marketing_model->getAll();
        $data['tdc'] = $this->marketing_model->getThisTableRecord('tbl_tdc');

        $this->load->view('admin/marketing/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('admin/marketing');
        
        $marketing = $this->marketing_model;
        $validation = $this->form_validation;
        $validation->set_rules($marketing->rules());

        if (isset($_POST['btn']))
        {
            if ($validation->run())
            {
                $marketing->update($id);
                $this->session->set_flashdata('success', 'Berhasil diubah');
                redirect(site_url('admin/marketing'));
            }
            else
            {
                $this->session->set_flashdata('error', validation_errors());
                redirect(site_url('admin/marketing/edit/' . $id));
            }
        }

        $data['marketing'] = $marketing->getById($id);
        $data['related'] = $marketing->getRelated();
        $data['tdc'] = $this->marketing_model->getThisTableRecord('tbl_tdc');
        $data['user'] = $this->marketing_model->getThisTableRecord('tbl_user');
        if (!$data['marketing']) show_404();

        $this->load->view('admin/marketing/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->marketing_model->delete($id))
        {
            redirect(site_url('admin/marketing'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['marketing'] = $this->marketing_model->getDetail($id);
        $this->load->view('admin/marketing/detail', $data);
    }

}