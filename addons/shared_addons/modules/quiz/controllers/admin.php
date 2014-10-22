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
		
		$this->load->library('alcopolis');
		

		$this->quiz_data = new stdClass();
	
	}
	
	
	
	function render($view, $var = NULL){
		$this->template
		->set($var)
		->build($view);
	}
	
	function index(){
		$this->title = 'Quiz';
		$all_quiz = $this->quiz_m->get_quiz();
		$this->render('admin/index', array('quiz' => $all_quiz));
	}
	
	
/*	function create(){
		
	
	} */
	
	
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
