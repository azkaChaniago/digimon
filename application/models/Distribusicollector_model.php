<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Distribusicollector_model extends CI_Model {
    
    private $table = 'tbl_target_assignment_collector';
    private $id_target;
    private $tanggal;
    private $kode_marketing;
    private $new_rs_non_outlet;
    private $nsb;
    private $gt_pulsa;
    private $collecting;
    private $kode_user;

    public function rules()
    {
        return [
            ['field' => 'tanggal', 'label' => 'Tanggal', 'rules' => 'required'],
            ['field' => 'kode_marketing', 'label' => 'Kode Marketing', 'rules' => 'required'],
            ['field' => 'new_rs_non_outlet', 'label' => 'Jumlah Outlet', 'rules' => 'required'],
            ['field' => 'nsb', 'label' => 'NSB', 'rules' => 'required'],
            ['field' => 'gt_pulsa', 'label' => 'GT Pulsa', 'rules' => 'required'],
            ['field' => 'collecting', 'label' => 'MKIOS Reguler', 'rules' => 'required'],
            // ['field' => 'kode_user', 'label' => 'Kode User', 'rules' => 'required']
        ];
    }

    public function getAll($kode)
    {
        // $this->db->select('*');
        // $this->db->from('view_list_distribusi_collector');
        // return $this->db->get()->result();
        return $this->db->query("CALL get_detail_ta_collector('$kode')")->result();
    }

    public function getDistribusi()
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS ta');
        $this->db->join('tbl_marketing AS m', 'ta.kode_marketing = m.kode_marketing', 'left');
        $this->db->join('tbl_user AS u', 'ta.kode_user = u.kode_user', 'left');
       return $this->db->get()->result();
    }

    public function getCollector($kode=null, $start, $end)
    {
        $this->db->select('*');
        $this->db->from('tbl_marketing AS m');
        $this->db->join('tbl_target_assignment_collector ta', 'm.kode_marketing = ta.kode_marketing');
        $this->db->where('m.divisi', 'collector');
        if ($kode=null) :
            $this->db->where('m.kode_tdc', $kode);
        endif;
        $this->db->where('ta.tanggal >=', $start);
        $this->db->where('ta.tanggal <=', $end);
        return $this->db->get()->result();
    }

    public function getHistoriOrder()
    {
        $this->db->select('*');
        $this->db->from('tbl_histori_order');
        $this->db->join('tbl_marketing', 'tbl_marketing.kode_marketing = tbl_histori_order.kode_marketing', 'left');
        $this->db->join('tbl_outlet', 'tbl_outlet.id_outlet = tbl_histori_order.id_outlet', 'left');
        return $this->db->get()->result();
    }

    public function getById($id)
    {   
        // return $this->db->get_where($this->table, ['id_target' => $id])->row();
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('tbl_marketing', 'tbl_marketing.kode_marketing = '.$this->table.'.kode_marketing', 'left');
        $this->db->join('tbl_user', 'tbl_user.kode_user = '.$this->table.'.kode_user', 'left');
        $this->db->where($this->table . '.id_target', $id);
        return $this->db->get()->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $tanggal = date('Y-m-d', strtotime($post['tanggal']));
        $data = array(
            'tanggal' => $this->tanggal = $tanggal,
            'kode_marketing' => $this->kode_marketing = strtoupper($post['kode_marketing']),
            'new_rs_non_outlet' => $this->new_rs_non_outlet = $post['new_rs_non_outlet'],
            'nsb' => $this->nsb = $post['nsb'],
            'gt_pulsa' => $this->gt_pulsa = $post['gt_pulsa'],
            'collecting' => $this->collecting = $post['collecting'],
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
            'kode_marketing' => $this->kode_marketing = strtoupper($post['kode_marketing']),
            'new_rs_non_outlet' => $this->new_rs_non_outlet = $post['new_rs_non_outlet'],
            'nsb' => $this->nsb = $post['nsb'],
            'gt_pulsa' => $this->gt_pulsa = $post['gt_pulsa'],
            'collecting' => $this->collecting = $post['collecting'],
        );
        $this->db->set($data);
        $this->db->update($this->table, $this, array('id_target' => $id));
    }

    public function delete($id)
    {
        // $this->deleteImage($id);
        return $this->db->delete($this->table, array('id_target' => $id));
    }

    public function userList()
    {
        return $this->db->get('tbl_marketing')->result(); 
    }

    public function getThisTableRecord($table, $field = array())
    {
        if (empty($field))
        {
            return $this->db->get($table)->result();
        }
        else 
        {
            $this->db->select('*');
            $this->db->from($table);
            foreach ($field as $fill => $f):
                $this->db->where($fill, $f);
            endforeach;
            return $this->db->get()->result();
        }

    }

    public function getDetail($id)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS ta');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = ta.kode_marketing', 'left');
        $this->db->join('tbl_user AS u', 'u.kode_user = ta.kode_user', 'left');
        $this->db->where('ta.id_target', $id);
        return $this->db->get()->row();
    }

    /**
     * Method for Admin Indirect
     */
    public function displayTargetAssignment()
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS ta');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = ta.kode_marketing', 'inner');
        $this->db->join('tbl_tdc AS u', 'u.kode_tdc = m.kode_tdc', 'inner');
        return $this->db->get()->result();
    }

}