<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri_model extends CI_Model
{
    private $table = 'tbl_galeri';
    private $id;
    private $tanggal;
    private $keterangan;
    private $foto;

    public function rules()
    {
        return [
            ['field' => 'tanggal', 'label' => 'Tanggal','rules' => 'required'],
            ['field' => 'keterangan', 'label' => 'Keterangan','rules' => 'required'],
            // ['field' => 'images[]', 'label' => 'Foto','rules' => 'required'],
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function getThisTableRecord($table, $conditions = null)
    {
        if (!$conditions)
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

    public function save()
    {
        $post = $this->input->post();
        $this->keterangan = strtoupper($post['keterangan']);
        $this->tanggal = date('Y-m-d', strtotime($post['tanggal']));
        $record_length = count($_FILES['images']['name']);
        $data = array();

        for ($i=0; $i < $record_length ; $i++) { 
            array_push($data, array(
                'kode_user' => $this->session->userdata('id'),
                'keterangan' => $this->keterangan,
                'tanggal' => $this->tanggal,
                'foto' =>  $this->uploadMultipleImages()[$i]['file_name'],
                
            ));
        }
        $this->db->insert_batch($this->table, $data);
    }

    public function update($id)
    {
        die($id);
        $post = $this->input->post();
        $data = array(
            'keterangan' => $this->keterangan = strtoupper($post['keterangan']),
            'tanggal' => $this->tanggal = $post['tanggal'],
            'foto' => $this->foto = $this->uploadImage(),
            'kode_user' => $this->kode_user = $this->session->userdata('id')
        );
        
        $this->deleteImage($id);
        $this->db->set($data);
        $this->db->update($this->table, $this, array('id' => $id));
    }

    public function delete($id)
    {
        $this->deleteImage($id);
        return $this->db->delete($this->table, array('id' => $id));
    }

    private function uploadMultipleImages()
    {
        $data_info = array();
        $img_ids = array();
        // $files = $_FILES;
        $count = count($_FILES['images']['name']);
        for ($i = 0; $i < $count; $i++)
        {
            $_FILES['image']['name'] = $_FILES['images']['name'][$i];
            $_FILES['image']['type'] = $_FILES['images']['type'][$i];
            $_FILES['image']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
            $_FILES['image']['error'] = $_FILES['images']['error'][$i];
            $_FILES['image']['size'] = $_FILES['images']['size'][$i];

            $config['upload_path'] = './upload/outlet/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name'] = strtoupper($_POST['keterangan']) . "_" . uniqid();
            $config['overwrite'] = true;
            $config['max_size'] = 5120;

            $this->load->library('upload', $config);            
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image'))
            {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('indirect/outlet/list', $error);
            }
            else
            {
                $file_data = $this->upload->data();
                $upload_data[$i]['images_name'] = $file_data['file_name'];
                
                array_push($img_ids, $file_data);
            }

        }
        return $img_ids;
    }

    private function insertImage($data = array())
    {
        return $this->db->insert_batch('images', $data);
    }
    
    private function removeImage($id) 
    {
        // $this->load->helper('file');
        $ret = $this->db->get_where($this->table, array('id' => $id));
        if ($ret->num_rows() > 0) 
        {
            $res = $ret->row();
            $file_data = json_decode($res->foto);
            // die(print($file_data[0]->file_name));
            for ($i=0; $i < count($file_data); $i++)
            {   
                if (is_file($file_data[$i]->full_path)) 
                {
                    unlink($file_data[$i]->full_path);
                }
            }
        }
    }

    private function uploadImage()
    {
        $config['upload_path'] = './upload/outlet/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = 'outlet_' . uniqid();
        $config['overwrite'] = true;
        $config['max_size'] = 5120;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image'))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('indirect/galeri/list', $error);
            return "default.png";
        } 
        else
        {
            die($this->upload->data('file_name'));
            return $this->upload->data('file_name');
        }        
    }

    private function deleteImage($id)
    {
        $post = $this->getById($id);
        die(var_dump($post));
        if ($post->foto != 'default.png')
        {
            $filename = explode('.', $post->foto)[0];
            return array_map('unlink', glob(FCPATH."upload/galeri/$filename.*"));
        }
    }
}
