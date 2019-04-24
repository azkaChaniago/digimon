<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Marketsharesekolah extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('marketsharesekolah_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        is_logged_in();
        
        $data['marketshare'] = $this->marketsharesekolah_model->getRelated();
        $this->load->view('admin/direct/sharesekolah/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $sekolah = $this->marketsharesekolah_model;
        $validation = $this->form_validation;
        $validation->set_rules($sekolah->rules());

        if ($validation->run())
        {
            $sekolah->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('direct/marketsharesekolah'));
        }
        // else
        // {
        //     echo validation_errors();
        // }
        $data['marketshare'] = $this->marketsharesekolah_model->getAll();
        $data['tdc'] = $this->marketsharesekolah_model->getThisTableRecord('tbl_tdc');
        $data['sekolah'] = $this->marketsharesekolah_model->getThisTableRecord('tbl_sekolah');
        $data['user'] = $this->marketsharesekolah_model->getThisTableRecord('tbl_user');
        $this->load->view('admin/direct/sharesekolah/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('admin/direct/marketsharesekolah');
        
        $sekolah = $this->marketsharesekolah_model;
        $validation = $this->form_validation;
        $validation->set_rules($sekolah->rules());
        

        if ($validation->run())
        {
            $sekolah->update($id);
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('direct/marketsharesekolah'));
        }
        // else
        // {
        //     echo validation_errors();
        // }

        $data['marketshare'] = $sekolah->getById($id);
        $data['related'] = $sekolah->getRelated();
        $data['tdc'] = $this->marketsharesekolah_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->marketsharesekolah_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->marketsharesekolah_model->getThisTableRecord('tbl_user');
        if (!$data['marketshare']) show_404();

        $this->load->view('admin/direct/sharesekolah/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->marketsharesekolah_model->delete($id))
        {
            redirect(site_url('direct/marketsharesekolah'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['marketshare'] = $this->marketsharesekolah_model->getDetail($id);
        $this->load->view('admin/direct/sharesekolah/detail', $data);
    }

}