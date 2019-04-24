<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
    }

    public function userSession()
    {   
        $data = array(
            'status' => $this->session->userdata('login'),
            'access' => $this->session->userdata('access'),
            'id' => $this->session->userdata('id'),
            'user' => $this->session->userdata('user')
        );

        return $data;
    }

    public function index()
    {
        is_logged_in();
        $data = $this->userSession();
        $data['list'] = $this->users_model->getAll();
        $this->load->view('admin/users/list', $data);
    }

    public function add()
    {
        is_logged_in();
        $users = $this->users_model;
        $validation = $this->form_validation;
        $validation->set_rules($users->rules());

        if ($validation->run())
        {
            $users->saveOne();
            $this->session->set_flashdata('success', 'Successfully updated');
        }

        $data = $this->userSession();
        
        $this->load->view('admin/users/insert_form',$data);       
    }

    public function currUser($id)
    {
        is_logged_in();
        if (!isset($id)) redirect('admin/overview');

        $users = $this->users_model;
        $validation = $this->form_validation;
        $validation->set_rules($users->rules());

        if ($validation->run())
        {
            $users->updateOne();
            $this->session->set_flashdata('success', 'Successfully updated');
        }

        $data = $this->userSession();
        $data['curr'] = $this->users_model->getById($data['id']);

        if (!$data['curr']) show_404();

        $this->load->view('admin/users/curr_user', $data);
    }

    public function delete($id)
    {
        if (!isset($id)) show_404();

        if ($this->users_model->delete($id))
        {
            redirect(site_url('admin/users/'));
        }
    }

    public function edit($id)
    {
        is_logged_in();
        if (!isset($id)) redirect(site_url('admin/users'));
        
        $users = $this->users_model;
        $validation = $this->form_validation;
        $validation->set_rules($users->rules());

        if ($validation->run())
        {
            $users->updateOne($id);
            $this->session->set_flashdata('success', 'Successfully updated');
            redirect(site_url('admin/users'));
        }

        $data = $this->userSession();
        $data['users'] = $users->getById($id);

        if (!$data['users']) show_404();

        $this->load->view('admin/users/update_form', $data);
    }

}