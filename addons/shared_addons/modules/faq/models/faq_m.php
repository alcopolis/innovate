<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Faq_m extends MY_Model {
	
	public $_rules = array(
				'title' => array(
						'field' => 'title',
						'label' => 'Title',
						'rules' => 'required|trim|xss_clean'
				),
				'category' => array(
						'field' => 'category',
						'label' => 'Category',
						'rules' => 'xss_clean'
				),
				'question' => array(
						'field' => 'question',
						'label' => 'Question',
						'rules' => 'required|xss_clean'
				),
				'answer' => array(
						'field' => 'answer',
						'label' => 'Answer',
						'rules' => 'required|trim|xss_clean'
				),
			);
	
	public function __construct()
	{		
		parent::__construct();
		
		/**
		 * If the sample module's table was named "samples"
		 * then MY_Model would find it automatically. Since
		 * I named it "sample" then we just set the name here.
		 */
		$this->_table = 'inn_faq';
	}
	
	public function add_new($slug){
		$this->load->model('faq_cat_m');
		
		$c = $this->faq_cat_m->get_category_by(array('slug' => $slug),NULL,TRUE);
		
		$faq = new stdClass();
		
		$faq->id = NULL;
		$faq->category = $c->id;
		$faq->slug = '';
		$faq->title = '';
		$faq->question = '';
		$faq->answer = '';
		$faq->attachment = '';
	
		return $faq;
	}
	
	public function get_faq($fields=NULL, $single=FALSE){
		if(isset($fields)){
			$this->db->select($fields);
		}
		
		if($single){
			$method = 'row';
		}else{
			$method = 'result';
		}
		
		return $this->db->get($this->_table)->$method();
	}
	
	public function get_faq_by($where=NULL, $fields=NULL, $single=NULL){
		if(isset($where)){
			if(isset($where)){
				$this->db->where($where);
			}
			
			return $this->get_faq($fields, $single);
		}else{
			return FALSE;
		}
	}
	
	
	//CRUD
	public function insert_faq($data){
		if($this->db->insert($this->_table, $data)){
			return $this->db->insert_id();
		}else{
			return FALSE;
		}
	}
	
	public function update_faq($id, $data){
		$this->db->where('id', $id);
		if($this->db->update($this->_table, $data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function delete_faq(){}	
}