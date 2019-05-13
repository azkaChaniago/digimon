<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tdc_model extends CI_Model
{
    private $table = 'tbl_tdc';
    private $kode_tdc;
    private $nama_tdc;
    private $manager;
    private $no_telepon;
    private $no_callcenter;
    private $alamat;

    public function rules()
    {
        return [
            ['field' => 'kode_tdc', 'label' => 'Kode TDC','rules' => 'required'],
            ['field' => 'nama_tdc', 'label' => 'Nama TDC','rules' => 'required'],
            ['field' => 'manager', 'label' => 'Manager','rules' => 'required'],
            ['field' => 'no_telepon', 'label' => 'No Telepon','rules' => 'required'],
            ['field' => 'no_callcenter', 'label' => 'No Callcenter','rules' => 'required'],
            ['field' => 'alamat', 'label' => 'Alamat','rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['kode_tdc' => $id])->row();
    }

    public function getThisTableRecord($table)
    {
        return $this->db->get($table)->result();
    }

    public function getRelated()
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS t');
        $this->db->join('tbl_user AS u', 'u.kode_user = t.kode_user', 'left');
        // $this->db->where('o.id_target', $id);
        return $this->db->get()->result();
    }

    public function getDetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS t');
        $this->db->join('tbl_user AS u', 'u.kode_user = t.kode_user', 'left');
        $this->db->where('t.kode_tdc', $id);
        return $this->db->get()->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $data = array(
            'kode_tdc' => $this->kode_tdc = strtoupper($post['kode_tdc']),
            'nama_tdc' => $this->nama_tdc = strtoupper($post['nama_tdc']),
            'manager' => $this->manager = strtoupper($post['manager']),
            'no_telepon' => $this->no_telepon = strtoupper($post['no_telepon']),
            'no_callcenter' => $this->no_callcenter = strtoupper($post['no_callcenter']),
            'alamat' => $this->alamat = strtoupper($post['alamat'])
        );
        
        $this->db->set($data);
        $this->db->insert($this->table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        $data = array(
            'nama_tdc' => $this->nama_tdc = strtoupper($post['nama_tdc']),
            'manager' => $this->manager = strtoupper($post['manager']),
            'no_telepon' => $this->no_telepon = strtoupper($post['no_telepon']),
            'no_callcenter' => $this->no_callcenter = strtoupper($post['no_callcenter']),
            'alamat' => $this->alamat = strtoupper($post['alamat'])
        );
        
        $this->db->set($data);
        $this->db->update($this->table, $this, array('kode_tdc' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('kode_tdc' => $id));
    }

}