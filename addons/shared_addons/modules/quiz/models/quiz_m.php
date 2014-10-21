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
	
	/*public $_rules = array(
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
				'theme' => array(
						'field' => 'theme',
						'label' => 'Theme',
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
		$this->_table = 'default_inn_quiz';
	}
	
	/*public function add_new(){
		
		$tema = new stdClass();
		
		$tema->id = NULL;
		$tema->name = '';
		$tema->slug = '';
		$tema->start_date ='';
		$tema->end_date = '';
		$tema->description = '';
		$tema->theme = '';

		return $tema;
	}*/
	
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
}