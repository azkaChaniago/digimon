<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sharebroadband_model extends CI_Model
{
    private $table = 'tbl_market_share_broadband';
    private $id_market;
    private $tanggal;
    private $kecamatan;
    private $qty_telkomsel_marketshare;
    private $qty_indosat_marketshare;
    private $qty_xl_marketshare;
    private $qty_tri_marketshare;
    private $qty_smartfrend_marketshare;
    private $kode_user;

    public function rules()
    {
        return [
            ['field' => 'tanggal', 'label' => 'Tanggal','rules' => 'required'],
            ['field' => 'kabupaten', 'label' => 'Kabupaten','rules' => 'required'],
            ['field' => 'kecamatan', 'label' => 'Kecamatan','rules' => 'required'],
            ['field' => 'qty_telkomsel_marketshare', 'label' => 'Qyt Telkomsel Marketshare','rules' => 'required'],
            ['field' => 'qty_indosat_marketshare', 'label' => 'Qyt Indosat Marketshare','rules' => 'required'],
            ['field' => 'qty_xl_marketshare', 'label' => 'Qyt XL Marketshare','rules' => 'required'],
            ['field' => 'qty_tri_marketshare', 'label' => 'Qyt Tri Marketshare','rules' => 'required'],
            ['field' => 'qty_smartfrend_marketshare', 'label' => 'Qyt Smartfrend Marketshare','rules' => 'required'],                                   
        ];
    }

    public function getAll($kode, $start=null, $end=null)
    {
        $this->db->select('*');
        $this->db->from($this->table. ' as sb');
        $this->db->join('tbl_user as u', 'sb.kode_user = u.kode_user');
        if ($start && $end) :
            $this->db->where("sb.tanggal BETWEEN '$start' AND '$end'");
        endif;
        $this->db->where('u.kode_tdc', $kode);
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

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id_market' => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $tanggal = date('Y-m-d', strtotime($post['tanggal']));
        $data = array(
            'tanggal' => $this->tanggal = $tanggal,
            'kabupaten' => $this->kabupaten = $post['kabupaten'],
            'kecamatan' => $this->kecamatan = $post['kecamatan'],
            'qty_telkomsel_marketshare' => $this->qty_telkomsel_marketshare = $post['qty_telkomsel_marketshare'],
            'qty_indosat_marketshare' => $this->qty_indosat_marketshare = $post['qty_indosat_marketshare'],
            'qty_xl_marketshare' => $this->qty_xl_marketshare = $post['qty_xl_marketshare'],
            'qty_tri_marketshare' => $this->qty_tri_marketshare = $post['qty_tri_marketshare'],
            'qty_smartfrend_marketshare' => $this->qty_smartfrend_marketshare = $post['qty_smartfrend_marketshare'],
            'kode_user' => $this->kode_user = $this->session->userdata('id')
        );
        
        $this->db->set($data);
        $this->db->insert($this->table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        $tanggal = date('Y-m-d', strtotime($post['tanggal']));
        $data = array(
            'tanggal' => $this->tanggal = $tanggal,
            'kabupaten' => $this->kabupaten = $post['kabupaten'],
            'kecamatan' => $this->kecamatan = $post['kecamatan'],
            'qty_telkomsel_marketshare' => $this->qty_telkomsel_marketshare = $post['qty_telkomsel_marketshare'],
            'qty_indosat_marketshare' => $this->qty_indosat_marketshare = $post['qty_indosat_marketshare'],
            'qty_xl_marketshare' => $this->qty_xl_marketshare = $post['qty_xl_marketshare'],
            'qty_tri_marketshare' => $this->qty_tri_marketshare = $post['qty_tri_marketshare'],
            'qty_smartfrend_marketshare' => $this->qty_smartfrend_marketshare = $post['qty_smartfrend_marketshare'],
            // 'kode_user' => $this->kode_user = $post['kode_user']
        );
        
        $this->db->set($data);
        $this->db->update($this->table, $this, array('id_market' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id_market' => $id));
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

    public function getDetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS sb');
        $this->db->join('tbl_user AS u', 'sb.kode_user = u.kode_user', 'inner');
        $this->db->where('sb.id_market', $id);
        return $this->db->get()->row();
    }

    public function getGraphMS($kode, $group)
    {
        $sql = $this->db->query("SELECT 
                                kabupaten,
                                kecamatan,
                                ROUND(SUM(qty_telkomsel_marketshare + qty_indosat_marketshare + qty_xl_marketshare + qty_tri_marketshare + qty_smartfrend_marketshare)/
                                (SELECT SUM(qty_telkomsel_marketshare + qty_indosat_marketshare + qty_xl_marketshare + qty_tri_marketshare + qty_smartfrend_marketshare)
                                FROM tbl_market_share_broadband
                                WHERE kode_user = '$kode') * 100, 2) AS 'total_market_share'
                            FROM tbl_market_share_regular
                            WHERE kode_user = '$kode'
                            GROUP BY $group");
        return $sql->result();
    }

    /**
     * method for admin indirect
     */
    public function displayBroadband() 
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS b');
        $this->db->join('tbl_user AS u', 'u.kode_user = b.kode_user', 'inner');
        $this->db->join('tbl_tdc AS t', 't.kode_tdc = u.kode_tdc', 'inner');
        return $this->db->get()->result(); 
    }

}