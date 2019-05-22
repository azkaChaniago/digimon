<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualanharian_model extends CI_Model
{
    private $table = 'tbl_penjualan_harian';
    private $id_penjualan;
    private $kode_tdc;
    private $divisi;
    private $tgl_penjualan;
    private $kode_marketing;
    private $lokasi_penjualan;
    private $qty_5k;
    private $qty_10k;
    private $qty_20k;
    private $qty_25k;
    private $qty_50k;
    private $qty_100k;
    private $mount_bulk;
    private $mount_legacy;
    private $paket_max_digital;
    private $msdn_tcash;
    private $no_msdn_digital;
    private $cashin_tcash;
    private $status_tcash;
    private $qty_low_nsb;
    private $qty_middle_nsb;
    private $qty_high_nsb;
    private $qty_as_nsb;
    private $qty_simpati_nsb;
    private $qty_loop_nsb;
    private $foto_kegiatan = 'default.png';
    private $kode_user;

    public function rules()
    {
        return [
            ['field' => 'kode_tdc', 'label' => 'Kode TDC','rules' => 'required'],
            ['field' => 'divisi', 'label' => 'Divisi','rules' => 'required'],
            ['field' => 'tgl_penjualan', 'label' => 'Tanggal Event','rules' => 'required'],
            ['field' => 'kode_marketing', 'label' => 'Kode Marketing','rules' => 'required'],           
            ['field' => 'lokasi_penjualan', 'label' => 'Lokasi Penjualan','rules' => 'required'],
            ['field' => 'qty_5k', 'label' => 'QTY 5K','rules' => 'required'],
            ['field' => 'qty_10k', 'label' => 'QTY 10K','rules' => 'required'],
            ['field' => 'qty_20k', 'label' => 'QTY 20K','rules' => 'required'],
            ['field' => 'qty_25k', 'label' => 'QTY 25K','rules' => 'required'],
            ['field' => 'qty_50k', 'label' => 'QTY 50K','rules' => 'required'],
            ['field' => 'qty_100k', 'label' => 'QTY 100K','rules' => 'required'],
            ['field' => 'mount_bulk', 'label' => 'Mount Bulk','rules' => 'required'],
            ['field' => 'mount_legacy', 'label' => 'Mount Legacy','rules' => 'required'],
            ['field' => 'paket_max_digital', 'label' => 'Paket Max Digital','rules' => 'required'],
            ['field' => 'no_msdn_digital', 'label' => 'No MSDN Digital','rules' => 'required'],
            ['field' => 'cashin_tcash', 'label' => 'Cashin Tcash','rules' => 'required'],
            ['field' => 'status_tcash', 'label' => 'Mount legacy','rules' => 'required'],            
            ['field' => 'qty_low_nsb', 'label' => 'QTY Low NSB','rules' => 'required'],
            ['field' => 'qty_middle_nsb', 'label' => 'QTY middle NSB','rules' => 'required'],
            ['field' => 'qty_high_nsb', 'label' => 'QTY high NSB','rules' => 'required'],
            ['field' => 'qty_as_nsb', 'label' => 'QTY as NSB','rules' => 'required'],
            ['field' => 'qty_simpati_nsb', 'label' => 'QTY simpati NSB','rules' => 'required'],
            ['field' => 'qty_loop_nsb', 'label' => 'QTY loop NSB','rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id_penjualan' => $id])->row();
    }

    public function getThisTableRecord($table)
    {
        return $this->db->get($table)->result();
    }

    public function getRelated($tdc, $start=null, $end=null)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS ev');
        $this->db->join('tbl_tdc AS tdc', 'tdc.kode_tdc = ev.kode_tdc', 'left');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = ev.kode_marketing', 'left');
        $this->db->join('tbl_user AS usr', 'usr.kode_user = ev.kode_user', 'left');
        if ($start && $end) :
            $this->db->where("ev.tgl_penjualan BETWEEN '$start' AND '$end'");
        endif;
        $this->db->where('tdc.kode_tdc', $tdc);
        return $this->db->get()->result();
    }

    public function getDetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS e');
        $this->db->join('tbl_tdc AS t', 't.kode_tdc = e.kode_tdc', 'left');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = e.kode_marketing', 'left');
        $this->db->join('tbl_user AS u', 'u.kode_user = e.kode_user', 'left');
        $this->db->where('e.id_penjualan', $id);
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
            'divisi' => $this->divisi = strtoupper($post['divisi']),
            'tgl_penjualan' => $this->tgl_penjualan = date('Y-m-d', strtotime($post['tgl_penjualan'])),
            'kode_marketing' => $this->kode_marketing = $post['kode_marketing'],
            'lokasi_penjualan' => $this->lokasi_penjualan = strtoupper($post['lokasi_penjualan']),
            'qty_5k' => $this->qty_5k = $post['qty_5k'],
            'qty_10k' => $this->qty_10k = $post['qty_10k'],
            'qty_20k' => $this->qty_20k = $post['qty_20k'],
            'qty_25k' => $this->qty_25k = $post['qty_25k'],
            'qty_50k' => $this->qty_50k = $post['qty_50k'],
            'qty_100k' => $this->qty_100k = $post['qty_100k'],
            'mount_bulk' => $this->mount_bulk = $post['mount_bulk'],
            'mount_legacy' => $this->mount_legacy = $post['mount_legacy'],
            'paket_max_digital' => $this->paket_max_digital = $post['paket_max_digital'],
            'no_msdn_digital' => $this->no_msdn_digital = $post['no_msdn_digital'],
            'msdn_tcash' => $this->msdn_tcash = $post['msdn_tcash'],
            'price_digital' => $this->price_digital = $post['price_digital'],
            'cashin_tcash' => $this->cashin_tcash = $post['cashin_tcash'],
            'status_tcash' => $this->status_tcash = $post['status_tcash'],
            'qty_low_nsb' => $this->qty_low_nsb = $post['qty_low_nsb'],
            'qty_middle_nsb' => $this->qty_middle_nsb = $post['qty_middle_nsb'],
            'qty_high_nsb' => $this->qty_high_nsb = $post['qty_high_nsb'],
            'qty_as_nsb' => $this->qty_as_nsb = $post['qty_as_nsb'],
            'qty_simpati_nsb' => $this->qty_simpati_nsb = $post['qty_simpati_nsb'],
            'qty_loop_nsb' => $this->qty_loop_nsb = $post['qty_loop_nsb'],
            'foto_kegiatan' => $this->foto_kegiatan,
            'kode_user' => $this->kode_user = $this->session->userdata('kode_user'),
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
            'divisi' => $this->divisi = strtoupper($post['divisi']),
            'tgl_penjualan' => $this->tgl_penjualan = date('Y-m-d', strtotime($post['tgl_penjualan'])),
            'kode_marketing' => $this->kode_marketing = strtoupper($post['kode_marketing']),
            'lokasi_penjualan' => $this->lokasi_penjualan = strtoupper($post['lokasi_penjualan']),
            'qty_5k' => $this->qty_5k = $post['qty_5k'],
            'qty_10k' => $this->qty_10k = $post['qty_10k'],
            'qty_20k' => $this->qty_20k = $post['qty_20k'],
            'qty_25k' => $this->qty_25k = $post['qty_25k'],
            'qty_50k' => $this->qty_50k = $post['qty_50k'],
            'qty_100k' => $this->qty_100k = $post['qty_100k'],
            'mount_bulk' => $this->mount_bulk = $post['mount_bulk'],
            'mount_legacy' => $this->mount_legacy = $post['mount_legacy'],
            'paket_max_digital' => $this->paket_max_digital = $post['paket_max_digital'],
            'no_msdn_digital' => $this->no_msdn_digital = $post['no_msdn_digital'],
            'msdn_tcash' => $this->msdn_tcash = $post['msdn_tcash'],
            'price_digital' => $this->price_digital = $post['price_digital'],
            'cashin_tcash' => $this->cashin_tcash = $post['cashin_tcash'],
            'status_tcash' => $this->status_tcash = $post['status_tcash'],
            'qty_low_nsb' => $this->qty_low_nsb = $post['qty_low_nsb'],
            'qty_middle_nsb' => $this->qty_middle_nsb = $post['qty_middle_nsb'],
            'qty_high_nsb' => $this->qty_high_nsb = $post['qty_high_nsb'],
            'qty_as_nsb' => $this->qty_as_nsb = $post['qty_as_nsb'],
            'qty_simpati_nsb' => $this->qty_simpati_nsb = $post['qty_simpati_nsb'],
            'qty_loop_nsb' => $this->qty_loop_nsb = $post['qty_loop_nsb'],
            'foto_kegiatan' => $this->foto_kegiatan,
            'kode_user' => $this->kode_user = $post['kode_user'],
        );
        
        $this->db->set($data);
        $this->db->update($this->table, $this, array('id_penjualan' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id_penjualan' => $id));
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
            
            $config['upload_path'] = './upload/penjualanharian/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name'] = "PENJUALANHARIAN_" . uniqid();
            $config['overwrite'] = true;
            $config['max_size'] = 5120;

            $this->load->library('upload', $config);            
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image'))
            {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('direct/penjualanharian/new_form', $error);
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
        $ret = $this->db->get_where($this->table, array('id_penjualan' => $id));
        
        if ($ret->num_rows() > 0) 
        {
            $res = $ret->row();
            $file_data = json_decode($res->foto_kegiatan);
            for ($i=0; $i < count($file_data); $i++)
            {
                if (is_file($file_data[$i]->full_path)) 
                {
                    unlink($file_data[$i]->full_path);
                }
            }
        }
    }

}