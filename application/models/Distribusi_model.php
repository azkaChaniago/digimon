<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Distribusi_model extends CI_Model {
    
    private $table = 'tbl_target_assignment';
    private $id_target;
    private $tanggal;
    private $kode_marketing;
    private $new_opening_outlet;
    private $outlet_aktif_digital;
    private $outlet_aktif_voucher;
    private $outlet_aktif_bang_tcash;
    private $sales_perdana;
    private $nsb;
    private $mkios_bulk;
    private $gt_pulsa;
    private $mkios_reguler;
    private $kode_user;

    public function rules()
    {
        return [
            ['field' => 'tanggal', 'label' => 'Tanggal', 'rules' => 'required'],
            ['field' => 'kode_marketing', 'label' => 'Kode Marketing', 'rules' => 'required'],
            ['field' => 'new_opening_outlet', 'label' => 'New Opening Outlet', 'rules' => 'required'],
            ['field' => 'outlet_aktif_digital', 'label' => 'Outlet Aktif Digital', 'rules' => 'required'],
            ['field' => 'outlet_aktif_voucher', 'label' => 'Outlet Aktif Voucher', 'rules' => 'required'],
            ['field' => 'outlet_aktif_bang_tcash', 'label' => 'Outlet Aktif Bang Tcash', 'rules' => 'required'],
            ['field' => 'sales_perdana', 'label' => 'Sales Perdana', 'rules' => 'required'],
            ['field' => 'nsb', 'label' => 'NSB', 'rules' => 'required'],
            ['field' => 'mkios_bulk', 'label' => 'MKIOS Bulk', 'rules' => 'required'],
            ['field' => 'gt_pulsa', 'label' => 'GT Pulsa', 'rules' => 'required'],
            ['field' => 'mkios_reguler', 'label' => 'MKIOS Reguler', 'rules' => 'required'],
            // ['field' => 'kode_user', 'label' => 'Kode User', 'rules' => 'required']
        ];
    }

    public function getAll($div, $kode)
    {
        return $this->db->query("CALL get_marketing('$div', '$kode')")->result();
    }

    public function getDistribusi($kode, $start, $end)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS ta');
        $this->db->join('tbl_marketing AS m', 'ta.kode_marketing = m.kode_marketing', 'left');
        $this->db->join('tbl_user AS u', 'ta.kode_user = u.kode_user', 'left');
        $this->db->where('m.divisi', 'canvasser');
        $this->db->where("ta.tanggal BETWEEN '$start' AND '$end'");
        $this->db->where('u.kode_tdc', $kode);
        return $this->db->get()->result();
    }

    public function getCanvasser($kode)
    {
        $this->db->select('*');
        $this->db->from('tbl_marketing AS m');
        $this->db->where('m.divisi', 'canvasser');
        $this->db->where('m.kode_tdc', $kode);
        return $this->db->get()->result();
    }

    public function getCollector($kode)
    {
        $this->db->select('*');
        $this->db->from('tbl_marketing AS m');
        $this->db->where('m.divisi', 'collector');
        $this->db->where('m.kode_tdc', $kode);
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
            'new_opening_outlet' => $this->new_opening_outlet = $post['new_opening_outlet'],
            'outlet_aktif_digital' => $this->outlet_aktif_digital = $post['outlet_aktif_digital'],
            'outlet_aktif_voucher' => $this->outlet_aktif_voucher = $post['outlet_aktif_voucher'],
            'outlet_aktif_bang_tcash' => $this->outlet_aktif_bang_tcash = $post['outlet_aktif_bang_tcash'],
            'sales_perdana' => $this->sales_perdana = $post['sales_perdana'],
            'nsb' => $this->nsb = $post['nsb'],
            'mkios_bulk' => $this->mkios_bulk = $post['mkios_bulk'],
            'gt_pulsa' => $this->gt_pulsa = $post['gt_pulsa'],
            'mkios_reguler' => $this->mkios_reguler = $post['mkios_reguler'],
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
            'new_opening_outlet' => $this->new_opening_outlet = $post['new_opening_outlet'],
            'outlet_aktif_digital' => $this->outlet_aktif_digital = $post['outlet_aktif_digital'],
            'outlet_aktif_voucher' => $this->outlet_aktif_voucher = $post['outlet_aktif_voucher'],
            'outlet_aktif_bang_tcash' => $this->outlet_aktif_bang_tcash = $post['outlet_aktif_bang_tcash'],
            'sales_perdana' => $this->sales_perdana = $post['sales_perdana'],
            'nsb' => $this->nsb = $post['nsb'],
            'mkios_bulk' => $this->mkios_bulk = $post['mkios_bulk'],
            'gt_pulsa' => $this->gt_pulsa = $post['gt_pulsa'],
            'mkios_reguler' => $this->mkios_reguler = $post['mkios_reguler'],
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

    public function getThisTableRecord($table, $conditions = null)
    {
        if (empty($conditions))
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
     * From here the method are for Admin Indirect Pages
     */
    public function displayTargetAssignment($start = null, $end = null)
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS ta');
        $this->db->join('tbl_marketing AS m', 'm.kode_marketing = ta.kode_marketing', 'inner');
        $this->db->join('tbl_tdc AS u', 'u.kode_tdc = m.kode_tdc', 'inner');
        if ($start && $end) :
            $this->db->where("ta.tanggal BETWEEN '$start' AND '$end'");
        endif;
        return $this->db->get()->result();

    }

}