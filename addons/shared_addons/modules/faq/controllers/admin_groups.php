<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FAQ Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */

class Admin_Groups extends Admin_Controller
{
	protected $section = 'faq';
	
	protected $cat_data;
	protected $page_data;
	protected $cat_tree;
	
	public function __construct()
	{
		parent::__construct();
		
		//$this->faq_data = new stdClass();
		$this->page_data = new stdClass();
		$this->page_data->editor_type = 'wysiwyg-advanced';
		
		// Load all the required classes
		$this->load->model('faq_cat_m');
		
		// Set our validation rules
		$this->form_validation->set_rules($this->faq_cat_m->_rules);
		
		//Library
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('alcopolis');
		
		
		//Get category tree
		$this->cat_tree = $this->faq_cat_m->getTree();
		
	}
	
	
	
	function render($view, $var){
		$this->template
		->title($this->module_details['name'])
		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
		->append_js('module::faq.js')
		->set('cat_tree', $this->cat_tree)
		->set($var)
		->build($view);
	}
	
	function index(){
		redirect('admin/faq');
	}
	
	
	function create(){
		$this->page_data->title = 'Add New Group';
		$this->page_data->action = 'create';		
		
		
		if($this->form_validation->run()){
			$data = $this->alcopolis->array_from_post(array('category', 'parent_id'), $this->input->post());

			if($data['parent_id'] == '0'){
				$data['parent_id'] = NULL;
			}
			
			//create slug
			$tmp = strtolower($this->input->post('category'));
			$data['slug'] = str_replace(' ', '-', $tmp);
			
			if($this->faq_cat_m->insert_category($data)){
				redirect('admin/faq');
			}
		}else{
			$this->cat_data = $this->faq_cat_m->add_new();
		}
					
		$this->render('admin/category_form', array('cat'=>$this->cat_data, 'page'=>$this->page_data));
	}
	
	
	
	function delete($slug){
		if($this->faq_cat_m->delete_category($slug)){
			redirect('admin/faq');
		}
	}
	
	
	
// 	protected $temp = array();
	
// 	private function getTree($parent = NULL, $level = 0){
// 		$result = $this->db->where('parent_id', $parent)->get('default_inn_faq_category')->result();
		
		
// 		foreach($result as $row){
// 			$this->temp[$row->id] = $row;
			
// 			$this->getTree($row->id, $level+1);
// 		}
		
// 		$tree = $this->temp;
		
// 		return $tree;
// 	}
	
}
