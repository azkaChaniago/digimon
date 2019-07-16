<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Coverage_model extends CI_Model
{
    private $table = 'tbl_outlet';
    private $id_outlet;
    private $nama_outlet;
    private $kabupaten;
    private $kecamatan;
    private $alamat;
    private $nama_pemilik;
    private $no_hp;
    private $kode_marketing;
    private $hari_kunjungan;
    private $kode_tdc;
    private $nomor_rs;
    private $kategori_outlet;
    private $galeri_foto;
    private $kode_user;

    public function rules()
    {
        return [
            ['field' => 'id_outlet', 'label' => 'ID Outlet','rules' => 'required'],
            ['field' => 'nama_outlet', 'label' => 'Nama Outlet','rules' => 'required'],
            ['field' => 'kabupaten', 'label' => 'Kabupaten','rules' => 'required'],
            ['field' => 'kecamatan', 'label' => 'Kecamatan','rules' => 'required'],
            ['field' => 'alamat', 'label' => 'Alamat','rules' => 'required'],
            ['field' => 'nama_pemilik', 'label' => 'Nama Pemilik','rules' => 'required'],
            ['field' => 'no_hp', 'label' => 'Nomor HP','rules' => 'required'],
            ['field' => 'hari_kunjungan', 'label' => 'Hari Kunjungan','rules' => 'required'],
            ['field' => 'nomor_rs', 'label' => 'Nomor RS','rules' => 'required'],
            ['field' => 'kategori_outlet', 'label' => 'Kategori Outlet','rules' => 'required'],
            ['field' => 'kode_tdc', 'label' => 'Nama TDC','rules' => 'required'],
            ['field' => 'kode_marketing', 'label' => 'Nama Marketing','rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id_outlet' => $id])->row();
    }

    public function getThisTableRecord($table, $conditions = null)
    {
        if (!$conditions)
        {
            return $this->db->get($table)->result();
        }
        else
        {
            $this->db->select('*');
            $this->db->from($table);
            foreach($conditions as $con => $c):
                $this->db->where($con, $c);
            endforeach;
            return $this->db->get()->result();
        }
    }

    public function getRelated($tdc=null)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS o');
        $this->db->join('tbl_marketing AS mar', 'mar.kode_marketing = o.kode_marketing', 'left');
        $this->db->join('tbl_tdc AS tdc', 'tdc.kode_tdc = o.kode_tdc', 'left');
        $this->db->where('tdc.kode_tdc', $tdc);
        return $this->db->get()->result();
    }

    public function getDetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS o');
        $this->db->join('tbl_marketing AS mar', 'mar.kode_marketing = o.kode_marketing', 'left');
        $this->db->join('tbl_tdc AS tdc', 'tdc.kode_tdc = o.kode_tdc', 'left');
        $this->db->join('tbl_user AS user', 'user.kode_user = o.kode_user', 'left');
        $this->db->where('o.id_outlet', $id);
        return $this->db->get()->row();
    }

    public function save()
    {
        $post = $this->input->post();
        if (!empty($_FILES['images']['name']))
        {
            $this->galeri_foto = $this->uploadMultipleImages();
        }
        else
        {
            $this->galeri_foto = "NULL";
        }   
        $data = array(
            'id_outlet' => $this->id_outlet = strtoupper($post['id_outlet']),
            'nama_outlet' => $this->nama_outlet = strtoupper($post['nama_outlet']),
            'kabupaten' => $this->kabupaten = strtoupper($post['kabupaten']),
            'kecamatan' => $this->kecamatan = strtoupper($post['kecamatan']),
            'alamat' => $this->alamat = strtoupper($post['alamat']),
            'nama_pemilik' => $this->nama_pemilik = strtoupper($post['nama_pemilik']),
            'no_hp' => $this->no_hp = strtoupper($post['no_hp']),
            'kode_marketing' => $this->kode_marketing = $post['kode_marketing'],
            'hari_kunjungan' => $this->hari_kunjungan = strtoupper($post['hari_kunjungan']),
            'kode_tdc' => $this->kode_tdc = strtoupper($post['kode_tdc']),
            'nomor_rs' => $this->nomor_rs = strtoupper($post['nomor_rs']),
            'kategori_outlet' => $this->kategori_outlet = strtoupper($post['kategori_outlet']),
            'galeri_foto' => $this->galeri_foto,
            'kode_user' => $this->kode_user = $this->session->userdata('id') 
        );
        
        $this->db->set($data);
        $this->db->insert($this->table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        if (empty($_FILES['images']['name']))
        {
            $this->galeri_foto = $post['galeri_lama'];
            // $this->session->set_flashdata('data', $this->galeri_foto);
        }
        else 
        {
            $this->removeImage($id);
            $this->galeri_foto = $this->uploadMultipleImages();
        }
        
        $data = array(
            'nama_outlet' => $this->nama_outlet = strtoupper($post['nama_outlet']),
            'kabupaten' => $this->kabupaten = strtoupper($post['kabupaten']),
            'kecamatan' => $this->kecamatan = strtoupper($post['kecamatan']),
            'alamat' => $this->alamat = strtoupper($post['alamat']),
            'nama_pemilik' => $this->nama_pemilik = strtoupper($post['nama_pemilik']),
            'no_hp' => $this->no_hp = strtoupper($post['no_hp']),
            'kode_marketing' => $this->kode_marketing = $post['kode_marketing'],
            'hari_kunjungan' => $this->hari_kunjungan = strtoupper($post['hari_kunjungan']),
            'kode_tdc' => $this->kode_tdc = strtoupper($post['kode_tdc']),
            'nomor_rs' => $this->nomor_rs = strtoupper($post['nomor_rs']),
            'kategori_outlet' => $this->kategori_outlet = strtoupper($post['kategori_outlet']),
            'galeri_foto' => $this->galeri_foto,
            // 'kode_user' => $this->kode_user = strtoupper($post['kode_user'])
        );
        
        $this->db->set($data);
        $this->db->update($this->table, $this, array('id_outlet' => $id));
    }

    public function delete($id)
    {
        $this->removeImage($id);
        return $this->db->delete($this->table, array('id_outlet' => $id));
    }

    private function uploadMultipleImages()
    {
        $data_info = array();
        $img_ids = array();
        $count = count($_FILES['images']['name']);
        
        for ($i = 0; $i < $count; $i++)
        {
            $_FILES['image']['name'] = $_FILES['images']['name'][$i];
            $_FILES['image']['type'] = $_FILES['images']['type'][$i];
            $_FILES['image']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
            $_FILES['image']['error'] = $_FILES['images']['error'][$i];
            $_FILES['image']['size'] = $_FILES['images']['size'][$i];
            
            $config['upload_path'] = '/upload/outlet/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = strtoupper($_POST['id_outlet']) . "_" . uniqid();
            $config['overwrite'] = true;
            $config['max_size'] = 5120;
            
            $this->load->library('upload', $config);            
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image'))
            {   
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin/outlet/new_form', $error);
            }
            else
            {
                $file_data = $this->upload->data();
                $upload_data[$i]['images_name'] = $file_data['file_name'];
                
                array_push($img_ids, $file_data);
            }
        }
        
        return json_encode($img_ids);
    }

    private function insertImage($data = array())
    {
        return $this->db->insert_batch('images', $data);
    }
    
    private function removeImage($id) 
    {
        // $this->load->helper('file');
        $ret = $this->db->get_where($this->table, array('id_outlet' => $id));
        
        if ($ret->num_rows() > 0) 
        {
            $res = $ret->row();
            $file_data = json_decode($res->galeri_foto);
            // die(count($file_data));   
            for ($i=0; $i < count($file_data); $i++)
            {
                if (is_file($file_data[$i]->full_path)) 
                {
                    unlink($file_data[$i]->full_path);
                }
            }
        }
    }

    // private function uploadImage()
    // {
        // $config['upload_path'] = './upload/event/';
        // $config['allowed_types'] = 'gif|jpg|png';
        // $config['file_name'] = uniqid();
        // $config['overwrite'] = true;
        // $config['max_size'] = 5120;

    //     $this->load->library('upload', $config);

    //     if (!$this->upload->do_upload('foto_kegiatan'))
    //     {
            // $error = array('error' => $this->upload->display_errors());
            // $this->load->view('admin/direct/event/add', $error);
            // return "default.png";
    //     } 
    //     else
    //     {
    //         return $this->upload->data('file_name');
    //     }        
    // }

    // private function deleteImage($id)
    // {
    //     $post = $this->getById($id);
    //     if ($post->foto_kegiatan != 'default.png')
    //     {
    //         $filename = explode('.', $post->foto_kegiatan)[0];
    //         return array_map('unlink', glob(FCPATH."upload/event/$filename.*"));
    //     }
    // }
}

