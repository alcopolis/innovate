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
		
		
		
		//Get Category Tree
// 		$result = $this->db->where('parent_id', 0)->order_by('id', 'ASC')->get('default_inn_faq_category')->result();
		
// 		foreach($result as $cat){
// 			echo '<h4>' . $cat->category . '</h4>';
// 			$this->getTree($cat->id,0);
// 		}

		$this->cat_tree = $this->getTree();
		
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
		
// 		$this->cat_tree = array(
// 					'top-level' => 'Top Level',
// 					'other' => 'Other',
// 					'payment' => array(
// 							'cara-bayar' => 'Cara Bayar',
// 							'mandiri-power-bills' => 'Mandiri Power Bills',
// 							'transfer-atm' => 'Transfer ATM',
// 							'billing' => 'Billing'
// 						)
// 				);

		
		$temp = array(
					0 => array('child'=>FALSE, 'level' => 0, 'parent' => NULL, 'slug' => '', 'cat' => 'No Parent'),
					1 => array('child'=>FALSE, 'level' => 0, 'parent' => NULL, 'slug' => 'other', 'cat' => 'Other'),
					2 => array('child'=>FALSE, 'level' => 1, 'parent' => 11, 'slug' => 'billing', 'cat' => 'Billing'),
					6 => array('child'=>FALSE, 'level' => 1, 'parent' => 11, 'slug' => 'mandiri-power-bills', 'cat' => 'Mandiri Power Bills'),
					11 => array('child'=>TRUE, 'level' => 0, 'parent' => NULL, 'slug' => 'payment', 'cat' => 'Payment')
				);
		
		
		
		
//		var_dump($tes);
		
		
// 		$level = 0;
// 		$spacer = '--';
// 		foreach ($this->cat_tree as $id=>$branch){
// 			if($branch['parent'] == NULL){
// 				echo '<option value="' . $id . '">' . $branch['cat'] . '</option>';
// 			}else{
// 				echo '<option value="' . $id . '">' . str_repeat($spacer, $branch['level']) . '&nbsp;' . $branch['cat'] . '</option>';
// 			}
// 		}
		
		$level = 0;
		$spacer = '--';
		foreach ($this->cat_tree as $id=>$branch){
			if($branch->parent_id == NULL){
				echo $branch->category;
			}else{
				$parent = NULL;	
				echo $spacer . $branch->category;
			}
			echo '</br>';
		}
		
		
		
		
//		var_dump($this->cat_tree);
		
		
		
		
		
// 		if($this->form_validation->run()){
// 			$data = $this->alcopolis->array_from_post(array('category'), $this->input->post());
			
// 			//create slug
// 			$tmp = strtolower($this->input->post('category'));
// 			$data['slug'] = str_replace(' ', '-', $tmp);
			
// 			if($this->faq_cat_m->insert_category($data)){
// 				redirect('admin/faq');
// 			}
// 		}else{
// 			$this->cat_data = $this->faq_cat_m->add_new();
// 		}
					
// 		$this->render('admin/category_form', array('cat'=>$this->cat_data, 'page'=>$this->page_data));
	}
	
	
	function delete($slug){
		if($this->faq_cat_m->delete_category($slug)){
			redirect('admin/faq');
		}
	}
	
	
	
	protected $temp = array();
	
	private function getTree($parent = NULL, $level = 0){
		$result = $this->db->where('parent_id', $parent)->get('default_inn_faq_category')->result();
		
		
		foreach($result as $row){
			$this->temp[$row->id] = $row;
			
			$this->getTree($row->id, $level+1);
		}
		
		//$tree = $this->arrangeCat($this->temp);
		$tree = $this->temp;
		
		return $tree;
	}
	
}
