<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing_model extends CI_Model
{
    private $table = 'tbl_marketing';
    private $kode_marketing;
    private $kode_tdc;
    private $divisi;
    private $nama_marketing;
    private $mkios;
    private $no_hp;
    private $alamat;
    private $email;

    public function rules()
    {
        return [
            ['field' => 'kode_marketing', 'label' => 'Kode Marketing','rules' => 'required'],
            ['field' => 'kode_tdc', 'label' => 'Kode TDC','rules' => 'required'],
            ['field' => 'divisi', 'label' => 'Divisi','rules' => 'required'],
            ['field' => 'nama_marketing', 'label' => 'Kode Marketing','rules' => 'required'],
            ['field' => 'mkios', 'label' => 'MKIOS','rules' => 'required'],
            ['field' => 'no_hp', 'label' => 'No HP','rules' => 'required'],
            ['field' => 'alamat', 'label' => 'Alamat','rules' => 'required'],
            ['field' => 'email', 'label' => 'Email','rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['kode_marketing' => $id])->row();
    }

    public function getThisTableRecord($table)
    {
        return $this->db->get($table)->result();
    }

    public function getRelated()
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS m');
        $this->db->join('tbl_tdc AS t', 'm.kode_tdc = t.kode_tdc', 'inner');
        // $this->db->where('o.id_target', $id);
        return $this->db->get()->result();
    }

    public function getDetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS m');
        $this->db->join('tbl_tdc AS t', 't.kode_tdc = m.kode_tdc', 'left');
        $this->db->where('m.kode_marketing', $id);
        return $this->db->get()->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $data = array(
            'kode_marketing' => $this->kode_marketing = strtoupper($post['kode_marketing']),
            'kode_tdc' => $this->kode_tdc = $post['kode_tdc'],
            'divisi' => $this->divisi = strtoupper($post['divisi']),
            'nama_marketing' => $this->nama_marketing = strtoupper($post['nama_marketing']),
            'mkios' => $this->mkios = $post['mkios'],
            'no_hp' => $this->no_hp = strtoupper($post['no_hp']),
            'alamat' => $this->alamat = strtoupper($post['alamat']),
            'email' => $this->email = strtoupper($post['email']),
        );
        
        $this->db->set($data);
        $this->db->insert($this->table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        $data = array(
            //'kode_marketing' => $this->kode_marketing = strtoupper($post['kode_marketing']),
            'kode_tdc' => $this->kode_tdc = $post['kode_tdc'],
            'divisi' => $this->divisi = strtoupper($post['divisi']),
            'nama_marketing' => $this->nama_marketing = strtoupper($post['nama_marketing']),
            'mkios' => $this->mkios = $post['mkios'],
            'no_hp' => $this->no_hp = strtoupper($post['no_hp']),
            'alamat' => $this->alamat = strtoupper($post['alamat']),
            'email' => $this->email = strtoupper($post['email']),
        );
        
        $this->db->set($data);
        $this->db->update($this->table, $this, array('kode_marketing' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('kode_marketing' => $id));
    }

}