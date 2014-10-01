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
	
	
	public function get_quizQ_by($where=NULL, $fields=NULL, $single=FALSE){
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
		$q = $this->get_quizQ_by(array('quiz_id'=>$data->id), '', FALSE);
		//var_dump($slug);
		$this->render('pages', array('quiz'=>$data, 'question'=>$q));
	}
	
	
	function check($slug=''){		
		$data = $this->get_quiz_by(array('slug'=>$slug), '',TRUE);
		
		$qid = $data->id; //Get quiz ID
		$admin_ans = $this->get_quizQ_by(array('quiz_id'=>$qid)); //Get admin answer
		$uid = $this->session->userdata('user_id'); //Get user ID
		
		
		//Check if user already play the quiz
		$c = $this->db->where(array('user_id'=>$uid, 'quiz_id'=>$qid))->get('default_inn_quiz_user_activity')->result();
		
		if(count((array)$c) > 0){
			$this->session->set_flashdata('quiz_msg', 'Anda sudah pernah memainkan kuis ini.');	
		}else{
			$totalans = intval($this->input->post('total'));
			$ans = array();
			for($i=0; $i < $totalans ; $i++){
				$key = 'q-'. strval($i+1);	
				$ans[] = $this->input->post($key); //Get user answers
			}
			
			//Check answers
			$point = 0;
			$correct_ans = array();
			for($j=0; $j < $totalans ; $j++){
				if($admin_ans[$j]->answer_admin == $ans[$j]){
					$point++;
					$correct_ans[] = $j+1;
				}
			}

			$data_insert = array(
						'user_id' => $uid,
						'quiz_id' => $qid,
						'answers' => json_encode($correct_ans),
						'point'	=> $point
					);
			
			if($this->db->insert('default_inn_quiz_user_activity', $data_insert)){
				$this->session->set_flashdata('quiz_msg', 'Success');
			}else{
				$this->session->set_flashdata('quiz_msg', 'Fail');
			}
		}
		
		
		$this->session->keep_flashdata('quiz_msg');
		redirect('quiz/pages/' . $slug);
		//redirect('quiz');
	}
}
