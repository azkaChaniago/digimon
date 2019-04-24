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

    public function index($kab=null)
    {
        is_logged_in();
        $data = $this->userSession();
        $data += [
            'regular' => $this->sharereguler_model->chartMarketshare(),
            'kabupaten' => $this->sharereguler_model->chartMarketshareKab()
        ];
        if ($kab)
        {
            $kab = str_replace('%20', ' ', $kab);
            $data['kecamatan'] = $this->sharereguler_model->listGraphKecamaatan($kab);
            $data['kab'] = str_replace(' ', '%20', $kab);
        }
        $this->load->view('adminindirect/marketsharecharts/main', $data);
    }
    
    public function getKecamatan($kab)
    {
        $data = $this->userSession();
        $kab = str_replace('%20', ' ', $kab);
        $data['kecamatan'] = $this->sharereguler_model->getGraphMSKecamatan($data['id'], $kab);
        $data['kab'] = str_replace(' ', '%20', $kab);
        
        if ($data['kecamatan'])
        {
            $this->load->view('adminindirect/marketsharecharts/submain', $data);    
            // exit();
        }
        else 
        {
            // $this->session->set_flashdata('error', $this->db->_error_message());
            redirect(site_url('adminindirect/marketchart'));
        }
    }

    public function listKecamatan($kab)
    {
        $data = $this->userSession();
        $kab = str_replace('%20', ' ', $kab);
        $data['kecamatan'] = $this->sharereguler_model->listGraphKecamaatan($kab);
        $data['kab'] = str_replace(' ', '%20', $kab);
        
        if ($data['kecamatan'])
        {
            $this->load->view('adminindirect/marketsharecharts/main', $data);    
            // exit();
        }
        else 
        {
            // $this->session->set_flashdata('error', $this->db->_error_message());
            redirect(site_url('adminindirect/marketchart'));
        }
    }
}