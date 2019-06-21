<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    private $table = 'tbl_marketing';
    private $kode_marketing;
    private $kode_tdc;
    private $divisi;
    private $nama_marketing;
    private $mkios;
    private $no_hp;
    private $alamat;
    private $email;
    private $nama;
    private $awal;
    private $akhir;

    public function rules()
    {
        return [
            ['field' => 'kode_marketing', 'label' => 'Kode Marketing','rules' => 'required'],
            ['field' => 'kode_tdc', 'label' => 'Kode TDC','rules' => 'required'],
            ['field' => 'divisi', 'label' => 'Divisi','rules' => 'required'],
            ['field' => 'nama_marketing', 'label' => 'Kode Marketing','rules' => 'required'],
            ['field' => 'mkios', 'label' => 'MKIOS','rules' => 'required'],
            ['field' => 'no_hp', 'label' => 'No HP','rules' => 'required'],
            ['field' => 'alamat', 'label' => 'Alamat','rules' => 'required'],
            ['field' => 'email', 'label' => 'Email','rules' => 'required'],
            // ['field' => 'divisi', 'label' => 'Divisi','rules' => 'required'],
            // ['field' => 'limit', 'label' => 'Limit','rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['kode_marketing' => $id])->row();
    }

    public function getThisTableRecord($table, $condition = null)
    {   
        if (!$condition)
        {
            return $this->db->get($table)->result();
        }
        else
        {
            $this->db->select('*');
            $this->db->from($table);
            foreach($condition as $con => $c)
            {
                $this->db->where("$con", "$c");
            }
            $res = $this->db->get();
            // if ($res->num_rows() > 1)
            // {
            //     return $res->result();
            // }
            // else
            // {   
            //     return $res->row();
            // }
            return $res->result();

        }
    }

    public function getRelated()
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS m');
        $this->db->join('tbl_target_assignment AS ta', 'm.kode_marketing = ta.kode_marketing', 'inner');
        return $this->db->get()->result();
    }

    public function getIndirectPerformance()
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS m');
        $this->db->join('tbl_target_assignment AS ta', 'm.kode_marketing = ta.kode_marketing', 'inner');
        $this->db->where("m.divisi = 'canvasser'");
        $this->db->or_where("m.divisi = 'collector'");
        // $this->db->query("CALL performance($name, $month)");
        return $this->db->get()->result();
    }

    public function getDirectPerformance()
    {
        $this->db->select('*');
        $this->db->from($this->table . ' AS m');
        $this->db->join('tbl_target_assignment AS ta', 'm.kode_marketing = ta.kode_marketing', 'inner');
        $this->db->where("m.divisi = 'direct'");
        return $this->db->get()->result();
    }

    public function compare()
    {
        $post = $this->input->post();
        $data['div'] = $post['divisi'];
        $data['lim'] = $post['limit'];
        
        // $this->db->set($div, $lim);
        $compare = "CALL compare('" . $data['div'] ."', " .$data['lim'].")";
        return  $this->db->query($compare)->result();
    }

    public function performanceCanvasser($nama, $bulan)
    {
        // $bulan = date('F');
        
        $sql = $this->db->query("CALL performance('".$nama."', '".$bulan."')");
        if ($sql->num_rows() > 0)
        {
            $res = $sql->row();
            mysqli_next_result($this->db->conn_id);
            return $res;
        }
        else
        {
            return $this->session->set_flashdata('error', $this->db->error());
        }
    }

    public function performanceCollector($nama, $bulan)
    {
        $sql = $this->db->query("CALL performance_collector('".$nama."', '".$bulan."')");
        if ($sql->num_rows() > 0)
        {
            $res = $sql->row();
            mysqli_next_result($this->db->conn_id);
            return $res;
        }
        else
        {
            return $this->session->set_flashdata('error', $this->db->error());
        }
    }

    public function getCanvasserKPI($awal, $akhir, $tdc, $div) 
    {   
        $sql = $this->db->query("CALL kpi_petugas('$awal', '$akhir', '$tdc', '$div')");
        $res = $sql->result();
        mysqli_next_result($this->db->conn_id);

        return $res;
    }

    public function getCollectorKPI($awal, $akhir, $tdc, $div) 
    {   
        $sql = $this->db->query("CALL kpi_collector('$awal', '$akhir', '$tdc','$div')");
        $res = $sql->result();
        mysqli_next_result($this->db->conn_id);

        return $res;
    }

    /**
     * From this Line
     * Function for admin indirect
     * only display charts and unedited tables
     */
    public function getAllCanvasserKPI($awal, $akhir) {
        $sql = $this->db->query("CALL get_all_canvasser_kpi('$awal', '$akhir')");
        $res = $sql->result();
        mysqli_next_result($this->db->conn_id);

        return $res;
    }

    public function getKPIProgress($awal, $akhir, $kode) {
        $sql = $this->db->query("CALL get_canvasser_progress_kpi('$awal', '$akhir', '$kode')");
        $res = $sql->result();
        mysqli_next_result($this->db->conn_id);

        return $res;
    }

    public function getAllCollectorKPI($awal, $akhir) {
        $sql = $this->db->query("CALL get_all_collector_kpi('$awal', '$akhir')");
        $res = $sql->result();
        mysqli_next_result($this->db->conn_id);

        return $res;
    }

    public function getTargetAssignment($kode, $tanggal)
    {
        $query = "SELECT 
                    tanggal,
                    nama_marketing,
                    new_opening_outlet,
                    outlet_aktif_digital,
                    outlet_aktif_voucher,
                    outlet_aktif_bang_tcash, 
                    sales_perdana,
                    nsb,
                    mkios_bulk,
                    gt_pulsa,
                    mkios_reguler
                FROM tbl_target_assignment ta 
                INNER JOIN tbl_marketing m ON ta.kode_marketing = m.kode_marketing
                WHERE m.kode_marketing = '" . $kode . "' AND year(tanggal) = " . date('Y', strtotime($tanggal)) . " GROUP BY monthname(tanggal)
                ORDER BY tanggal ASC";
        
        return json_encode($this->db->query($query)->result());
    }

    public function getScoreCard($kode, $tanggal)
    {
        $query = "SELECT 
                    tanggal,
                    nama_marketing,
                    sum(new_opening_outlet) new_opening_outlet,
                    sum(outlet_aktif_digital) outlet_aktif_digital,
                    sum(outlet_aktif_voucher) outlet_aktif_voucher,
                    sum(outlet_aktif_bang_tcash) outlet_aktif_bang_tcash, 
                    sum(sales_perdana) sales_perdana,
                    sum(nsb) nsb,
                    sum(mkios_bulk) mkios_bulk,
                    sum(gt_pulsa) gt_pulsa,
                    sum(mkios_reguler) mkios_reguler
                FROM tbl_score_card ta 
                INNER JOIN tbl_marketing m ON ta.kode_marketing = m.kode_marketing
                WHERE m.kode_marketing = '" . $kode . "' AND year(tanggal) = " . date('Y', strtotime($tanggal)) . " GROUP BY monthname(tanggal)
                ORDER BY tanggal ASC";
        
        return json_encode($this->db->query($query)->result());
    }

}


