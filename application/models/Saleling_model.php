<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Saleling_model extends CI_Model
{
    private $table = 'tbl_foto_saleling';
    private $id_saleling;
    private $kode_tdc;
    private $divisi;
    private $tanggal;
    private $kode_marketing;
    private $lokasi_saleling;
    private $foto_kegiatan = 'default.png';
    private $kode_user;

    public function rules()
    {
        return [
            ['field' => 'id_saleling', 'label' => 'ID Saleling','rules' => 'required'],
            ['field' => 'kode_tdc', 'label' => 'Kode TDC','rules' => 'required'],
            ['field' => 'divisi', 'label' => 'Divisi','rules' => 'required'],
            ['field' => 'tanggal', 'label' => 'Tanggal','rules' => 'required'],
            ['field' => 'kode_marketing', 'label' => 'Kode Marketing','rules' => 'required'],
            ['field' => 'lokasi_saleling', 'label' => 'Lokasi Saleling','rules' => 'required'],
            // ['field' => 'foto_kegiatan', 'label' => 'Foto Kegiatan','rules' => 'required'],
            ['field' => 'kode_user', 'label' => 'Kode User','rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id_saleling' => $id])->row();
    }

    public function getThisTableRecord($table)
    {
        return $this->db->get($table)->result();
    }

    public function getRelated()
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS s');
        $this->db->join('tbl_tdc AS tdc', 'tdc.kode_tdc = s.kode_tdc', 'left');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = s.kode_marketing', 'left');
        $this->db->join('tbl_user AS usr', 'usr.kode_user = s.kode_user', 'left');
        // $this->db->where('o.id_target', $id);
        return $this->db->get()->result();
    }

    public function getDetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS s');
        $this->db->join('tbl_tdc AS t', 't.kode_tdc = s.kode_tdc', 'left');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = s.kode_marketing', 'left');
        $this->db->join('tbl_user AS u', 'u.kode_user = s.kode_user', 'left');
        $this->db->where('s.id_saleling', $id);
        return $this->db->get()->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $data = array(
            'id_saleling' => $this->id_saleling = $post['id_saleling'],
            'kode_tdc' => $this->kode_tdc = $post['kode_tdc'],
            'divisi' => $this->divisi = $post['divisi'],
            'tanggal' => $this->tanggal = $post['tanggal'],
            'kode_marketing' => $this->kode_marketing = $post['kode_marketing'],
            'lokasi_saleling' => $this->lokasi_saleling = $post['lokasi_saleling'],
            'foto_kegiatan' => $this->foto_kegiatan = $this->uploadImage(),
            'kode_user' => $this->kode_user = $post['kode_user'],
        );
        
        $this->db->set($data);
        $this->db->insert($this->table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        if (!empty($_FILES['foto_kegiatan']['name']))
        {
            $this->foto_kegiatan = $this->uploadImage();
        } 
        else
        {
            $this->foto_kegiatan = $post['old_image'];
        }
        $data = array(
            // 'id_saleling' => $this->id_saleling = $post['id_saleling'],
            'kode_tdc' => $this->kode_tdc = $post['kode_tdc'],
            'divisi' => $this->divisi = $post['divisi'],
            'tanggal' => $this->tanggal = $post['tanggal'],
            'kode_marketing' => $this->kode_marketing = $post['kode_marketing'],
            'lokasi_saleling' => $this->lokasi_saleling = $post['lokasi_saleling'],
            'foto_kegiatan' => $this->foto_kegiatan,
            'kode_user' => $this->kode_user = $post['kode_user'],
        );
        
        $this->db->set($data);
        $this->db->update($this->table, $this, array('id_saleling' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id_saleling' => $id));
    }

    private function uploadImage()
    {
        $config['upload_path'] = './upload/saleling/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = uniqid();
        $config['overwrite'] = true;
        $config['max_size'] = 5120;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto_kegiatan'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('image_error_msg', $error);
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
        if ($post->foto_kegiatan != 'default.png')
        {
            $filename = explode('.', $post->foto_kegiatan)[0];
            return array_map('unlink', glob(FCPATH."upload/saleling/$filename.*"));
        }
    }

}