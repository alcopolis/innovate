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
				'slug' => array(
						'field' => 'slug',
						'label' => 'Slug',
						'rules' => 'required|xss_clean'
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
				'toc' => array(
						'field' => 'toc',
						'label' => 'Terms Condition',
						'rules' => 'xss_clean'
				),
				'theme' => array(
						'field' => 'theme',
						'label' => 'Theme',
						'rules' => 'xss_clean'
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
		$this->_table = 'default_inn_quiz';
	}
	
	public function add_new(){
		
		$quiz = new stdClass();
		
//		$quiz->id = NULL;
		$quiz->name = '';
		$quiz->slug = '';
		$quiz->start_date ='';
		$quiz->end_date = '';
		$quiz->description = '';
		$quiz->toc = '';
		$quiz->theme = '';
		$quiz->css = '';

		return $quiz;
	}
	
	public function get_quiz($fields=NULL, $single=FALSE){
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
	
	
	public function get_quiz_by($where, $fields, $single){
		if(isset($where)){
			$this->db->where($where);
		}
			
		return $this->get_quiz($fields, $single);
	}
	
	public function get_winner($id = NULL){
		$this->db->select('a.username, a.email, b.point');
		$this->db->from('default_users a');
		$this->db->join('default_inn_quiz_user_activity b', 'a.id = b.user_id');
		$this->db->join('default_inn_quiz c', 'c.id = b.quiz_id');
		$this->db->where('c.id',$id);
		//$this->db->limit('5');
		
		return $this->db->get()->result();
	}
}