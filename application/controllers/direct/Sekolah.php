<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sekolah_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        is_logged_in();
        
        $data['sekolah'] = $this->sekolah_model->getRelated();
        $this->load->view('direct/sekolah/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $sekolah = $this->sekolah_model;
        $validation = $this->form_validation;
        $validation->set_rules($sekolah->rules());

        if ($validation->run())
        {
            $sekolah->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('direct/sekolah'));
        }
        // else
        // {
        //     echo validation_errors();
        // }
        $data['sekolah'] = $this->sekolah_model->getAll();
        $data['tdc'] = $this->sekolah_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->sekolah_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->sekolah_model->getThisTableRecord('tbl_user');
        $this->load->view('direct/sekolah/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('direct/tdc');
        
        $sekolah = $this->sekolah_model;
        $validation = $this->form_validation;
        $validation->set_rules($sekolah->rules());

        if ($validation->run())
        {
            $sekolah->update($id);
            $this->session->set_flashdata('success', 'Berhasil diubah');
            redirect(site_url('direct/sekolah'));
        }
        // else
        // {
        //     echo validation_errors();
        // }

        $data['sekolah'] = $sekolah->getById($id);
        $data['related'] = $sekolah->getRelated();
        $data['tdc'] = $this->sekolah_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->sekolah_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->sekolah_model->getThisTableRecord('tbl_user');
        if (!$data['sekolah']) show_404();

        $this->load->view('direct/sekolah/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->sekolah_model->delete($id))
        {
            redirect(site_url('direct/sekolah'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['sekolah'] = $this->sekolah_model->getDetail($id);
        $this->load->view('direct/sekolah/detail', $data);
    }

}