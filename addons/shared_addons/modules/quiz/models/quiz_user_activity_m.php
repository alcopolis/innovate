<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
 
class Quiz_User_Activity_m extends MY_Model {
	
	/*public $_rules = array(
				'answers' => array(
						'field' => 'answers',
						'label' => 'Answers',
						'rules' => 'required|xss_clean'
				),
				'point' => array(
						'label' => 'Point',
						'field' => 'point',
						'rules' => 'required|xss_clean'
				),
			);*/
	
	public function __construct()
	{		
		parent::__construct();
		
		/**
		 * If the sample module's table was named "samples"
		 * then MY_Model would find it automatically. Since
		 * I named it "sample" then we just set the name here.
		 */
		$this->_table = 'default_inn_quiz_user_activity';
		//$this->load->model('user_m');
		
		/*if($this->users_m->delete('15')){
			echo 'delete';
		}*/
	}
	
	public function get_all_useractivity()
	{
		$this->db->select('b.id, b.username, a.answers, a.point');
		$this->db->from('default_inn_quiz_user_activity a');
		$this->db->join('default_users b' , 'a.user_id = b.id');
		
		return $this->db->get()->result();
		
	}
	
	public function get_useractivity($id = NULL)
	{	
		$this->db->select('c.username, b.name, a.point, c.email');
		$this->db->from('default_inn_quiz_user_activity a');
		$this->db->join('default_inn_quiz b' , 'a.quiz_id = b.id');
		$this->db->join('default_users c' , 'a.user_id = c.id');
		
		$this->db->where('c.id',$id);
	
		return $this->db->get()->result();		
	
	}
	
	public function get_useractivity_by($where, $fields='', $single=FALSE){
		if($single){
			$method = 'row';
		}else{
			$method = 'result';
		}

		
		if($fields != ''){
			$this->db->select(fields);
		}else{
			$this->db->select('*');
		}

		$this->db->where($where);
		return $this->db->get($this->_table)->$method();
	}
	
	/*public function update_useractivity($id, $data)
	{
		$this->db->where('id', $id);

		if($this->db->update($this->_table, $data)){
			return TRUE;
			echo 'TRUE';
		}else{
			return FALSE;
			echo 'FALSE';
		}
	}*/
	
	public function get_username()
	{
		return $this->db->get('default_users')->result();
	}
	
	public function get_username_by($where, $single = FALSE)
	{
		$method = 'result';

		if($single){
			$method = 'row';
		}

		if(isset($where)){
			$this->db->where($where);	
		}
		
		return $this->db->get('default_users')->$method();
		
	}
	
}