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
            // redirect(site_url('adminindirect/galeri/'));
        }
        else if (isset($_POST['ubah'])) 
        {
            $galeri->update(isset($_POST['id']));
            $this->session->set_flashdata('success', 'Berhasil dubah');
        }
        $data['galeri'] = $this->galeri_model->getAll();
        $this->load->view('adminindirect/galeri/list', $data);
    }

    // public function detail($id=null)
    // {
    //     is_logged_in();
    //     $data['galeri'] = $this->galeri_model->getDetail($id);
    //     $this->load->view('adminindirect/galeri/detail', $data);
    // }

}
