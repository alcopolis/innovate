<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Articles_m extends MY_Model {
	
	protected $_table = 'inn_articles';
	
	public $rules = array(
			'title' => array(
					'field' => 'title',
					'label' => 'Title',
					'rules' => 'trim|xss_clean|required|max_length[100]'
			),
			'intro' => array(
					'field' => 'intro',
					'label' => 'Intro',
					'rules' => 'trim|xss_clean|required|max_length[200]'
			),
			'body' => array(
					'field' => 'body',
					'label' => 'Body',
					'rules' => 'trim|xss_clean|required'
			),
			'keywords' => array(
					'field' => 'keywords',
					'label' => 'Tags',
					'rules' => 'trim|xss_clean|max_length[20]'
			),
	);
	
	
	
	
//=================== General Function ====================//
	
	public function __construct()
	{		
		parent::__construct();
	}
	
	
	public function add_new(){
		$data = new stdClass();
		
		$data->title = '';
		$data->body = '';
		$data->created_on = '';
		$data->modified_on = '';
		
		return $data;
	}
	
	
	public function get_articles($fields = '', $single = FALSE){
		
	}
	
	public function get_articles_by($where = NULL, $fields, $single){
		$this->get_articles($fields, $single);
	}
}