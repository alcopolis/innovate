<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Articles_m extends MY_Model {
	
	protected $_table = 'default_inn_articles';
	
	public $_rules = array(
// 			'title' => array(
// 					'field' => 'title',
// 					'label' => 'Title',
// 					'rules' => 'trim|xss_clean|required|max_length[100]'
// 			),
			'teaser' => array(
					'field' => 'teaser',
					'label' => 'Teaser',
					'rules' => 'trim|xss_clean|required|max_length[140]'
			),
			'body' => array(
					'field' => 'body',
					'label' => 'Body',
					'rules' => 'trim|xss_clean|required'
			),
			'keywords' => array(
					'field' => 'keywords',
					'label' => 'Keywords',
					'rules' => 'trim|xss_clean'
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
		$data->category = 0;
		$data->keywords = '';
		$data->teaser = '';
		$data->body = '';
		$data->js = '';
		$data->css = '';
		$data->created_on = '';
		$data->modified_on = '';
		$data->status = 0;
		
		return $data;
	}
	
	
	public function get_articles($fields = NULL, $single = FALSE, $args = NULL){
		if($fields != NULL or $fields != ''){
			$fields_array = explode(',', $fields);
			$selected_fields = '';
			
			foreach($fields_array as $f){
				if($f == 'id' or $f == 'slug'){
					$selected_fields .= 't0.' . trim($f) .' as art_' . trim($f) . ',';
				}else{
					$selected_fields .= 't0.' . trim($f) .',';
				}
			}
			
			$selected_fields .= 't1.id as cat_id, t1.slug as cat_slug, t1.name';
		}else{
			$selected_fields = 't0.id as art_id, t0.title, t0.slug as art_slug, t0.teaser, t0.body, t0.category, t0.keywords, t0.files, t0.js, t0.css, t0.created_on, t0.modified_on, t0.status,
				                t1.id as cat_id, t1.slug as cat_slug, t1.name';
		}
		

		$this->db->select($selected_fields);
		$this->db->from('default_inn_articles t0');
		$this->db->join('default_inn_articles_category t1' ,'t1.id = t0.category');
		if($args != NULL){
			$this->db->where($args);
		}
		
		
		$method = 'result';
		
		if($single){
			$method = 'row';
		}else{
			$method = 'result';
		}
		
		
		return $this->db->get()->$method();
	}
	
	
	public function get_articles_by($where = NULL, $fields = NULL, $single = FALSE){
		
		if(isset($where)){
			$data = array();
			foreach($where as $field=>$val){
				$data['t0.' . $field] = $val;
			}
		}
		
		return $this->get_articles($fields, $single, $data);
	}
	
	
	public function get_recent(){
		$data = new stdClass();
		
		$fields = 't0.id, t0.title, t0.slug as art_slug, t0.teaser, t0.body, t0.category, t0.keywords, t0.files, t0.js, t0.css, t0.created_on, t0.modified_on, t0.status,
				   t1.id, t1.slug as cat_slug, t1.name';
		$this->db->select($fields);
		$this->db->from('default_inn_articles t0');
		$this->db->join('default_inn_articles_category t1' ,'t1.id = t0.category');
		$this->db->where('status', 1);
			
		return $this->db->get()->result();
	}
	
	public function count_articles_by_category($slug){
		$temp = $this->db->select('id')->where('slug', $slug)->get('default_inn_articles_category')->row();
		
		$this->db->where('category',$temp->id);
		return $this->db->from($this->_table)->count_all_results();
	}
	
	//CRUD
	public function insert_art($data){
		if($this->db->insert($this->_table, $data)){
			return $this->db->insert_id();
		}else{
			return FALSE;
		}
	}
	
}