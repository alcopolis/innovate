<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Quiz_Question_m extends MY_Model {
	
	public $_rules = array(
				'question_admin' => array(
						'field' => 'question',
						'label' => 'Question',
						'rules' => 'required|xss_clean'
				),
				'answer_admin' => array(
						'field' => 'answer',
						'label' => 'Answer',
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
		$this->_table = 'inn_quiz_question';
		$this->load->model('quiz_m');
	}
	
	
	public function add_new(){
	
		$ques = new stdClass();
	
		$ques->id = NULL;
		$ques->question_admin = '';
		$ques->answer_admin = '';
	
		return $ques;
	}
	
	public function get_question($fields=NULL, $single=FALSE){
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
	
	public function get_question_by($where=NULL, $fields=NULL, $single=FALSE){
		if(isset($where)){
			if(isset($where)){
				$this->db->where($where);
			}
			
			return $this->get_category($fields, $single);
		}else{
			return FALSE;
		}
	}
	
	
	//CRUD
	public function insert_question($data){
		if($this->db->insert($this->_table, $data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function update_question(){}
	
	public function delete_question($slug){	
	}	
}