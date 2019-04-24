<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Historiorder_model extends CI_Model
{
    private $table = 'tbl_histori_order';
    private $tanggal;
    private $kode_marketing;
    private $kode_outlet;
    private $as;
    private $simpati;
    private $loop;
    private $nsb;
    private $mkios_reguler;
    private $mkios_bulk;
    private $gt_pulsa;

    public function rules()
    {
        return [
            ['field' => 'tanggal', 'label' => 'Tanggal','rules' => 'required'],
            ['field' => 'kode_marketing', 'label' => 'Nama Marketing','rules' => 'required'],
            ['field' => 'id_outlet', 'label' => 'Nama Outlet','rules' => 'required'],
            ['field' => 'as', 'label' => 'AS','rules' => 'required'],
            ['field' => 'simpati', 'label' => 'Simpati','rules' => 'required'],
            ['field' => 'loop', 'label' => 'LOOP','rules' => 'required'],
            ['field' => 'nsb', 'label' => 'NSB','rules' => 'required'],
            ['field' => 'mkios_reguler', 'label' => 'MKIOS Reguler','rules' => 'required'],
            ['field' => 'mkios_bulk', 'label' => 'MKIOS Bulk','rules' => 'required'],
            ['field' => 'gt_pulsa', 'label' => 'GT Pulsa','rules' => 'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getHistori($kode, $start=null, $end=null)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS ho');
        $this->db->join('tbl_marketing AS m', 'ho.kode_marketing = m.kode_marketing', 'left');
        $this->db->join('tbl_outlet AS o', 'ho.id_outlet = o.id_outlet', 'left');
        $this->db->join('tbl_user AS u', 'ho.kode_user = u.kode_user', 'left');
        if ($start && $end) :
            $this->db->where("ho.tanggal BETWEEN '$start' AND '$end'");
        endif;
        $this->db->where('u.kode_tdc', $kode);
        return $this->db->get()->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id_histori_order' => $id])->row();
    }

    public function getThisTableRecord($table, $where)
    {   
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where('kode_tdc', $where);
        return $this->db->get()->result(); 
    }

    public function save()
    {
        $post = $this->input->post();
        $tanggal = date('Y-m-d', strtotime($post['tanggal']));
        $data = array(
            'tanggal' => $this->tanggal = $tanggal,
            'kode_marketing' => $this->kode_marketing = $post['kode_marketing'],
            'id_outlet' => $this->id_outlet = $post['id_outlet'],
            'as' => $this->as = $post['as'],
            'simpati' => $this->simpati = $post['simpati'],
            'loop' => $this->loop = $post['loop'],
            'nsb' => $this->nsb = $post['nsb'],
            'mkios_reguler' => $this->mkios_reguler = $post['mkios_reguler'],
            'mkios_bulk' => $this->mkios_bulk = $post['mkios_bulk'],
            'gt_pulsa' => $this->gt_pulsa = $post['gt_pulsa'],
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
            'kode_marketing' => $this->kode_marketing = $post['kode_marketing'],
            'id_outlet' => $this->id_outlet = $post['id_outlet'],
            'as' => $this->as = $post['as'],
            'simpati' => $this->simpati = $post['simpati'],
            'loop' => $this->loop = $post['loop'],
            'nsb' => $this->nsb = $post['nsb'],
            'mkios_reguler' => $this->mkios_reguler = $post['mkios_reguler'],
            'mkios_bulk' => $this->mkios_bulk = $post['mkios_bulk'],
            'gt_pulsa' => $this->gt_pulsa = $post['gt_pulsa'],
            // 'kode_user' => $this->kode_user = $post['kode_user']
        );
        
        $this->db->set($data);
        $this->db->update($this->table, $this, array('id_histori_order' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id_histori_order' => $id));
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
        $this->db->from($this->table . ' AS ho');
        $this->db->join('tbl_marketing AS m', 'ho.kode_marketing = m.kode_marketing', 'left');
        $this->db->join('tbl_outlet AS o', 'ho.id_outlet = o.id_outlet', 'left');
        $this->db->join('tbl_user AS u', 'ho.kode_user = u.kode_user', 'left');
        $this->db->where('ho.id_histori_order', $id);
        return $this->db->get()->row();
    }

    /**
     * Method for Admin Indirect
     */
    public function displayHistoriOrder()
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS ho');
        $this->db->join('tbl_marketing AS m', 'ho.kode_marketing = m.kode_marketing', 'inner');
        $this->db->join('tbl_outlet AS o', 'ho.id_outlet = o.id_outlet', 'inner');
        $this->db->join('tbl_tdc AS u', 'm.kode_tdc = u.kode_tdc', 'inner');
        return $this->db->get()->result();
    }
}