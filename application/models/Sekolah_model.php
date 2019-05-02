<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah_model extends CI_Model
{
    private $table = 'tbl_sekolah';
    private $npsn;
    private $kode_tdc;
    private $kabupaten;
    private $kecamatan;
    private $nama_sekolah;
    private $alamat;
    private $jumlah_siswa;
    private $longtitude;
    private $latitude;
    private $kode_marketing;
    private $kode_user;

    public function rules()
    {
        return [
            ['field' => 'npsn', 'label' => 'NPSN','rules' => 'required'],
            ['field' => 'kode_tdc', 'label' => 'Kode TDC','rules' => 'required'],
            ['field' => 'kabupaten', 'label' => 'kabupaten mercent','rules' => 'required'],
            ['field' => 'kecamatan', 'label' => 'kabupaten Event','rules' => 'required'],
            ['field' => 'nama_sekolah', 'label' => 'Kode Marketing','rules' => 'required'],           
            ['field' => 'alamat', 'label' => 'Nama Pic','rules' => 'required'],
            ['field' => 'jumlah_siswa', 'label' => 'No HP Pic','rules' => 'required'],
            ['field' => 'longtitude', 'label' => 'Longitude','rules' => 'required'],
            ['field' => 'latitude', 'label' => 'Latitude','rules' => 'required'],
            ['field' => 'kode_marketing', 'label' => 'Produk Diajukan','rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['npsn' => $id])->row();
    }

    public function getThisTableRecord($table)
    {
        return $this->db->get($table)->result();
    }

    public function getRelated($tdc)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS s');
        $this->db->join('tbl_tdc AS tdc', 'tdc.kode_tdc = s.kode_tdc', 'left');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = s.kode_marketing', 'left');
        $this->db->join('tbl_user AS usr', 'usr.kode_user = s.kode_user', 'left');
        $this->db->where('s.kode_tdc', $tdc);
        return $this->db->get()->result();
    }

    public function getDetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS s');
        $this->db->join('tbl_tdc AS t', 't.kode_tdc = s.kode_tdc', 'left');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = s.kode_marketing', 'left');
        $this->db->join('tbl_user AS u', 'u.kode_user = s.kode_user', 'left');
        $this->db->where('s.npsn', $id);
        return $this->db->get()->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $data = array(
            'npsn' => $this->npsn = $post['npsn'],
            'kode_tdc' => $this->kode_tdc = $post['kode_tdc'],
            'kabupaten' => $this->kabupaten = strtoupper($post['kabupaten']),
            'kecamatan' => $this->kecamatan = strtoupper($post['kecamatan']),
            'nama_sekolah' => $this->nama_sekolah = strtoupper($post['nama_sekolah']),
            'alamat' => $this->alamat = strtoupper($post['alamat']),
            'jumlah_siswa' => $this->jumlah_siswa = $post['jumlah_siswa'],
            'longtitude' => $this->longtitude = $post['longtitude'],
            'latitude' => $this->latitude = $post['latitude'],
            'kode_marketing' => $this->kode_marketing = $post['kode_marketing'],
            'kode_user' => $this->kode_user = $this->session->userdata['user'],
        );
        
        $this->db->set($data);
        $this->db->insert($this->table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        $data = array(
            'kode_tdc' => $this->kode_tdc = $post['kode_tdc'],
            'kabupaten' => $this->kabupaten = strtoupper($post['kabupaten']),
            'kecamatan' => $this->kecamatan = strtoupper($post['kecamatan']),
            'nama_sekolah' => $this->nama_sekolah = strtoupper($post['nama_sekolah']),
            'alamat' => $this->alamat = strtoupper($post['alamat']),
            'jumlah_siswa' => $this->jumlah_siswa = $post['jumlah_siswa'],
            'longtitude' => $this->longtitude = $post['longtitude'],
            'latitude' => $this->latitude = $post['latitude'],
            'kode_marketing' => $this->kode_marketing = $post['kode_marketing']
        );
        
        $this->db->set($data);
        $this->db->update($this->table, $this, array('npsn' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('npsn' => $id));
    }

}