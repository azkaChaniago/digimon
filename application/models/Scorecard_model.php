<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Scorecard_model extends CI_Model
{
    private $table = 'tbl_score_card';
    private $tanggal;
    private $kode_marketing;
    private $new_opening_outlet;
    private $outlet_aktif_digital;
    private $outlet_aktif_voucher;
    private $outlet_aktif_bang_tcash;
    private $sales_perdana;
    private $nsb;
    private $mkios_reguler;
    private $mkios_bulk;
    private $gt_pulsa;
    private $kode_user;

    public function rules()
    {
        return [
            ['field' => 'tanggal', 'label' => 'Tanggal','rules' => 'required'],
            ['field' => 'kode_marketing', 'label' => 'Nama Marketing','rules' => 'required'],
            ['field' => 'new_opening_outlet', 'label' => 'New Outlet','rules' => 'required'],
            ['field' => 'outlet_aktif_digital', 'label' => 'Outlet Aktif Digital','rules' => 'required'],
            ['field' => 'outlet_aktif_voucher', 'label' => 'Outlet Aktif Voucher','rules' => 'required'],
            ['field' => 'outlet_aktif_bang_tcash', 'label' => 'Outlet Aktif Bang TCash','rules' => 'required'],
            ['field' => 'sales_perdana', 'label' => 'Sales Perdana','rules' => 'required'],
            ['field' => 'nsb', 'label' => 'NSB','rules' => 'required'],
            ['field' => 'mkios_reguler', 'label' => 'MKIOS Reguler','rules' => 'required'],
            ['field' => 'mkios_bulk', 'label' => 'MKIOS Bulk','rules' => 'required'],
            ['field' => 'gt_pulsa', 'label' => 'GT Pulsa','rules' => 'required']
        ];
    }

    public function getAll($kode, $start = null, $end = null)
    {
        $this->db->select('*');
        $this->db->from('view_list_score_card');
        if ($start && $end) :
            $this->db->where("tanggal BETWEEN '$start' AND '$end'");
        endif;    
        $this->db->where('kode_tdc', $kode);
        return $this->db->get()->result();
    }

    public function getScorecard($kode)
    {
        $this->db->select('*');
        $this->db->from('tbl_marketing AS m');
        // $this->db->join('tbl_marketing AS m', 'm.kode_marketing = t.kode_marketing', 'left');
        $this->db->join('tbl_user AS u', 'u.kode_tdc = m.kode_tdc', 'left');
        $this->db->where('m.divisi', 'canvasser');
        $this->db->where('u.kode_tdc', $kode);
        return $this->db->get()->result();
    }

    public function getCanvasser()
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS t');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = t.kode_marketing', 'left');
        $this->db->where('m.divisi', 'canvasser');
        return $this->db->get()->result();
    }

    public function getCollector()
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS t');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = t.kode_marketing', 'left');
        $this->db->where('m.divisi', 'collector');
        return $this->db->get()->result();
    }

    public function getDetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS sc');
        $this->db->join('tbl_marketing AS m', 'sc.kode_marketing = m.kode_marketing', 'left');
        $this->db->join('tbl_user AS u', 'sc.kode_user = u.kode_user', 'left');
        $this->db->where('sc.id_score_card', $id);
        return $this->db->get()->row();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id_score_card' => $id])->row();
    }

    public function getThisTableRecord($table)
    {
        return $this->db->get($table)->result();
    }

    public function getIndirectMarketing()
    {
        $this->db->select('*');
        $this->db->from('tbl_marketing');
        $this->db->where('divisi', 'canvasser');
        $this->db->or_where('divisi', 'collector');
        return $this->db->get()->result();
    }

    public function save()
    {
        $post = $this->input->post();
        $tanggal = date('Y-m-d', strtotime($post['tanggal']));
        $data = array(
            'tanggal' => $this->tanggal = $tanggal,
            'kode_marketing' => $this->kode_marketing = $post['kode_marketing'],
            'new_opening_outlet' => $this->new_opening_outlet = $post['new_opening_outlet'],
            'outlet_aktif_digital' => $this->outlet_aktif_digital = $post['outlet_aktif_digital'],
            'outlet_aktif_voucher' => $this->outlet_aktif_voucher = $post['outlet_aktif_voucher'],
            'outlet_aktif_bang_tcash' => $this->outlet_aktif_bang_tcash = $post['outlet_aktif_bang_tcash'],
            'sales_perdana' => $this->sales_perdana = $post['sales_perdana'],'nsb' => $this->nsb = $post['nsb'],
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
            'new_opening_outlet' => $this->new_opening_outlet = $post['new_opening_outlet'],
            'outlet_aktif_digital' => $this->outlet_aktif_digital = $post['outlet_aktif_digital'],
            'outlet_aktif_voucher' => $this->outlet_aktif_voucher = $post['outlet_aktif_voucher'],
            'outlet_aktif_bang_tcash' => $this->outlet_aktif_bang_tcash = $post['outlet_aktif_bang_tcash'],
            'sales_perdana' => $this->sales_perdana = $post['sales_perdana'],
            'nsb' => $this->nsb = $post['nsb'],
            'mkios_reguler' => $this->mkios_reguler = $post['mkios_reguler'],
            'mkios_bulk' => $this->mkios_bulk = $post['mkios_bulk'],
            'gt_pulsa' => $this->gt_pulsa = $post['gt_pulsa'],
            // 'kode_user' => $this->kode_user = $post['kode_user']
        );
        
        $this->db->set($data);
        $this->db->update($this->table, $this, array('id_score_card' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id_score_card' => $id));
    }

    public function userList()
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS t');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = t.kode_marketing', 'left');
        $this->db->join('tbl_user AS o', 'o.kode_user = t.kode_user', 'left');
        // $this->db->where('m.kode_marketing', 'o.kode_marketing');
        return $this->db->get()->result(); 
    }

    /**
     * From here the method are for Admin Indirect Pages
     */
    public function displayTargetAssignment()
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS sc');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = sc.kode_marketing', 'inner');
        $this->db->join('tbl_tdc AS u', 'u.kode_tdc = m.kode_tdc', 'inner');
        return $this->db->get()->result();
    }

}