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
		//$this->form_validation->set_rules($this->quiz_m->_rules);
		
	}
	
	
	
	function render($view, $var){
		$this->template
		->title($this->module_details['name'])
		->append_js('module::main.js')
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
	
	
	public function get_quiz_by($where=NULL, $fields=NULL, $single=FALSE){
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
	
	public function get_check($where, $fields, $single){
		$this->db->where("user_id",$user_id);
		$this->db->where("quiz_id",$quiz_id);
		$this->db->where("answers",$jawaban);
	}
	
	public function logout(){
		Events::trigger('pre_user_logout');

		$this->ion_auth->logout();

		if ($this->input->is_ajax_request())
		{
			exit(json_encode(array('status' => true, 'message' => lang('user:logged_out'))));
		}
		else
		{
			$this->session->set_flashdata('success', lang('user:logged_out'));
			redirect('quiz');
		}
	}

//----------------------------------------------------------------------------------------------------------------------------------------------------
	
	
	function index(){
		$data = array();
		$now = strtotime(date('Y-m-d'));
	
		$result = $this->get_quiz();
		
		foreach($result as $row){
			if(strtotime($row->start_date) <= $now && strtotime($row->end_date) >= $now){
				$data[] = $row;
			}
		}
		
		//var_dump($data);
		$this->render('index', array('quiz'=>$data));
	}
	
	function pages($slug=''){
		$data = $this->get_quiz_by(array('slug'=>$slug), '', TRUE);
		$q = $this->get_quizQ_by(array('quiz_id'=>$data->id), '', FALSE);
		
		$this->render('pages', array('quiz'=>$data, 'question'=>$q));
	}
	
	function check($slug=''){
		$post = $this->input->post();
		$totalQ = intval($this->input->post('total'));
		$user_answers = array();
		$point = 0;
		$counter = 0;
		
		$quiz = $this->get_quiz_by(array('slug'=>$slug), '',TRUE);
		$user = $this->session->userdata('user_id');
		$answers = $this->get_quizQ_by(array('quiz_id'=>$quiz->id), 'answer_admin', FALSE);
		
		$user_is_not_yet_play = $this->check_user($user, $quiz->id);
		
		//var_dump($post, $answers); //$quiz->id, $answers[0]->answer_admin);
		//die();
		
		if($user_is_not_yet_play){
			foreach($post as $k=>$val){
				if($k != 'submit' || $k != 'total'){
					if($answers[$counter]->answer_admin == $val){
						$user_answers[] = $counter + 1;
						$point++;
					}
						
					if($counter < $totalQ-1){
						$counter++;
					}
				}
			}
			
			$data = array(
						'user_id' => $user,
						'quiz_id' => $quiz->id,
						'answers' => json_encode($user_answers),
						'point' => $point
					);
			
			if($this->db->insert('inn_quiz_user_activity', $data)){
				redirect('quiz');
			}
		}else{
			//Tampilkan oops page
			redirect('quiz');
		}
	}
	
	private function check_user($uid, $qid){
		$result = $this->db->where(array('user_id'=>$uid, 'quiz_id'=>$qid))->get('inn_quiz_user_activity')->result();
		//var_dump($result);
		//die();
		if(count($result) == 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
