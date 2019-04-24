<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mercent_model extends CI_Model
{
    private $table = 'tbl_mercent';
    private $id_mercent;
    private $kode_tdc;
    private $tanggal;
    private $nama_mercent;
    private $kode_marketing;
    private $nama_pic;
    private $no_hp_pic;
    private $no_ktp;
    private $npwp;
    private $longtitude;
    private $latitude;
    private $alamat;
    private $produk_diajukan;
    private $foto_mercent;
    private $kode_user;

    public function rules()
    {
        return [
            ['field' => 'id_mercent', 'label' => 'ID mercent','rules' => 'required'],
            ['field' => 'kode_tdc', 'label' => 'Kode TDC','rules' => 'required'],
            ['field' => 'tanggal', 'label' => 'Tanggal mercent','rules' => 'required'],
            ['field' => 'nama_mercent', 'label' => 'Tanggal Event','rules' => 'required'],
            ['field' => 'kode_marketing', 'label' => 'Kode Marketing','rules' => 'required'],           
            ['field' => 'nama_pic', 'label' => 'Nama Pic','rules' => 'required'],
            ['field' => 'no_hp_pic', 'label' => 'No HP Pic','rules' => 'required'],
            ['field' => 'no_ktp', 'label' => 'No KTP','rules' => 'required'], 
            ['field' => 'npwp', 'label' => 'NPWP','rules' => 'required'],
            ['field' => 'longtitude', 'label' => 'Longitude','rules' => 'required'],
            ['field' => 'latitude', 'label' => 'Latitude','rules' => 'required'],
            ['field' => 'alamat', 'label' => 'Alamat','rules' => 'required'],
            ['field' => 'produk_diajukan', 'label' => 'Produk Diajukan','rules' => 'required'],
            // ['field' => 'foto_mercent', 'label' => 'QTY 100K','rules' => 'required'],
            ['field' => 'kode_user', 'label' => 'Kode User','rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id_mercent' => $id])->row();
    }

    public function getThisTableRecord($table)
    {
        return $this->db->get($table)->result();
    }

    public function getRelated()
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS mer');
        $this->db->join('tbl_tdc AS tdc', 'tdc.kode_tdc = mer.kode_tdc', 'left');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = mer.kode_marketing', 'left');
        $this->db->join('tbl_user AS usr', 'usr.kode_user = mer.kode_user', 'left');
        // $this->db->where('o.id_target', $id);
        return $this->db->get()->result();
    }

    public function getDetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS mer');
        $this->db->join('tbl_tdc AS t', 't.kode_tdc = mer.kode_tdc', 'left');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = mer.kode_marketing', 'left');
        $this->db->join('tbl_user AS u', 'u.kode_user = mer.kode_user', 'left');
        $this->db->where('mer.id_mercent', $id);
        return $this->db->get()->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $data = array(
            'id_mercent' => $this->id_mercent = $post['id_mercent'],
            'kode_tdc' => $this->kode_tdc = $post['kode_tdc'],
            'tanggal' => $this->tanggal = $post['tanggal'],
            'nama_mercent' => $this->nama_mercent = $post['nama_mercent'],
            'kode_marketing' => $this->kode_marketing = $post['kode_marketing'],
            'nama_pic' => $this->nama_pic = $post['nama_pic'],
            'no_hp_pic' => $this->no_hp_pic = $post['no_hp_pic'],
            'no_ktp' => $this->no_ktp = $post['no_ktp'],
            'npwp' => $this->npwp = $post['npwp'],
            'longtitude' => $this->longtitude = $post['longtitude'],
            'latitude' => $this->latitude = $post['latitude'],
            'alamat' => $this->alamat = $post['alamat'],
            'produk_diajukan' => $this->produk_diajukan = $post['produk_diajukan'],
            'foto_mercent' => $this->foto_mercent = $this->uploadImage(),
            'kode_user' => $this->kode_user = $post['kode_user'],
        );
        
        $this->db->set($data);
        $this->db->insert($this->table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        if (!empty($_FILES['foto_mercent']['name']))
        {
            $this->foto_mercent = $this->uploadImage();
        } 
        else
        {
            $this->foto_mercent = $post['old_image'];
        }
        $data = array(
            // 'id_mercent' => $this->id_mercent = $post['id_mercent'],
            'kode_tdc' => $this->kode_tdc = $post['kode_tdc'],
            'tanggal' => $this->tanggal = $post['tanggal'],
            'nama_mercent' => $this->nama_mercent = $post['nama_mercent'],
            'kode_marketing' => $this->kode_marketing = $post['kode_marketing'],
            'nama_pic' => $this->nama_pic = $post['nama_pic'],
            'no_hp_pic' => $this->no_hp_pic = $post['no_hp_pic'],
            'no_ktp' => $this->no_ktp = $post['no_ktp'],
            'npwp' => $this->npwp = $post['npwp'],
            'longtitude' => $this->longtitude = $post['longtitude'],
            'latitude' => $this->latitude = $post['latitude'],
            'alamat' => $this->alamat = $post['alamat'],
            'produk_diajukan' => $this->produk_diajukan = $post['produk_diajukan'],
            'foto_mercent' => $this->foto_mercent,
            'kode_user' => $this->kode_user = $post['kode_user'],
        );
        
        $this->db->set($data);
        $this->db->update($this->table, $this, array('id_mercent' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id_mercent' => $id));
    }

    private function uploadImage()
    {
        $config['upload_path'] = './upload/mercent/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = uniqid();
        $config['overwrite'] = true;
        $config['max_size'] = 5120;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto_mercent'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('admin/direct/mercent/new_form', $error);
            return "default.png";
        } 
        else
        {
            return $this->upload->data('file_name');
        }        
    }

    private function deleteImage($id)
    {
        $post = $this->getById($id);
        if ($post->foto_mercent != 'default.png')
        {
            $filename = explode('.', $post->foto_mercent)[0];
            return array_map('unlink', glob(FCPATH."upload/mercent/$filenammer.*"));
        }
    }

}