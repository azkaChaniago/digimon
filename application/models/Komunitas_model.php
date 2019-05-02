<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Komunitas_model extends CI_Model
{
    private $table = 'tbl_komunitas';
    private $id_komunitas;
    private $kode_tdc;
    private $nama_petugas;
    private $nama_komunitas;
    private $nama_ketua;
    private $alamat;
    private $no_hpketua;
    private $jumlah_anggota;
    private $nama_sosmed;
    private $kode_user;

    public function rules()
    {
        return [
            ['field' => 'kode_tdc', 'label' => 'Kode TDC','rules' => 'required'],
            ['field' => 'nama_petugas', 'label' => 'Nama Petugas','rules' => 'required'],
            ['field' => 'nama_komunitas', 'label' => 'Nama Komunitas','rules' => 'required'],
            ['field' => 'nama_ketua', 'label' => 'Nama Ketua','rules' => 'required'],   
            ['field' => 'alamat', 'label' => 'Alamat','rules' => 'required'],
            ['field' => 'no_hpketua', 'label' => 'No HP Ketua','rules' => 'required'],
            ['field' => 'jumlah_anggota', 'label' => 'Jumlah Anggota','rules' => 'required'],
            ['field' => 'nama_sosmed', 'label' => 'Nama Sssmed','rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id_komunitas' => $id])->row();
    }

    public function getThisTableRecord($table)
    {
        return $this->db->get($table)->result();
    }

    public function getRelated($tdc)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS k');
        $this->db->join('tbl_tdc AS tdc', 'tdc.kode_tdc = k.kode_tdc', 'left');
        $this->db->join('tbl_user AS usr', 'usr.kode_user = k.kode_user', 'left');
        $this->db->where('k.kode_tdc', $tdc);
        return $this->db->get()->result();
    }

    public function getDetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS k');
        $this->db->join('tbl_tdc AS t', 't.kode_tdc = k.kode_tdc', 'left');
        $this->db->join('tbl_user AS u', 'u.kode_user = k.kode_user', 'left');
        $this->db->where('k.id_komunitas', $id);
        return $this->db->get()->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $data = array(
            'kode_tdc' => $this->kode_tdc = $post['kode_tdc'],
            'nama_petugas' => $this->nama_petugas = strtoupper($post['nama_petugas']),
            'nama_komunitas' => $this->nama_komunitas = strtoupper($post['nama_komunitas']),
            'nama_ketua' => $this->nama_ketua = strtoupper($post['nama_ketua']),
            'alamat' => $this->alamat = strtoupper($post['alamat']),
            'no_hpketua' => $this->no_hpketua = strtoupper($post['no_hpketua']),
            'jumlah_anggota' => $this->jumlah_anggota = $post['jumlah_anggota'],
            'nama_sosmed' => $this->nama_sosmed = strtoupper($post['nama_sosmed']),
            'kode_user' => $this->kode_user = $this->session->userdata['id'],
        );
        
        $this->db->set($data);
        $this->db->insert($this->table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        $data = array(
            'kode_tdc' => $this->kode_tdc = $post['kode_tdc'],
            'nama_petugas' => $this->nama_petugas = strtoupper($post['nama_petugas']),
            'nama_komunitas' => $this->nama_komunitas = strtoupper($post['nama_komunitas']),
            'nama_ketua' => $this->nama_ketua = strtoupper($post['nama_ketua']),
            'alamat' => $this->alamat = strtoupper($post['alamat']),
            'no_hpketua' => $this->no_hpketua = strtoupper($post['no_hpketua']),
            'jumlah_anggota' => $this->jumlah_anggota = $post['jumlah_anggota'],
            'nama_sosmed' => $this->nama_sosmed = strtoupper($post['nama_sosmed']),
        );
        
        $this->db->set($data);
        $this->db->update($this->table, $this, array('id_komunitas' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id_komunitas' => $id));
    }

}