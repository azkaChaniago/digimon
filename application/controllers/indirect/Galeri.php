<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('galeri_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function userSession()
    {   
        $data = array(
            'status' => $this->session->userdata('login'),
            'access' => $this->session->userdata('access'),
            'id' => $this->session->userdata('id'),
            'user' => $this->session->userdata('user'),
            'tdc' => $this->session->userdata('tdc')
        );

        return $data;
    }

    public function index()
    {
        is_logged_in();
        $galeri = $this->galeri_model;
        $data = $this->userSession();
        if (isset($_POST['simpan'])) 
        {
            $galeri->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            // redirect(site_url('indirect/galeri/'));
        }
        else if (isset($_POST['ubah'])) 
        {
            $galeri->update(isset($_POST['id']));
            $this->session->set_flashdata('success', 'Berhasil dubah');
        }
        $data['galeri'] = $this->galeri_model->getAll();
        $this->load->view('indirect/galeri/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $galeri = $this->galeri_model;
        $validation = $this->form_validation;
        $validation->set_rules($galeri->rules());

        if ($validation->run())
        {
            $galeri->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
            redirect(site_url('indirect/galeri/'));
        }
        else
        {
            $this->session->set_flashdata('error', validation_errors());
            redirect(site_url('indirect/galeri/'));
        }

        // $data['galeri'] = $this->galeri_model->getAll();
        // $this->load->view('indirect/galeri/list', $data);
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('indirect/galeri');
        
        $user = $this->galeri_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules());

        if ($validation->run())
        {
            $user->update($id);
            $this->session->set_flashdata('success', 'Berhasil diubah');
            redirect(site_url('indirect/galeri'));
        }
        // else
        // {
        //     echo validation_errors();
        // }

        $data['galeri'] = $user->getById($id);
        $data['related'] = $user->getRelated();
        $data['marketing'] = $this->galeri_model->getThisTableRecord('tbl_marketing');
        $data['user'] = $this->galeri_model->getThisTableRecord('tbl_user');
        $data['tdc'] = $this->galeri_model->getThisTableRecord('tbl_tdc');
        if (!$data['galeri']) show_404();

        $this->load->view('indirect/galeri/edit_form', $data);
    }

    public function remove($id)
    {
        if (!isset($id)) show_404();

        if ($this->galeri_model->delete($id))
        {
            redirect(site_url('indirect/galeri'));
        }
    }

    // public function detail($id=null)
    // {
    //     is_logged_in();
    //     $data['galeri'] = $this->galeri_model->getDetail($id);
    //     $this->load->view('indirect/galeri/detail', $data);
    // }

}



// Severity: Notice

// Message: Trying to get property 'foto_kegiatan' of non-object

// Filename: models/Galeri_model.php

// Line Number: 182

// Backtrace:

// File: E:\xampp\htdocs\digimon\application\models\Galeri_model.php
// Line: 182
// Function: _error_handler

// File: E:\xampp\htdocs\digimon\application\models\Galeri_model.php
// Line: 81
// Function: deleteImage

// File: E:\xampp\htdocs\digimon\application\controllers\indirect\Galeri.php
// Line: 42
// Function: update

// File: E:\xampp\htdocs\digimon\index.php
// Line: 315
// Function: require_once 