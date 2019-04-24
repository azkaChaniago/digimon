<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require('./phpspreadsheet/vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Helper\Example;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Marketchart extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sharereguler_model');
        $this->load->model('sharebroadband_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('pdf_helper');
    }

    public function userSession()
    {   
        $data = array(
            'status' => $this->session->userdata('login'),
            'access' => $this->session->userdata('access'),
            'id' => $this->session->userdata('id'),
            'user' => $this->session->userdata('user'),
            'tdc' => $this->session->userdata('tdc')
        );

        return $data;
    }

    public function index()
    {
        is_logged_in();
        $data = $this->userSession();
        $data += [
            'sharereguler' => $this->sharereguler_model->getAll('tbl_reg_marketshare',$data['tdc']),
            'reguler_view' => $this->sharereguler_model->selectView('view_marketshare_reguler', $data['tdc']),
            'regular' => $this->sharereguler_model->getGraphMS($data['id'], 'kabupaten'),
            'cluster' => $this->sharereguler_model->getCluster($data['id'])
        ];
        $this->load->view('indirect/marketsharecharts/main', $data);
    }
    
    public function getKecamatan($kab)
    {
        $data = $this->userSession();
        $kab = str_replace('%20', ' ', $kab);
        $data['kecamatan'] = $this->sharereguler_model->getGraphMSKecamatan($data['id'], $kab);
        $data['kab'] = str_replace(' ', '%20', $kab);
        
        if ($data['kecamatan'])
        {
            $this->load->view('indirect/marketsharecharts/submain', $data);    
            // exit();
        }
        else 
        {
            // $this->session->set_flashdata('error', $this->db->_error_message());
            redirect(site_url('indirect/marketchart'));
        }
    }
}