<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Quiz_m extends MY_Model {
	
	public $_rules = array(
				'name' => array(
						'field' => 'name',
						'label' => 'Name',
						'rules' => 'required|trim|xss_clean'
				),
				'start_date' => array(
						'field' => 'start_date',
						'label' => 'Start Date',
						'rules' => 'required|xss_clean'
				),
				'end_date' => array(
						'field' => 'end_date',
						'label' => 'End Date',
						'rules' => 'required|xss_clean'
				),
				'description' => array(
						'field' => 'description',
						'label' => 'Description',
						'rules' => 'required|xss_clean'
				),
				'theme' => array(
						'field' => 'theme',
						'label' => 'Theme',
						'rules' => 'required|xss_clean'
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
		$this->_table = 'inn_quiz';
	}
	
	public function add_new($slug){
		$this->load->model('faq_cat_m');
		
		$c = $this->faq_cat_m->get_category_by(array('slug' => $slug),NULL,TRUE);
		
		$quiz = new stdClass();
		
		$quiz->id = NULL;
		$quiz->category = $c->id;
		$quiz->slug = '';
		$quiz->title = '';
		$quiz->question = '';
		$quiz->answer = '';
		$quiz->attachment = '';
	
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
	
	public function add_count($id){
		$this->db->select('count');
		$this->db->where('id',$id);
		$counter = $this->get_faq_by(array('id'=>$id), 'count', TRUE);
		
		$newcount = intval($counter->count) + 1;
		$data = array('count' => $newcount);
		$this->update_faq($id, $data);
	}
	
	
	//CRUD
	public function insert_quiz($data){
		if($this->db->insert($this->_table, $data)){
			return $this->db->insert_id();
		}else{
			return FALSE;
		}
	}
	
	public function update_quiz($id, $data){
		$this->db->where('id_quiz', $id);
		if($this->db->update($this->_table, $data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function delete_quiz(){}	
}