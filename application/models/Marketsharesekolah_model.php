<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Marketsharesekolah_model extends CI_Model
{
    private $table = 'tbl_marketshare';
    private $id_market;
    private $npsn;
    private $kode_tdc;
    private $tgl_marketshare;
    private $qty_simpati;
    private $qty_as;
    private $qty_loop;
    private $qty_mentari;
    private $qty_im3;
    private $qty_xl;
    private $tri;
    private $qty_axsis;
    private $qty_smartfrend;
    private $kode_user;

    public function rules()
    {
        return [
            ['field' => 'npsn', 'label' => 'NPSN','rules' => 'required'],
            ['field' => 'tgl_marketshare', 'label' => 'Tanggal Marketshare','rules' => 'required'],
            ['field' => 'qty_simpati', 'label' => 'QTY Simpati','rules' => 'required'],
            ['field' => 'qty_as', 'label' => 'QTY AS','rules' => 'required'],           
            ['field' => 'qty_loop', 'label' => 'QTY Loop','rules' => 'required'],
            ['field' => 'qty_mentari', 'label' => 'QTY Mentari','rules' => 'required'],
            ['field' => 'qty_im3', 'label' => 'QTY IM3','rules' => 'required'],
            ['field' => 'qty_xl', 'label' => 'QTY XL','rules' => 'required'],
            ['field' => 'qty_tri', 'label' => 'QTY Tri','rules' => 'required'],
            ['field' => 'qty_axsis', 'label' => 'QTY AXSIS','rules' => 'required'],
            ['field' => 'qty_smartfrend', 'label' => 'QTY Smartfrend','rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id_market' => $id])->row();
    }

    public function getThisTableRecord($table)
    {
        return $this->db->get($table)->result();
    }

    public function getRelated($tdc=null, $start=null, $end=null)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS ms');
        $this->db->join('tbl_tdc AS tdc', 'tdc.kode_tdc = ms.kode_tdc', 'left');
        $this->db->join('tbl_sekolah AS s', 's.npsn = ms.npsn', 'left');
        $this->db->join('tbl_user AS usr', 'usr.kode_user = ms.kode_user', 'left');
        if ($start && $end) :
            $this->db->where("ms.tgl_marketshare BETWEEN '$start' AND '$end'");
        endif;
        if ($tdc)
            $this->db->where('ms.kode_tdc', $tdc);
        return $this->db->get()->result();
    }

    public function getDetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS ms');
        $this->db->join('tbl_tdc AS t', 't.kode_tdc = ms.kode_tdc', 'left');
        $this->db->join('tbl_sekolah AS s', 's.npsn = ms.npsn', 'left');
        $this->db->join('tbl_user AS u', 'u.kode_user = ms.kode_user', 'left');
        $this->db->where('ms.id_market', $id);
        return $this->db->get()->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $data = array(
            'npsn' => $this->npsn = $post['npsn'],
            'kode_tdc' => $this->kode_tdc = $post['kode_tdc'],
            'tgl_marketshare' => $this->tgl_marketshare = date('Y-m-d', strtotime($post['tgl_marketshare'])),
            'qty_simpati' => $this->qty_simpati = str_replace('.','',$post['qty_simpati']),
            'qty_as' => $this->qty_as = str_replace('.','',$post['qty_as']),
            'qty_loop' => $this->qty_loop = str_replace('.','',$post['qty_loop']),
            'qty_mentari' => $this->qty_mentari = str_replace('.','',$post['qty_mentari']),
            'qty_im3' => $this->qty_im3 = str_replace('.','',$post['qty_im3']),
            'qty_xl' => $this->qty_xl = str_replace('.','',$post['qty_xl']),
            'qty_tri' => $this->qty_tri = str_replace('.','',$post['qty_tri']),
            'qty_axsis' => $this->qty_axsis = str_replace('.','',$post['qty_axsis']),
            'qty_smartfrend' => $this->qty_smartfrend = str_replace('.','',$post['qty_smartfrend']),
            'kode_user' => $this->kode_user = $this->session->userdata['id'],
        );
        
        $this->db->set($data);
        $this->db->insert($this->table, $this);
    }

    public function update($id)
    {
        $post = $this->input->post();
        $data = array(
            'npsn' => $this->npsn = $post['npsn'],
            'tgl_marketshare' => $this->tgl_marketshare = date('Y-m-d', strtotime($post['tgl_marketshare'])),
            'qty_simpati' => $this->qty_simpati = str_replace('.','',$post['qty_simpati']),
            'qty_as' => $this->qty_as = str_replace('.','',$post['qty_as']),
            'qty_loop' => $this->qty_loop = str_replace('.','',$post['qty_loop']),
            'qty_mentari' => $this->qty_mentari = str_replace('.','',$post['qty_mentari']),
            'qty_im3' => $this->qty_im3 = str_replace('.','',$post['qty_im3']),
            'qty_xl' => $this->qty_xl = str_replace('.','',$post['qty_xl']),
            'qty_tri' => $this->qty_tri = str_replace('.','',$post['qty_tri']),
            'qty_axsis' => $this->qty_axsis = str_replace('.','',$post['qty_axsis']),
            'qty_smartfrend' => $this->qty_smartfrend = str_replace('.','',$post['qty_smartfrend']),
        );
        
        $this->db->set($data);
        $this->db->update($this->table, $this, array('id_market' => $id));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id_market' => $id));
    }

}