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
	protected $section = 'faq';
	protected $rules = array();
	
	protected $faq_data;
	protected $page_data;
	
	public function __construct()
	{
		parent::__construct();
		
		//$this->faq_data = new stdClass();
		$this->page_data = new stdClass();
		$this->page_data->editor_type = 'wysiwyg-advanced';
		
		// Load all the required classes
		$this->load->model('faq_m');
		$this->load->model('faq_cat_m');
		
		// Set our validation rules
		$this->form_validation->set_rules($this->faq_m->_rules);
		
		//Library
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library('alcopolis');
	}
	
	
	
	function render($view, $var){
		$this->template
		->title($this->module_details['name'])
		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
		->append_js('module::faq.js')
		->set($var)
		->build($view);
	}
	
	function index(){
		//$this->faq_data = $this->faq_m->get_faq();
		//$this->render('index', array('faqs'=>$this->faq_data));
		
		$all_cats = $this->faq_cat_m->get_category();
		
		foreach($all_cats as $cat){
			$this->faq_data[$cat->category] = $this->faq_m->get_faq_by(array('category' => $cat->id));
		}
		
		$this->render('admin/index', array('faqs'=>$this->faq_data));
	}
	
	
	function create($c){
		$this->page_data->action = 'create';
		$this->faq_data = $this->faq_m->add_new($c);
		$cat = array();

		$temp_cat = $this->faq_cat_m->get_category();
		foreach($temp_cat as $item){
			$cat[$item->id] = ucwords($item->category);
		}
		
		if($this->form_validation->run()){			
			//$input_post = array();
				
			$data = $this->alcopolis->array_from_post(array('title', 'category', 'question', 'answer'), $this->input->post());
				
			$new_id = $this->faq_m->insert_faq($data);
			
			if($this->input->post('btnAction') == 'save_exit'){
				redirect('admin/faq');
			}else{
				$this->edit($new_id);
			}			
		}else{
			$this->template->append_js('module::faq_form.js');
			$this->page_data->title = strtoupper($this->section) . ' | ' . ucwords($c);
			$this->render('admin/form', array('faqs'=>$this->faq_data, 'cat'=>$cat, 'page'=>$this->page_data));
		}
	}
	
	
	function edit($id){
		$this->page_data->action = 'edit';
		$this->faq_data = $this->faq_m->get_faq_by(array('id' => $id),NULL,TRUE);
		$cat = array();

		$temp_cat = $this->faq_cat_m->get_category();
		foreach($temp_cat as $item){
			$cat[$item->id] = ucwords($item->category);
		}
		
		if($this->form_validation->run()){
			$input_post = array();
			
			$data = $this->alcopolis->array_from_post(array('title', 'category', 'question', 'answer'), $this->input->post());
			
			if($this->faq_m->update_faq($id, $data)){
				if($this->input->post('btnAction') == 'save_exit'){
					redirect('admin/faq');
				}else{
					redirect('admin/faq/edit/' . $id);
				}
			}
		}

		$this->template->append_js('module::faq_form.js');
		$this->page_data->title = strtoupper($this->section) . ' | ' . ucwords($cat[$this->faq_data->category]);
		$this->render('admin/form', array('faqs'=>$this->faq_data, 'cat'=>$cat, 'page'=>$this->page_data));
	}
	
	function delete($id){
		$this->faq_m->delete($id);
		$this->index();
	}
	
}
