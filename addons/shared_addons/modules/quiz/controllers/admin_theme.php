<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FAQ Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */

class Admin_Theme extends Admin_Controller
{
	protected $section = 'quiz';
	
	protected $theme_data;
	protected $page_data;
	
	public function __construct()
	{
		parent::__construct();
		
		//$this->faq_data = new stdClass();
		$this->page_data = new stdClass();
		$this->page_data->editor_type = 'wysiwyg-advanced';
		
		// Load all the required classes
		$this->load->model('quiz_m');
		
		// Set our validation rules
		$this->form_validation->set_rules($this->quiz_m->_rules);
		
		//Library
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('alcopolis');
		
		
		//Get theme tree
		$this->theme_tree = $this->quiz_m->getTree();
		
	}
	
	
	
	function render($view, $var){
		$this->template
		->title($this->module_details['name'])
		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
		->append_js('module::faq.js')
		->set('theme_tree', $this->theme_tree)
		->set($var)
		->build($view);
	}
	
	function index(){
		redirect('admin/quiz');
	}
	
	
	function create(){
		$this->page_data->title = 'Add New Theme';
		$this->page_data->action = 'create';		
		
		
		if($this->form_validation->run()){
			$data = $this->alcopolis->array_from_post(array('theme', 'parent_id'), $this->input->post());

			if($data['parent_id'] == '0'){
				$data['parent_id'] = 0;
			}
			
			//create slug
			$tmp = strtolower($this->input->post('theme'));
			$data['slug'] = str_replace(' ', '-', $tmp);
			
			if($this->quiz_m->insert_theme($data)){
				redirect('admin/quiz');
			}
		}else{
			$this->theme_data = $this->quiz_m->add_new();
		}
					
		$this->render('admin/theme_form', array('tema'=>$this->theme_data, 'page'=>$this->page_data));
	}
	
	
	function edit($slug){
		$this->page_data->title = 'Edit Group';
		$this->page_data->action = 'edit';
		
		$this->cat_data = $this->faq_cat_m->get_category_by(array('slug'=>$slug), NULL, TRUE);
		
		if($this->form_validation->run()){
			$data = $this->alcopolis->array_from_post(array('parent_id'), $this->input->post());
			
			if($this->faq_cat_m->update_category($this->cat_data->id, $data)){				
				$this->cat_data = $this->faq_cat_m->get_category_by(array('slug'=>$slug), NULL, TRUE);
				
				if($this->input->post('btnAction') == 'save_exit'){
					redirect('admin/quiz');
				}
			}
		}
			
		$this->render('admin/category_form', array('cat'=>$this->cat_data, 'page'=>$this->page_data, 'parent_cat'=>$this->cat_data->parent_id));
		
	}
	
	
	function delete($slug){
		if($this->faq_cat_m->delete_category($slug)){
			redirect('admin/quiz');
		}
	}
	
}
