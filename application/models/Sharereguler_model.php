<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sharereguler_model extends CI_Model
{
    private $table = 'tbl_market_share_regular';
    private $id_market;
    private $tanggal;
    private $kecamatan;
    private $qty_telkomsel_marketshare;
    private $qty_indosat_marketshare;
    private $qty_xl_marketshare;
    private $qty_tri_marketshare;
    private $qty_smartfrend_marketshare;
    private $mount_telkomsel_rechargeshare;
    private $mount_indosat_rechargeshare;
    private $mount_xl_rechargeshare;
    private $mount_tri_rechargeshare;
    private $mount_smartfrend_rechargeshare;
    private $qty_telkomsel_salesshare;
    private $qty_indosat_salesshare;
    private $qty_xl_salesshare;
    private $qty_tri_salesshare;
    private $qty_smartfrend_salesshare;
    private $kode_user;

    public function marketrules()
    {
        return [
            ['field' => 'tanggal', 'label' => 'Tanggal','rules' => 'required'],
            ['field' => 'kabupaten', 'label' => 'Kabupaten','rules' => 'required'],
            ['field' => 'kecamatan', 'label' => 'Kecamatan','rules' => 'required'],
            ['field' => 'qty_simpati_marketshare', 'label' => 'Qyt Simpati Marketshare','rules' => 'required'],
            ['field' => 'qty_as_marketshare', 'label' => 'Qyt AS Marketshare','rules' => 'required'],
            ['field' => 'qty_loop_marketshare', 'label' => 'Qyt Loop Marketshare','rules' => 'required'],
            ['field' => 'qty_mentari_marketshare', 'label' => 'Qyt Mentari Marketshare','rules' => 'required'],
            ['field' => 'qty_im3_marketshare', 'label' => 'Qyt IM3 Marketshare','rules' => 'required'],
            ['field' => 'qty_xl_marketshare', 'label' => 'Qyt XL Marketshare','rules' => 'required'],
            ['field' => 'qty_tri_marketshare', 'label' => 'Qyt Tri Marketshare','rules' => 'required'],
            ['field' => 'qty_smartfrend_marketshare', 'label' => 'Qyt Smartfrend Marketshare','rules' => 'required'],                                   
        ];
    }

    public function rechargerules()
    {
        return [
            ['field' => 'tanggal', 'label' => 'Tanggal','rules' => 'required'],
            ['field' => 'kabupaten', 'label' => 'Kabupaten','rules' => 'required'],
            ['field' => 'kecamatan', 'label' => 'Kecamatan','rules' => 'required'],
            ['field' => 'mount_simpati_rechargeshare', 'label' => 'Mount Simpati Rechargeshare','rules' => 'required'],
            ['field' => 'mount_as_rechargeshare', 'label' => 'Mount AS Rechargeshare','rules' => 'required'],
            ['field' => 'mount_loop_rechargeshare', 'label' => 'Mount Loop Rechargeshare','rules' => 'required'],
            ['field' => 'mount_mentari_rechargeshare', 'label' => 'Mount Mentari Rechargeshare','rules' => 'required'],
            ['field' => 'mount_im3_rechargeshare', 'label' => 'Mount IM3 Rechargeshare','rules' => 'required'],
            ['field' => 'mount_xl_rechargeshare', 'label' => 'Mount XL Rechargeshare','rules' => 'required'],
            ['field' => 'mount_tri_rechargeshare', 'label' => 'Mount Tri Rechargeshare','rules' => 'required'],
            ['field' => 'mount_smartfrend_rechargeshare', 'label' => 'Mount Smartfrend Rechargeshare','rules' => 'required'],                            
        ];
    }

    public function salesrules()
    {
        return [
            ['field' => 'tanggal', 'label' => 'Tanggal','rules' => 'required'],
            ['field' => 'kabupaten', 'label' => 'Kabupaten','rules' => 'required'],
            ['field' => 'kecamatan', 'label' => 'Kecamatan','rules' => 'required'],
            ['field' => 'qty_simpati_salesshare', 'label' => 'Qyt Simpati Salesshare','rules' => 'required'],
            ['field' => 'qty_as_salesshare', 'label' => 'Qyt AS Salesshare','rules' => 'required'],
            ['field' => 'qty_loop_salesshare', 'label' => 'Qyt Loop Salesshare','rules' => 'required'],
            ['field' => 'qty_mentari_salesshare', 'label' => 'Qyt Mentari Salesshare','rules' => 'required'],
            ['field' => 'qty_im3_salesshare', 'label' => 'Qyt IM3 Salesshare','rules' => 'required'],
            ['field' => 'qty_xl_salesshare', 'label' => 'Qyt XL Salesshare','rules' => 'required'],
            ['field' => 'qty_tri_salesshare', 'label' => 'Qyt Tri Salesshare','rules' => 'required'],
            ['field' => 'qty_smartfrend_salesshare', 'label' => 'Qyt Smartfrend Salesshare','rules' => 'required'],                                     
        ];
    }

    public function getAll($table, $kode)
    {
        $this->db->select('*');
        $this->db->from($table . ' as msr');
        $this->db->join('tbl_user as u', 'msr.kode_user = u.kode_user', 'left');
        $this->db->where('u.kode_tdc', $kode);
        return $this->db->get()->result();
    }

    public function getGraphMS($kode, $group)
    {
        $sql = $this->db->query("SELECT 
                                kabupaten,
                                kecamatan,
                                ROUND(SUM(qty_telkomsel_marketshare + qty_indosat_marketshare + qty_xl_marketshare + qty_tri_marketshare + qty_smartfrend_marketshare)/
                                (SELECT SUM(qty_telkomsel_marketshare + qty_indosat_marketshare + qty_xl_marketshare + qty_tri_marketshare + qty_smartfrend_marketshare)
                                FROM tbl_market_share_regular
                                WHERE kode_user = '$kode') * 100, 2) AS 'total_market_share'
                            FROM tbl_market_share_regular
                            WHERE kode_user = '$kode'
                            GROUP BY $group");
        return $sql->result();
    }

    public function getCluster($kode)
    {
        $sql = $this->db->query("SELECT 
                                    SUM(qty_telkomsel_marketshare) AS `qty_telkomsel`,
                                    SUM(qty_indosat_marketshare) AS `qty_indosat`,
                                    SUM(qty_xl_marketshare) AS `qty_xl`,
                                    SUM(qty_tri_marketshare) AS `qty_tri`,
                                    SUM(qty_smartfrend_marketshare) AS `qty_smartfrend`
                                FROM db_telkomsel.tbl_market_share_regular WHERE kode_user = '$kode'");
        return $sql->result();
    }

    public function getGraphMSKecamatan($kode, $kab)
    {
        $sql = $this->db->query("SELECT 
                                kabupaten,
                                kecamatan,
                                ROUND(SUM(qty_telkomsel_marketshare + qty_indosat_marketshare + qty_xl_marketshare + qty_tri_marketshare + qty_smartfrend_marketshare)/
                                (SELECT SUM(qty_telkomsel_marketshare + qty_indosat_marketshare + qty_xl_marketshare + qty_tri_marketshare + qty_smartfrend_marketshare)
                                FROM tbl_market_share_regular
                                WHERE kode_user = '$kode') * 100, 2) AS 'total_market_share'
                            FROM tbl_market_share_regular
                            WHERE kabupaten = '$kab' AND kode_user = '$kode'
                            GROUP BY kecamatan");
        return $sql->row();
    }

    public function selectView($view, $kode)
    {
        $this->db->select('*');
        $this->db->from($view);
        $this->db->where('kode_tdc', $kode);
        return $this->db->get()->result();
    }

    public function getHistori()
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS t');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = t.kode_marketing', 'left');
        $this->db->join('tbl_outlet AS o', 'o.id_outlet = t.id_outlet', 'left');
        // $this->db->where('m.kode_marketing', 'o.kode_marketing');
        return $this->db->get()->result();
    }

    public function getById($table, $id)
    {
        return $this->db->get_where($table, ['id' => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $tanggal = date('Y-m-d', strtotime($post['tanggal']));
        $data = array(
            'tanggal' => $this->tanggal = $tanggal,
            'kabupaten' => $this->kabupaten = $post['kabupaten'],
            'kecamatan' => $this->kecamatan = $post['kecamatan'],
            'qty_simpati_marketshare' => $this->qty_simpati_marketshare = str_replace(".","",$post['qty_simpati_marketshare']),
            'qty_as_marketshare' => $this->qty_as_marketshare = str_replace(".","",$post['qty_as_marketshare']),
            'qty_loop_marketshare' => $this->qty_loop_marketshare = str_replace(".","",$post['qty_loop_marketshare']),
            'qty_telkomsel_marketshare' => $this->qty_telkomsel_marketshare = str_replace(".","",$post['qty_simpati_marketshare']) + str_replace(".","",$post['qty_as_marketshare']) +str_replace(".","", $post['qty_loop_marketshare']),
            'qty_mentari_marketshare' => $this->qty_mentari_marketshare = str_replace(".","",$post['qty_mentari_marketshare']),
            'qty_im3_marketshare' => $this->qty_im3_marketshare = str_replace(".","",$post['qty_im3_marketshare']),
            'qty_indosat_marketshare' => $this->qty_indosat_marketshare = str_replace(".","",$post['qty_mentari_marketshare']) + str_replace(".","",$post['qty_im3_marketshare']),
            'qty_xl_marketshare' => $this->qty_xl_marketshare = str_replace(".","",$post['qty_xl_marketshare']),
            'qty_tri_marketshare' => $this->qty_tri_marketshare = str_replace(".","",$post['qty_tri_marketshare']),
            'qty_smartfrend_marketshare' => $this->qty_smartfrend_marketshare = str_replace(".","",$post['qty_smartfrend_marketshare']),
            'mount_simpati_rechargeshare' => $this->mount_simpati_rechargeshare = str_replace(".","",$post['mount_simpati_rechargeshare']),
            'mount_as_rechargeshare' => $this->mount_as_rechargeshare = str_replace(".","",$post['mount_as_rechargeshare']),
            'mount_loop_rechargeshare' => $this->mount_loop_rechargeshare = str_replace(".","",$post['mount_loop_rechargeshare']),
            'mount_telkomsel_rechargeshare' => $this->mount_telkomsel_rechargeshare = str_replace(".","",$post['mount_simpati_rechargeshare']) + str_replace(".","",$post['mount_as_rechargeshare']) + str_replace(".","",$post['mount_loop_rechargeshare']),
            'mount_mentari_rechargeshare' => $this->mount_mentari_rechargeshare = str_replace(".","",$post['mount_mentari_rechargeshare']),
            'mount_im3_rechargeshare' => $this->mount_im3_rechargeshare = str_replace(".","",$post['mount_im3_rechargeshare']),
            'mount_indosat_rechargeshare' => $this->mount_indosat_rechargeshare = str_replace(".","",$post['mount_mentari_rechargeshare']) + str_replace(".","",$post['mount_im3_rechargeshare']),
            'mount_xl_rechargeshare' => $this->mount_xl_rechargeshare = str_replace(".","",$post['mount_xl_rechargeshare']),
            'mount_tri_rechargeshare' => $this->mount_tri_rechargeshare = str_replace(".","",$post['mount_tri_rechargeshare']),
            'mount_smartfrend_rechargeshare' => $this->mount_smartfrend_rechargeshare = str_replace(".","",$post['mount_smartfrend_rechargeshare']),
            'qty_simpati_salesshare' => $this->qty_simpati_salesshare = str_replace(".","",$post['qty_simpati_salesshare']),
            'qty_as_salesshare' => $this->qty_as_salesshare = str_replace(".","",$post['qty_as_salesshare']),
            'qty_loop_salesshare' => $this->qty_loop_salesshare = str_replace(".","",$post['qty_loop_salesshare']),
            'qty_telkomsel_salesshare' => $this->qty_telkomsel_salesshare = str_replace(".","",$post['qty_simpati_salesshare']) + str_replace(".","",$post['qty_as_salesshare']) +str_replace(".","", $post['qty_loop_salesshare']),
            'qty_mentari_salesshare' => $this->qty_mentari_salesshare = str_replace(".","",$post['qty_mentari_salesshare']),
            'qty_im3_salesshare' => $this->qty_im3_salesshare = str_replace(".","",$post['qty_im3_salesshare']),
            'qty_indosat_salesshare' => $this->qty_indosat_salesshare = str_replace(".","",$post['qty_mentari_salesshare']) + str_replace(".","",$post['qty_im3_salesshare']),
            'qty_xl_salesshare' => $this->qty_xl_salesshare = str_replace(".","",$post['qty_xl_salesshare']),
            'qty_tri_salesshare' => $this->qty_tri_salesshare = str_replace(".","",$post['qty_tri_salesshare']),
            'qty_smartfrend_salesshare' => $this->qty_smartfrend_salesshare = str_replace(".","",$post['qty_smartfrend_salesshare']),
            'kode_user' => $this->kode_user = $this->session->userdata('id')
        );
        
        $this->db->set($data);
        $this->db->insert($this->table, $this);
    }

    public function savemarket()
    {
        $post = $this->input->post();
        $tanggal = date('Y-m-d', strtotime($post['tanggal']));
        $data = array(
            'tanggal' => $this->tanggal = $tanggal,
            'kabupaten' => $this->kabupaten = $post['kabupaten'],
            'kecamatan' => $this->kecamatan = $post['kecamatan'],
            'qty_simpati_marketshare' => $this->qty_simpati_marketshare = str_replace(".","",$post['qty_simpati_marketshare']),
            'qty_as_marketshare' => $this->qty_as_marketshare = str_replace(".","",$post['qty_as_marketshare']),
            'qty_loop_marketshare' => $this->qty_loop_marketshare = str_replace(".","",$post['qty_loop_marketshare']),
            'qty_telkomsel_marketshare' => $this->qty_telkomsel_marketshare = str_replace(".","",$post['qty_simpati_marketshare']) + str_replace(".","",$post['qty_as_marketshare']) +str_replace(".","", $post['qty_loop_marketshare']),
            'qty_mentari_marketshare' => $this->qty_mentari_marketshare = str_replace(".","",$post['qty_mentari_marketshare']),
            'qty_im3_marketshare' => $this->qty_im3_marketshare = str_replace(".","",$post['qty_im3_marketshare']),
            'qty_indosat_marketshare' => $this->qty_indosat_marketshare = str_replace(".","",$post['qty_mentari_marketshare']) + str_replace(".","",$post['qty_im3_marketshare']),
            'qty_xl_marketshare' => $this->qty_xl_marketshare = str_replace(".","",$post['qty_xl_marketshare']),
            'qty_tri_marketshare' => $this->qty_tri_marketshare = str_replace(".","",$post['qty_tri_marketshare']),
            'qty_smartfrend_marketshare' => $this->qty_smartfrend_marketshare = str_replace(".","",$post['qty_smartfrend_marketshare']),
            'kode_user' => $this->kode_user = $this->session->userdata('id')
        );
        
        $this->db->set($data);
        $this->db->insert('tbl_reg_marketshare', $this);
    }

    public function saverecharge()
    {
        $post = $this->input->post();
        $tanggal = date('Y-m-d', strtotime($post['tanggal']));
        $data = array(
            'tanggal' => $this->tanggal = $tanggal,
            'kabupaten' => $this->kabupaten = $post['kabupaten'],
            'kecamatan' => $this->kecamatan = $post['kecamatan'],
            'mount_simpati_rechargeshare' => $this->mount_simpati_rechargeshare = str_replace(".","",$post['mount_simpati_rechargeshare']),
            'mount_as_rechargeshare' => $this->mount_as_rechargeshare = str_replace(".","",$post['mount_as_rechargeshare']),
            'mount_loop_rechargeshare' => $this->mount_loop_rechargeshare = str_replace(".","",$post['mount_loop_rechargeshare']),
            'mount_telkomsel_rechargeshare' => $this->mount_telkomsel_rechargeshare = str_replace(".","",$post['mount_simpati_rechargeshare']) + str_replace(".","",$post['mount_as_rechargeshare']) + str_replace(".","",$post['mount_loop_rechargeshare']),
            'mount_mentari_rechargeshare' => $this->mount_mentari_rechargeshare = str_replace(".","",$post['mount_mentari_rechargeshare']),
            'mount_im3_rechargeshare' => $this->mount_im3_rechargeshare = str_replace(".","",$post['mount_im3_rechargeshare']),
            'mount_indosat_rechargeshare' => $this->mount_indosat_rechargeshare = str_replace(".","",$post['mount_mentari_rechargeshare']) + str_replace(".","",$post['mount_im3_rechargeshare']),
            'mount_xl_rechargeshare' => $this->mount_xl_rechargeshare = str_replace(".","",$post['mount_xl_rechargeshare']),
            'mount_tri_rechargeshare' => $this->mount_tri_rechargeshare = str_replace(".","",$post['mount_tri_rechargeshare']),
            'mount_smartfrend_rechargeshare' => $this->mount_smartfrend_rechargeshare = str_replace(".","",$post['mount_smartfrend_rechargeshare']),
            'kode_user' => $this->kode_user = $this->session->userdata('id')
        );
        
        $this->db->set($data);
        $this->db->insert('tbl_reg_rechargeshare', $this);
    }

    public function savesales()
    {
        $post = $this->input->post();
        $tanggal = date('Y-m-d', strtotime($post['tanggal']));
        $data = array(
            'tanggal' => $this->tanggal = $tanggal,
            'kabupaten' => $this->kabupaten = $post['kabupaten'],
            'kecamatan' => $this->kecamatan = $post['kecamatan'],
            'qty_simpati_salesshare' => $this->qty_simpati_salesshare = str_replace(".","",$post['qty_simpati_salesshare']),
            'qty_as_salesshare' => $this->qty_as_salesshare = str_replace(".","",$post['qty_as_salesshare']),
            'qty_loop_salesshare' => $this->qty_loop_salesshare = str_replace(".","",$post['qty_loop_salesshare']),
            'qty_telkomsel_salesshare' => $this->qty_telkomsel_salesshare = str_replace(".","",$post['qty_simpati_salesshare']) + str_replace(".","",$post['qty_as_salesshare']) +str_replace(".","", $post['qty_loop_salesshare']),
            'qty_mentari_salesshare' => $this->qty_mentari_salesshare = str_replace(".","",$post['qty_mentari_salesshare']),
            'qty_im3_salesshare' => $this->qty_im3_salesshare = str_replace(".","",$post['qty_im3_salesshare']),
            'qty_indosat_salesshare' => $this->qty_indosat_salesshare = str_replace(".","",$post['qty_mentari_salesshare']) + str_replace(".","",$post['qty_im3_salesshare']),
            'qty_xl_salesshare' => $this->qty_xl_salesshare = str_replace(".","",$post['qty_xl_salesshare']),
            'qty_tri_salesshare' => $this->qty_tri_salesshare = str_replace(".","",$post['qty_tri_salesshare']),
            'qty_smartfrend_salesshare' => $this->qty_smartfrend_salesshare = str_replace(".","",$post['qty_smartfrend_salesshare']),
            'kode_user' => $this->kode_user = $this->session->userdata('id')
        );
        
        $this->db->set($data);
        $this->db->insert('tbl_reg_salesshare', $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        $tanggal = date('Y-m-d', strtotime($post['tanggal']));
        $data = array(
            'tanggal' => $this->tanggal = $tanggal,
            'kabupaten' => $this->kabupaten = $post['kabupaten'],
            'kecamatan' => $this->kecamatan = $post['kecamatan'],
            'qty_simpati_marketshare' => $this->qty_simpati_marketshare = str_replace(".","",$post['qty_simpati_marketshare']),
            'qty_as_marketshare' => $this->qty_as_marketshare = str_replace(".","",$post['qty_as_marketshare']),
            'qty_loop_marketshare' => $this->qty_loop_marketshare = str_replace(".","",$post['qty_loop_marketshare']),
            'qty_telkomsel_marketshare' => $this->qty_telkomsel_marketshare = str_replace(".","",$post['qty_simpati_marketshare']) + str_replace(".","",$post['qty_as_marketshare']) +str_replace(".","", $post['qty_loop_marketshare']),
            'qty_mentari_marketshare' => $this->qty_mentari_marketshare = str_replace(".","",$post['qty_mentari_marketshare']),
            'qty_im3_marketshare' => $this->qty_im3_marketshare = str_replace(".","",$post['qty_im3_marketshare']),
            'qty_indosat_marketshare' => $this->qty_indosat_marketshare = str_replace(".","",$post['qty_mentari_marketshare']) + str_replace(".","",$post['qty_im3_marketshare']),
            'qty_xl_marketshare' => $this->qty_xl_marketshare = str_replace(".","",$post['qty_xl_marketshare']),
            'qty_tri_marketshare' => $this->qty_tri_marketshare = str_replace(".","",$post['qty_tri_marketshare']),
            'qty_smartfrend_marketshare' => $this->qty_smartfrend_marketshare = str_replace(".","",$post['qty_smartfrend_marketshare']),
            'mount_simpati_rechargeshare' => $this->mount_simpati_rechargeshare = str_replace(".","",$post['mount_simpati_rechargeshare']),
            'mount_as_rechargeshare' => $this->mount_as_rechargeshare = str_replace(".","",$post['mount_as_rechargeshare']),
            'mount_loop_rechargeshare' => $this->mount_loop_rechargeshare = str_replace(".","",$post['mount_loop_rechargeshare']),
            'mount_telkomsel_rechargeshare' => $this->mount_telkomsel_rechargeshare = str_replace(".","",$post['mount_simpati_rechargeshare']) + str_replace(".","",$post['mount_as_rechargeshare']) + str_replace(".","",$post['mount_loop_rechargeshare']),
            'mount_mentari_rechargeshare' => $this->mount_mentari_rechargeshare = str_replace(".","",$post['mount_mentari_rechargeshare']),
            'mount_im3_rechargeshare' => $this->mount_im3_rechargeshare = str_replace(".","",$post['mount_im3_rechargeshare']),
            'mount_indosat_rechargeshare' => $this->mount_indosat_rechargeshare = str_replace(".","",$post['mount_mentari_rechargeshare']) + str_replace(".","",$post['mount_im3_rechargeshare']),
            'mount_xl_rechargeshare' => $this->mount_xl_rechargeshare = str_replace(".","",$post['mount_xl_rechargeshare']),
            'mount_tri_rechargeshare' => $this->mount_tri_rechargeshare = str_replace(".","",$post['mount_tri_rechargeshare']),
            'mount_smartfrend_rechargeshare' => $this->mount_smartfrend_rechargeshare = str_replace(".","",$post['mount_smartfrend_rechargeshare']),
            'qty_simpati_salesshare' => $this->qty_simpati_salesshare = str_replace(".","",$post['qty_simpati_salesshare']),
            'qty_as_salesshare' => $this->qty_as_salesshare = str_replace(".","",$post['qty_as_salesshare']),
            'qty_loop_salesshare' => $this->qty_loop_salesshare = str_replace(".","",$post['qty_loop_salesshare']),
            'qty_telkomsel_salesshare' => $this->qty_telkomsel_salesshare = str_replace(".","",$post['qty_simpati_salesshare']) + str_replace(".","",$post['qty_as_salesshare']) +str_replace(".","", $post['qty_loop_salesshare']),
            'qty_mentari_salesshare' => $this->qty_mentari_salesshare = str_replace(".","",$post['qty_mentari_salesshare']),
            'qty_im3_salesshare' => $this->qty_im3_salesshare = str_replace(".","",$post['qty_im3_salesshare']),
            'qty_indosat_salesshare' => $this->qty_indosat_salesshare = str_replace(".","",$post['qty_mentari_salesshare']) + str_replace(".","",$post['qty_im3_salesshare']),
            'qty_xl_salesshare' => $this->qty_xl_salesshare = str_replace(".","",$post['qty_xl_salesshare']),
            'qty_tri_salesshare' => $this->qty_tri_salesshare = str_replace(".","",$post['qty_tri_salesshare']),
            'qty_smartfrend_salesshare' => $this->qty_smartfrend_salesshare = str_replace(".","",$post['qty_smartfrend_salesshare']),
        );
        
        $this->db->set($data);
        $this->db->update($this->table, $this, array('id_market' => $id));
    }

    public function updatemarket($id)
    {
        $post = $this->input->post();
        $tanggal = date('Y-m-d', strtotime($post['tanggal']));
        $data = array(
            'tanggal' => $this->tanggal = $tanggal,
            'kabupaten' => $this->kabupaten = $post['kabupaten'],
            'kecamatan' => $this->kecamatan = $post['kecamatan'],
            'qty_simpati_marketshare' => $this->qty_simpati_marketshare = str_replace(".","",$post['qty_simpati_marketshare']),
            'qty_as_marketshare' => $this->qty_as_marketshare = str_replace(".","",$post['qty_as_marketshare']),
            'qty_loop_marketshare' => $this->qty_loop_marketshare = str_replace(".","",$post['qty_loop_marketshare']),
            'qty_telkomsel_marketshare' => $this->qty_telkomsel_marketshare = str_replace(".","",$post['qty_simpati_marketshare']) + str_replace(".","",$post['qty_as_marketshare']) +str_replace(".","", $post['qty_loop_marketshare']),
            'qty_mentari_marketshare' => $this->qty_mentari_marketshare = str_replace(".","",$post['qty_mentari_marketshare']),
            'qty_im3_marketshare' => $this->qty_im3_marketshare = str_replace(".","",$post['qty_im3_marketshare']),
            'qty_indosat_marketshare' => $this->qty_indosat_marketshare = str_replace(".","",$post['qty_mentari_marketshare']) + str_replace(".","",$post['qty_im3_marketshare']),
            'qty_xl_marketshare' => $this->qty_xl_marketshare = str_replace(".","",$post['qty_xl_marketshare']),
            'qty_tri_marketshare' => $this->qty_tri_marketshare = str_replace(".","",$post['qty_tri_marketshare']),
            'qty_smartfrend_marketshare' => $this->qty_smartfrend_marketshare = str_replace(".","",$post['qty_smartfrend_marketshare']),
        );
        
        $this->db->set($data);
        $this->db->update('tbl_reg_marketshare', $this, array('id' => $id));
    }

    public function updaterecharge($id)
    {
        $post = $this->input->post();
        $tanggal = date('Y-m-d', strtotime($post['tanggal']));
        $data = array(
            'tanggal' => $this->tanggal = $tanggal,
            'kabupaten' => $this->kabupaten = $post['kabupaten'],
            'kecamatan' => $this->kecamatan = $post['kecamatan'],
            'mount_simpati_rechargeshare' => $this->mount_simpati_rechargeshare = str_replace(".","",$post['mount_simpati_rechargeshare']),
            'mount_as_rechargeshare' => $this->mount_as_rechargeshare = str_replace(".","",$post['mount_as_rechargeshare']),
            'mount_loop_rechargeshare' => $this->mount_loop_rechargeshare = str_replace(".","",$post['mount_loop_rechargeshare']),
            'mount_telkomsel_rechargeshare' => $this->mount_telkomsel_rechargeshare = str_replace(".","",$post['mount_simpati_rechargeshare']) + str_replace(".","",$post['mount_as_rechargeshare']) + str_replace(".","",$post['mount_loop_rechargeshare']),
            'mount_mentari_rechargeshare' => $this->mount_mentari_rechargeshare = str_replace(".","",$post['mount_mentari_rechargeshare']),
            'mount_im3_rechargeshare' => $this->mount_im3_rechargeshare = str_replace(".","",$post['mount_im3_rechargeshare']),
            'mount_indosat_rechargeshare' => $this->mount_indosat_rechargeshare = str_replace(".","",$post['mount_mentari_rechargeshare']) + str_replace(".","",$post['mount_im3_rechargeshare']),
            'mount_xl_rechargeshare' => $this->mount_xl_rechargeshare = str_replace(".","",$post['mount_xl_rechargeshare']),
            'mount_tri_rechargeshare' => $this->mount_tri_rechargeshare = str_replace(".","",$post['mount_tri_rechargeshare']),
            'mount_smartfrend_rechargeshare' => $this->mount_smartfrend_rechargeshare = str_replace(".","",$post['mount_smartfrend_rechargeshare']),
        );
        
        $this->db->set($data);
        $this->db->update('tbl_reg_rechargeshare', $this, array('id' => $id));
    }

    public function updatesales($id)
    {
        $post = $this->input->post();
        $tanggal = date('Y-m-d', strtotime($post['tanggal']));
        $data = array(
            'tanggal' => $this->tanggal = $tanggal,
            'kabupaten' => $this->kabupaten = $post['kabupaten'],
            'kecamatan' => $this->kecamatan = $post['kecamatan'],
            'qty_simpati_salesshare' => $this->qty_simpati_salesshare = str_replace(".","",$post['qty_simpati_salesshare']),
            'qty_as_salesshare' => $this->qty_as_salesshare = str_replace(".","",$post['qty_as_salesshare']),
            'qty_loop_salesshare' => $this->qty_loop_salesshare = str_replace(".","",$post['qty_loop_salesshare']),
            'qty_telkomsel_salesshare' => $this->qty_telkomsel_salesshare = str_replace(".","",$post['qty_simpati_salesshare']) + str_replace(".","",$post['qty_as_salesshare']) +str_replace(".","", $post['qty_loop_salesshare']),
            'qty_mentari_salesshare' => $this->qty_mentari_salesshare = str_replace(".","",$post['qty_mentari_salesshare']),
            'qty_im3_salesshare' => $this->qty_im3_salesshare = str_replace(".","",$post['qty_im3_salesshare']),
            'qty_indosat_salesshare' => $this->qty_indosat_salesshare = str_replace(".","",$post['qty_mentari_salesshare']) + str_replace(".","",$post['qty_im3_salesshare']),
            'qty_xl_salesshare' => $this->qty_xl_salesshare = str_replace(".","",$post['qty_xl_salesshare']),
            'qty_tri_salesshare' => $this->qty_tri_salesshare = str_replace(".","",$post['qty_tri_salesshare']),
            'qty_smartfrend_salesshare' => $this->qty_smartfrend_salesshare = str_replace(".","",$post['qty_smartfrend_salesshare']),
        );
        
        $this->db->set($data);
        $this->db->update('tbl_reg_salesshare', $this, array('id' => $id));
    }

    public function delete($table, $id)
    {
        return $this->db->delete($table, array('id' => $id));
    }

    public function userList()
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS t');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = t.kode_marketing', 'left');
        $this->db->join('tbl_outlet AS o', 'o.id_outlet = t.id_outlet', 'left');
        // $this->db->where('m.kode_marketing', 'o.kode_marketing');
        return $this->db->get()->result(); 
    }

    public function getDetail($table, $id)
    {
        $this->db->select('*');
        $this->db->from($table . ' AS sr');
        $this->db->join('tbl_user AS u', 'sr.kode_user = u.kode_user', 'inner');
        $this->db->where('sr.id', $id);
        return $this->db->get()->row();
    }

    /**
     * 
     */
    public function getThisTableRecord($table)
    {
        $this->db->select('*');
        $this->db->from($table . ' AS sr');
        $this->db->join('tbl_user AS u', 'sr.kode_user = u.kode_user', 'inner');
        $this->db->join('tbl_tdc AS t', 't.kode_tdc = u.kode_tdc', 'inner');
        return $this->db->get()->result();
    }

    public function chartMarketshare()
    {
        $sql = $this->db->query("select 
                                    sum(qty_telkomsel_marketshare) AS Telkomsel, 
                                    sum(qty_indosat_marketshare) AS Indosat, 
                                    sum(qty_xl_marketshare) AS XL, 
                                    sum(qty_tri_marketshare) AS Tri, 
                                    sum(qty_smartfrend_marketshare) AS Smartfrend 
                                from tbl_reg_marketshare");
        $res = $sql->result();
        // mysqli_next_result($this->db->conn_id);
        return $res;
    }

    public function chartMarketshareKab()
    {
        $sql = $this->db->query("select
                                    kabupaten,
                                    sum(qty_telkomsel_marketshare) AS Telkomsel, 
                                    sum(qty_indosat_marketshare) AS Indosat, 
                                    sum(qty_xl_marketshare) AS XL, 
                                    sum(qty_tri_marketshare) AS Tri, 
                                    sum(qty_smartfrend_marketshare) AS Smartfrend 
                                from tbl_reg_marketshare
                                group by kabupaten");
        $res = $sql->result();
        // mysqli_next_result($this->db->conn_id);
        return $res;
    }

    public function listGraphKecamaatan($kab)
    {
        $sql = $this->db->query("select
                                    kecamatan,
                                    sum(qty_telkomsel_marketshare) AS Telkomsel, 
                                    sum(qty_indosat_marketshare) AS Indosat, 
                                    sum(qty_xl_marketshare) AS XL, 
                                    sum(qty_tri_marketshare) AS Tri, 
                                    sum(qty_smartfrend_marketshare) AS Smartfrend 
                                from tbl_reg_marketshare where kabupaten = '$kab'
                                group by kecamatan");
        return $sql->result();
    }

}


