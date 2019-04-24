<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Downlinegt_model extends CI_Model
{
    private $table = 'tbl_downline_gt';
    private $id_downline_gt;
    private $kode_tdc;
    private $divisi;
    private $tanggal;
    private $kode_marketing;
    private $nama_downline;
    private $alamat;
    private $nomor_gt;
    private $deposit;
    private $foto = 'default.png';
    private $kode_user;

    public function rules()
    {
        return [
            ['field' => 'id_downline_gt', 'label' => 'ID Saleling','rules' => 'required'],
            ['field' => 'kode_tdc', 'label' => 'Kode TDC','rules' => 'required'],
            ['field' => 'divisi', 'label' => 'Divisi','rules' => 'required'],
            ['field' => 'tanggal', 'label' => 'Tanggal','rules' => 'required'],
            ['field' => 'kode_marketing', 'label' => 'Kode Marketing','rules' => 'required'],
            ['field' => 'nama_downline', 'label' => 'Nama Downline','rules' => 'required'],
            ['field' => 'alamat', 'label' => 'Alamat','rules' => 'required'],
            ['field' => 'nomor_gt', 'label' => 'Nomor GT','rules' => 'required'],
            ['field' => 'deposit', 'label' => 'Deposit','rules' => 'required'],
            // ['field' => 'foto', 'label' => 'Foto Kegiatan','rules' => 'required'],
            ['field' => 'kode_user', 'label' => 'Kode User','rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id_downline_gt' => $id])->row();
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
        $this->db->where('s.id_downline_gt', $id);
        return $this->db->get()->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $data = array(
            'id_downline_gt' => $this->id_downline_gt = $post['id_downline_gt'],
            'kode_tdc' => $this->kode_tdc = $post['kode_tdc'],
            'divisi' => $this->divisi = $post['divisi'],
            'tanggal' => $this->tanggal = $post['tanggal'],
            'kode_marketing' => $this->kode_marketing = $post['kode_marketing'],
            'nama_downline' => $this->nama_downline = $post['nama_downline'],
            'alamat' => $this->alamat = $post['alamat'],
            'nomor_gt' => $this->nomor_gt = $post['nomor_gt'],
            'deposit' => $this->deposit = $post['deposit'],
            'foto' => $this->foto = $this->uploadImage(),
            'kode_user' => $this->kode_user = $this->session->userdata('id')
        );
        
        $this->db->set($data);
        $this->db->insert($this->table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        if (!empty($_FILES['foto']['name']))
        {
            $this->foto = $this->uploadImage();
        } 
        else
        {
            $this->foto = $post['old_image'];
        }
        $data = array(
            // 'id_downline_gt' => $this->id_downline_gt = $post['id_downline_gt'],
            'kode_tdc' => $this->kode_tdc = $post['kode_tdc'],
            'divisi' => $this->divisi = $post['divisi'],
            'tanggal' => $this->tanggal = $post['tanggal'],
            'kode_marketing' => $this->kode_marketing = $post['kode_marketing'],
            'nama_downline' => $this->nama_downline = $post['nama_downline'],
            'alamat' => $this->alamat = $post['alamat'],
            'nomor_gt' => $this->nomor_gt = $post['nomor_gt'],
            'deposit' => $this->deposit = $post['deposit'],
            'foto' => $this->foto = $this->uploadImage(),
            // 'kode_user' => $this->kode_user = $post['kode_user'],
        );
        
        $this->db->set($data);
        $this->db->update($this->table, $this, array('id_downline_gt' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id_downline_gt' => $id));
    }

    private function uploadImage()
    {
        $config['upload_path'] = './upload/downlinegt/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = uniqid();
        $config['overwrite'] = true;
        $config['max_size'] = 5120;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto'))
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
        if ($post->foto != 'default.png')
        {
            $filename = explode('.', $post->foto)[0];
            return array_map('unlink', glob(FCPATH."upload/downlinegt/$filename.*"));
        }
    }

}