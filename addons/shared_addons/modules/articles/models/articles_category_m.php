<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Articles_Category_m extends MY_Model {
	
	protected $_table = 'default_inn_articles_category';
	
	public $_rules = array(
			'name' => array(
					'field' => 'title',
					'label' => 'Title',
					'rules' => 'trim|xss_clean|required|is_unique[default_inn_articles_category.name]|max_length[100]'
			)
	);
	
	
	
	
//=================== General Function ====================//
	
	public function __construct()
	{		
		parent::__construct();
	}
	
	
// 	public function add_new(){
// 		$data = new stdClass();
		
// 		$data->title = '';
// 		$data->teaser = '';
// 		$data->body = '';
// 		$data->created_on = '';
// 		$data->modified_on = '';
		
// 		return $data;
// 	}
	
	
	public function get_category($fields = NULL, $single = FALSE){
		if(isset($fields)){
			$this->db->select($fields);
		}
		
		$method = 'result';
		if($single){
			$method = 'row';
		}else{
			$method = 'result';
		}
		
		return $this->db->get($this->_table)->$method();
	}
	
	
	public function get_category_by($where = NULL, $fields = NULL, $single = FALSE){
		
		if(isset($where)){
			$this->db->where($where);
		}
				
		return $this->get_category($fields, $single);
	}
	
	
	
	
	//CRUD
	public function insert_cat($data){
		if($this->db->insert($this->_table, $data)){
			return $this->db->insert_id();
		}else{
			return FALSE;
		}
	}
	
}