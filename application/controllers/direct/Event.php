<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('event_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function index()
    {
        is_logged_in();
        
        $data['event'] = $this->event_model->getRelated();
        $this->load->view('admin/direct/event/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $event = $this->event_model;
        $validation = $this->form_validation;
        $validation->set_rules($event->rules());

        if ($validation->run())
        {
            $event->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('direct/event'));
        }
        // else
        // {
        //     echo validation_errors();
        // }
        $data['event'] = $this->event_model->getAll();
        $data['tdc'] = $this->event_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->event_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->event_model->getThisTableRecord('tbl_user');
        $this->load->view('admin/direct/event/new_form', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('admin/direct/tdc');
        
        $event = $this->event_model;
        $validation = $this->form_validation;
        $validation->set_rules($event->rules());

        if ($validation->run())
        {
            $event->update($id);
            $this->session->set_flashdata('success', 'Berhasil diubah');
            redirect(site_url('direct/event'));
        }
        // else
        // {
        //     echo validation_errors();
        // }

        $data['event'] = $event->getById($id);
        $data['related'] = $event->getRelated();
        $data['tdc'] = $this->event_model->getThisTableRecord('tbl_tdc');
        $data['marketing'] = $this->event_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->event_model->getThisTableRecord('tbl_user');
        if (!$data['event']) show_404();

        $this->load->view('admin/direct/event/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->event_model->delete($id))
        {
            redirect(site_url('direct/event'));
        }
    }

    public function detail($id=null)
    {
        is_logged_in();
        $data['event'] = $this->event_model->getDetail($id);
        $this->load->view('admin/direct/event/detail', $data);
    }

}