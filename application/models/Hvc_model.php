<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hvc_model extends CI_Model
{
    private $table = 'tbl_hvc';
    private $id_hvc;
    private $kode_tdc;
    private $tgl_hvc;
    private $nama_mercent;
    private $kode_marketing;
    private $longlat_lokasi_mercent;
    private $latitude_lokasi_mercent;
    private $alamat;
    private $qty_5k;
    private $qty_10k;
    private $qty_20k;
    private $qty_25k;
    private $qty_50k;
    private $qty_100k;
    private $mount_bulk;
    private $qty_low_nsb;
    private $qty_middle_nsb;
    private $qty_high_nsb;
    private $qty_as_nsb;
    private $qty_simpati_nsb;
    private $qty_loop_nsb;
    private $keterangan_kegiatan;
    private $kode_user;

    public function rules()
    {
        return [
            ['field' => 'kode_tdc', 'label' => 'Kode TDC','rules' => 'required'],
            ['field' => 'tgl_hvc', 'label' => 'Tanggal HVC','rules' => 'required'],
            ['field' => 'nama_mercent', 'label' => 'Tanggal Event','rules' => 'required'],
            ['field' => 'kode_marketing', 'label' => 'Kode Marketing','rules' => 'required'],           
            ['field' => 'longlat_lokasi_mercent', 'label' => 'Longlat Mercent','rules' => 'required'],
            ['field' => 'latitude_lokasi_mercent', 'label' => 'Latitude Mercent','rules' => 'required'],
            ['field' => 'alamat', 'label' => 'Alamat','rules' => 'required'], 
            ['field' => 'qty_5k', 'label' => 'QTY 5K','rules' => 'required'],
            ['field' => 'qty_10k', 'label' => 'QTY 10K','rules' => 'required'],
            ['field' => 'qty_20k', 'label' => 'QTY 20K','rules' => 'required'],
            ['field' => 'qty_25k', 'label' => 'QTY 25K','rules' => 'required'],
            ['field' => 'qty_50k', 'label' => 'QTY 50K','rules' => 'required'],
            ['field' => 'qty_100k', 'label' => 'QTY 100K','rules' => 'required'],
            ['field' => 'mount_bulk', 'label' => 'Mount Bulk','rules' => 'required'],
            ['field' => 'qty_low_nsb', 'label' => 'QTY Low NSB','rules' => 'required'],
            ['field' => 'qty_middle_nsb', 'label' => 'QTY middle NSB','rules' => 'required'],
            ['field' => 'qty_high_nsb', 'label' => 'QTY high NSB','rules' => 'required'],
            ['field' => 'qty_as_nsb', 'label' => 'QTY as NSB','rules' => 'required'],
            ['field' => 'qty_simpati_nsb', 'label' => 'QTY simpati NSB','rules' => 'required'],
            ['field' => 'qty_loop_nsb', 'label' => 'QTY loop NSB','rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id_hvc' => $id])->row();
    }

    public function getThisTableRecord($table)
    {
        return $this->db->get($table)->result();
    }

    public function getRelated($tdc=null, $start=null, $end=null)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS ev');
        $this->db->join('tbl_tdc AS tdc', 'tdc.kode_tdc = ev.kode_tdc', 'left');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = ev.kode_marketing', 'left');
        $this->db->join('tbl_user AS usr', 'usr.kode_user = ev.kode_user', 'left');
        if ($start && $end) :
            $this->db->where("ev.tgl_hvc BETWEEN '$start' AND '$end'");
        endif;
        if ($tdc)
            $this->db->where('ev.kode_tdc', $tdc);
        return $this->db->get()->result();
    }

    public function getDetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS e');
        $this->db->join('tbl_tdc AS t', 't.kode_tdc = e.kode_tdc', 'left');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = e.kode_marketing', 'left');
        $this->db->join('tbl_user AS u', 'u.kode_user = e.kode_user', 'left');
        $this->db->where('e.id_hvc', $id);
        return $this->db->get()->row();
    }

    public function save()
    {
        $post = $this->input->post();
        if ($_FILES['foto_kegiatan']['name'] == (array(0 => NULL)))
        {
            $this->foto_kegiatan = NULL;
        }
        else
        { 
            $this->foto_kegiatan = $this->uploadMultipleImages();
        }
        $data = array(
            'kode_tdc' => $this->kode_tdc = $post['kode_tdc'],
            'tgl_hvc' => $this->tgl_hvc = date('Y-m-d', strtotime($post['tgl_hvc'])),
            'nama_mercent' => $this->nama_mercent = strtoupper($post['nama_mercent']),
            'kode_marketing' => $this->kode_marketing = $post['kode_marketing'],
            'longlat_lokasi_mercent' => $this->longlat_lokasi_mercent = $post['longlat_lokasi_mercent'],
            'latitude_lokasi_mercent' => $this->latitude_lokasi_mercent = $post['latitude_lokasi_mercent'],
            'alamat' => $this->alamat = strtoupper($post['alamat']),
            'qty_5k' => $this->qty_5k = $post['qty_5k'],
            'qty_10k' => $this->qty_10k = $post['qty_10k'],
            'qty_20k' => $this->qty_20k = $post['qty_20k'],
            'qty_25k' => $this->qty_25k = $post['qty_25k'],
            'qty_50k' => $this->qty_50k = $post['qty_50k'],
            'qty_100k' => $this->qty_100k = $post['qty_100k'],
            'mount_bulk' => $this->mount_bulk = $post['mount_bulk'],
            'qty_low_nsb' => $this->qty_low_nsb = $post['qty_low_nsb'],
            'qty_middle_nsb' => $this->qty_middle_nsb = $post['qty_middle_nsb'],
            'qty_high_nsb' => $this->qty_high_nsb = $post['qty_high_nsb'],
            'qty_as_nsb' => $this->qty_as_nsb = $post['qty_as_nsb'],
            'qty_simpati_nsb' => $this->qty_simpati_nsb = $post['qty_simpati_nsb'],
            'qty_loop_nsb' => $this->qty_loop_nsb = $post['qty_loop_nsb'],
            'foto_kegiatan' => $this->foto_kegiatan,
            'keterangan_kegiatan' => $this->keterangan_kegiatan = strtoupper($post['keterangan_kegiatan']),
            'kode_user' => $this->kode_user = $this->session->userdata['user'],
        );
        
        $this->db->set($data);
        $this->db->insert($this->table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        if ($_FILES['foto_kegiatan']['name'] == (array(0 => NULL)))
        {
            $this->foto_kegiatan = $post['old_image'];
        } 
        else
        {
            $this->removeImage($id);
            $this->foto_kegiatan = $this->uploadMultipleImages();
        }
        $data = array(
            'kode_tdc' => $this->kode_tdc = $post['kode_tdc'],
            'tgl_hvc' => $this->tgl_hvc = date('Y-m-d', strtotime($post['tgl_hvc'])),
            'nama_mercent' => $this->nama_mercent = strtoupper($post['nama_mercent']),
            'kode_marketing' => $this->kode_marketing = $post['kode_marketing'],
            'longlat_lokasi_mercent' => $this->longlat_lokasi_mercent = $post['longlat_lokasi_mercent'],
            'latitude_lokasi_mercent' => $this->latitude_lokasi_mercent = $post['latitude_lokasi_mercent'],
            'alamat' => $this->alamat = strtoupper($post['alamat']),
            'qty_5k' => $this->qty_5k = $post['qty_5k'],
            'qty_10k' => $this->qty_10k = $post['qty_10k'],
            'qty_20k' => $this->qty_20k = $post['qty_20k'],
            'qty_25k' => $this->qty_25k = $post['qty_25k'],
            'qty_50k' => $this->qty_50k = $post['qty_50k'],
            'qty_100k' => $this->qty_100k = $post['qty_100k'],
            'mount_bulk' => $this->mount_bulk = $post['mount_bulk'],
            'qty_low_nsb' => $this->qty_low_nsb = $post['qty_low_nsb'],
            'qty_middle_nsb' => $this->qty_middle_nsb = $post['qty_middle_nsb'],
            'qty_high_nsb' => $this->qty_high_nsb = $post['qty_high_nsb'],
            'qty_as_nsb' => $this->qty_as_nsb = $post['qty_as_nsb'],
            'qty_simpati_nsb' => $this->qty_simpati_nsb = $post['qty_simpati_nsb'],
            'qty_loop_nsb' => $this->qty_loop_nsb = $post['qty_loop_nsb'],
            'foto_kegiatan' => $this->foto_kegiatan,
            'keterangan_kegiatan' => $this->keterangan_kegiatan = strtoupper($post['keterangan_kegiatan']),
        );
        
        $this->db->set($data);
        $this->db->update($this->table, $this, array('id_hvc' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id_hvc' => $id));
    }

    private function uploadImage()
    {
        $config['upload_path'] = './upload/hvc/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = uniqid();
        $config['overwrite'] = true;
        $config['max_size'] = 5120;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto_kegiatan'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('admin/direct/hvc/new_form', $error);
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
            return array_map('unlink', glob(FCPATH."upload/hvc/$filename.*"));
        }
    }

    private function uploadMultipleImages()
    {
        $data_info = array();
        $img_ids = array();
        $count = count($_FILES['foto_kegiatan']['name']);
        for ($i = 0; $i < $count; $i++)
        {
            $_FILES['image']['name'] = $_FILES['foto_kegiatan']['name'][$i];
            $_FILES['image']['type'] = $_FILES['foto_kegiatan']['type'][$i];
            $_FILES['image']['tmp_name'] = $_FILES['foto_kegiatan']['tmp_name'][$i];
            $_FILES['image']['error'] = $_FILES['foto_kegiatan']['error'][$i];
            $_FILES['image']['size'] = $_FILES['foto_kegiatan']['size'][$i];
            
            $config['upload_path'] = './upload/hvc/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name'] = "HVC_" . uniqid();
            $config['overwrite'] = true;
            $config['max_size'] = 5120;

            $this->load->library('upload', $config);            
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image'))
            {
                die('sdsad');
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('direct/hvc/new_form', $error);
            }
            else
            {
                $file_data = $this->upload->data();
                array_push($img_ids, $file_data);
            }
        }
        
        return json_encode($img_ids);
    }

    private function removeImage($id) 
    {
        $ret = $this->db->get_where($this->table, array('id_hvc' => $id));
        
        if ($ret->num_rows() > 0) 
        {
            $res = $ret->row();
            $file_data = json_decode($res->foto);
            try 
            {
                for ($i=0; $i < count($file_data); $i++)
                {
                    if (is_file($file_data[$i]->full_path)) 
                    {
                        unlink($file_data[$i]->full_path);
                    }
                }
            } 
            catch (Exception $e)
            {

            }
        }
    }

}