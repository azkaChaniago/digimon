<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{

    private $table = 'tbl_user';
    private $kode_user;
    private $user_name;
    private $password;
    private $level;
    private $user_avatar = 'default.png';

    public function rules()
    {
        return [
            ['field' => 'kode_user', 'label' => 'Kode User', 'rules' => 'required'],
            ['field' => 'nama_user', 'label' => 'Nama User', 'rules' => 'required'],
            ['field' => 'password', 'label' => 'Password', 'rules' => 'required'],
            ['field' => 'level', 'label' => 'Level', 'rules' => 'required'],
            ['field' => 'kode_tdc', 'label' => 'Kode Tdc', 'rules' => 'required'],
            ['field' => 'password-repeat', 'label' => 'Ulangi Password', 'rules' => 'required|matches[password]'],
        ];
    }

    public function getAll()
    {
        // return $this->db->get($this->table)->result();
        $this->db->select('*');
        $this->db->from($this->table . ' AS u');
        $this->db->join('tbl_tdc AS t', 'u.kode_tdc = t.kode_tdc', 'inner');
        return $this->db->get()->result();
    }

    public function getDetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS u');
        $this->db->join('tbl_tdc AS tdc', 'tdc.kode_tdc = u.kode_tdc', 'inner');
        $this->db->where('u.kode_user', $id);
        return $this->db->get()->row();
    }
    
    public function getField($table, $field)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field, 'null');
        $this->db->or_where($field, '');
        return $this->db->get()->result();
    }

    public function getThisTableRecord($table)
    {
        return $this->db->get($table)->result();
    }

    public function getTDC()
    {
        return $this->db->get('tbl_tdc')->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['kode_user' => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $data = array(
            'kode_user' => $this->kode_user = strtoupper($post['kode_user']),
            'nama_user' => $this->nama_user = strtoupper($post['nama_user']),
            'kode_tdc' => $this->kode_tdc = strtoupper($post['kode_tdc']),
            'level' => $this->level = strtoupper($post['level']),
            'password' => $this->password = strtoupper($post['password']),
        );
        
        $this->db->set($data);
        $this->db->insert($this->table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        $data = array(
            //'kode_user' => $this->kode_user = strtoupper($post['kode_user']),
            'nama_user' => $this->nama_user = strtoupper($post['nama_user']),
            'kode_tdc' => $this->kode_tdc = strtoupper($post['kode_tdc']),
            'level' => $this->level = strtoupper($post['level']),
            'password' => $this->password = strtoupper($post['password']),
        );
        
        $this->db->set($data);
        $this->db->update($this->table, $this, array('kode_user' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('kode_user' => $id));
    }

    public function hasEmptyField($table, $field)
    {   
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field, 'null');
        $this->db->or_where($field, '');
        return $this->db->get()->result();
    }

    public function generateKodeUser() {
        $query = $this->db->select('kode_user')
                          ->from('tbl_user')
                          ->get();
        $row = $query->last_row();
        if($row){
            $idPostfix = (int)substr($row->kode_user, 2) + 1;
            $nextId = 'U-'.STR_PAD((string)$idPostfix, 3, "0",STR_PAD_LEFT);
        }
        else{$nextId = 'U-001';} // For the first time
        return $nextId;
    }

}



// Line Number: 119

// Backtrace:

// File: D:\xampp\htdocs\digimon\application\models\Users_model.php
// Line: 119
// Function: _error_handler

// File: D:\xampp\htdocs\digimon\application\controllers\admin\User.php
// Line: 48
// Function: generateKodeUser

// File: D:\xampp\htdocs\digimon\index.php
// Line: 319