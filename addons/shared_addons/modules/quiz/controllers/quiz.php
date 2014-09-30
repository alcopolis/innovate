<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FAQ Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */

class Quiz extends Public_Controller
{
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('alcopolis');
		$this->load->model('quiz_m');
		
		// Set validation rules
		$this->form_validation->set_rules($this->quiz_m->_rules);
	}
	
	
	
	function render($view, $var){
		$this->template
		->title($this->module_details['name'])
		//->append_js('module::main.js')
		->append_css('module::style-front.css')
		->set($var)
		->build($view);
	}
	
//------------------------------------------------------------------------------------------------------------------------------------------------
	
	public function get_quiz($fields=NULL, $single=FALSE){
		if(isset($fields)){
			$this->db->select($fields);
		}
	
		if($single){
			$method = 'row';
		}else{
			$method = 'result';
		}
	
		return $this->db->get('inn_quiz')->$method();
	}
	
	
	public function get_quiz_by($where=NULL, $fields=NULL, $single=NULL){
		if(isset($where)){
			if(isset($where)){
				$this->db->where($where);
			}
				
			return $this->get_quiz($fields, $single);
		}else{
			return FALSE;
		}
	}
	
	
	public function get_quizQ($fields=NULL, $single=FALSE){
		if(isset($fields)){
			$this->db->select($fields);
		}
	
		if($single){
			$method = 'row';
		}else{
			$method = 'result';
		}
	
		return $this->db->get('inn_quiz_question')->$method();
	}
	
	
	public function get_quizQ_by($where=NULL, $fields=NULL, $single=NULL){
		if(isset($where)){
			if(isset($where)){
				$this->db->where($where);
			}
	
			return $this->get_quizQ($fields, $single);
		}else{
			return FALSE;
		}
	}

//----------------------------------------------------------------------------------------------------------------------------------------------------
	
	
	function index(){
		$data = $this->get_quiz();
		//var_dump($data);
		$this->render('index', array('quiz'=>$data));
	}
	
	function pages($slug=''){
		$data = $this->get_quiz_by(array('slug'=>$slug), '', TRUE);
		$q = $this->get_quizQ_by(array('quiz_id'=>$data->id), '');
		
		//var_dump(json_encode($data));
		$this->render('pages', array('quiz'=>$data, 'question'=>$q));
	}
	
	function check($slug=''){
		
		var_dump($this->input->post());
		var_dump($this->session->all_userdata());
	}
}
