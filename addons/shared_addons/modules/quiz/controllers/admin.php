<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FAQ Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */

class Admin extends Admin_Controller
{
	protected $section = 'quiz';
	
	protected $quiz_data;
	protected $page_data;
	
	protected $form_data;
	protected $files;
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('quiz_m');
		$this->load->model('quiz_question_m');
		$this->load->model('quiz_user_activity_m');
		
		$this->load->library('alcopolis');
		

		$this->quiz_data = new stdClass();
	
	}
	
	
	
	function render($view, $var = NULL){
		$this->template
		->append_js('module::quiz-admin.js')
		->append_css('module::style-admin.css')
		->set($var)
		->build($view);
	}
	
	function index(){
		$this->title = 'Quiz';
		$all_quiz = $this->quiz_m->get_quiz();
		$this->render('admin/index', array('quiz' => $all_quiz));
	}
	
	
	public function edit($id){	
		$page = new stdClass();
		$page->action = 'edit';
		
		$quiz = $this->quiz_m->get_quiz_by(array('id'=>$id), '', true);
		$quest = $this->quiz_question_m->get_question_by(array('quiz_id'=>$id), '');
		//$useract = $this->quiz_user_activity_m->get_useractivity_by(array('quiz_id'=>$id));
		
		$user = $this->quiz_m->order_by('point', 'DESC')->limit(20)->get_winner($id);
		
		$this->render('admin/quiz_form', array('page'=>$page, 'quiz'=>$quiz, 'quest'=>$quest, 'user'=>$user));
	}
	
	
	function create(){
		$page = new stdClass();
		$page->action = 'create';
		
		$quiz = $this->quiz_m->add_new();
		$user = NULL;
		$this->render('admin/quiz_form', array('page'=>$page, 'quiz'=>$quiz, 'user'=>$user));
	}
	
	
/*	function edit($id){
		$this->page_data->title = 'Edit Quiz';
		$this->page_data->action = 'edit';
		
		$this->quiz_data = $this->product_m->get_product_by(NULL, array('id'=>$id), TRUE);
		
		if($this->form_validation->run()){
			$parent_data;
			
			$this->form_data = $this->alcopolis->array_from_post(); $this->input->post();
			
			$tmp = strtolower($this->input->post('name'));
			$this->form_data['slug'] = str_replace('', '-', $tmp);
			
			
		}
	}*/
	
/*	function delete($id){
		$this->quiz_m->delete($id);
		$this->index();
	} */
	
}
