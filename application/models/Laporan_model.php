<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    private $table = 'tbl_histori_order';

    public function getpivot($tdc)
    {
        $post = $this->input->post();
        $start = date('Y-m-d', strtotime($post['start']));
        $end = date('Y-m-d', strtotime($post['end']));

        $sql = $this->db->query("CALL get_histori_pivot('" . $start . "','". $end . "', '" . $tdc . "')");
        if ($sql->num_rows() > 0)
        {
            return $sql->result_array();
        }
        else
        {
            print_r ($sql);
            return $this->session->set_flashdata('error', "Tidak ada histori order pada tdc ini");
        }
    }

}