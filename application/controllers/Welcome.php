<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('posts_model');
		$this->load->model('comments_model');
		$this->load->library('form_validation');
	}
	
	public function index()
	{
		$data['posts'] = $this->posts_model->displayPost();
		$this->load->view('all_posts', $data);
	}

	public function about()
	{
		$this->load->view('about');
	}

	public function contact()
	{
		$this->load->view('contact');
	}

	public function detailPost($id=null)
	{
		$data['detail'] = $this->posts_model->detailPost($id);
		$data['comment__'] = $this->showTree($id);
		$this->load->view('detail_post', $data);
	}

	public function addComment($id=null)
	{
		$comments = $this->comments_model;
        $validation = $this->form_validation;
		$validation->set_rules($comments->rules());
		
		if ($validation->run())
		{
			$comments->save();
            $this->session->set_flashdata('success', 'Successfully saved');
		}

		$data['posts'] = $this->posts_model->getById($id);
		$this->load->view("detailPost/$id", $data);
	}

	// Nested Comment Enabled
	public function showTree($id_post=null)
	{
		$store_id = array();
		$id_result = $this->comments_model->treeAll($id_post);
		foreach ($id_result as $com)
		{
			array_push($store_id, $com->id_comment);
		}

		#return $store_id;
		return $this->inParent(0, $id_post, $store_id);
	}

	public function inParent($parent_id, $id_post, $ids)
	{
		$html = "";
		if (in_array($parent_id, $ids))
		{
			$result = $this->comments_model->treeByParent($id_post, $parent_id);
			$html .= $parent_id == null ? "<ul class='tree'>" : "<ul>";
			foreach ($result as $res)
			{
				$html .= " <li class='comment_box'>
				<div class='aut'>".$res->user_name."</div>
				<div class='timestamp'>".date("F j, Y", strtotime($res->published))."</div>
				<div class='comment-body'>".$res->comment."</div>
				<a href='#".$res->id_comment."' class='reply' id='" . $res->id_comment . "'> reply </a>";
				$html .= $this->inParent($res->id_comment, $id_post, $ids);
				$html .= "</li>";
			}
			$html .= "</ul>";
		}
		else
		{	
			$result = $this->comments_model->treeByParent($id_post, $parent_id);
			$html .= $parent_id == null ? "<ul class='tree'>" : "<ul>";
			foreach ($result as $res)
			{
				$html .= " <li class='comment_box'>
				<div class='aut'>".$res->user_name."</div>
				<div class='timestamp'>".date("F j, Y", strtotime($res->published))."</div>
				<div class='comment-body'>".$res->comment."</div>
				<a  href='#".$res->id_comment."' class='reply' id='" . $res->id_comment . "'> reply </a>";
				$html .= $this->inParent($res->id_comment, $id_post, $ids);
				$html .= "</li><hr>";
			}
			$html .= "</ul>";
		}

		return $html;
	}
}
