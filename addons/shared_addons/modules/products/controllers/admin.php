<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Pages controller
 *
 * @author 		PyroCMS Dev Team
 * @package 	PyroCMS\Core\Modules\Products\Controllers
 */
class Admin extends Admin_Controller {

	/**
	 * The current active section
	 *
	 * @var string
	 */
	protected $section = 'products';
	protected $rules = array();
	
	protected $page_data;
	protected $prod_data;	

	/**
	 * Constructor method
	 *
	 * Loads the form_validation library, the pages, pages layout
	 * and navigation models along with the language for the pages
	 * module.
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->prod_data = new stdClass();
		$this->page_data = new stdClass();
		
		$this->page_data->section = $this->section;
		$this->page_data->editor_type = 'wysiwyg-advanced';
		
		$this->load->model('products_m');
		
		// Set our validation rules
		$this->rules = $this->products_m->product_rules;
		$this->form_validation->set_rules($this->rules);
	}

	
	function render($view){
		$this->template
			->title($this->module_details['name'])
			->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
			->append_js('module::product_form.js')
			->set('prod', $this->prod_data)
			->set('page', $this->page_data)
			->build($view);
	}
	
	
	/**
	 * Index methods, lists all products
	 */
	public function index()
	{
		$this->page_data->title = 'Products';
		$this->prod_data = $this->products_m->get_product();		
		$this->render('admin/index');
	}

	
	public function create(){
		$this->page_data->title = 'Add Product';
		$this->page_data->action = 'create';
		
		if($this->form_validation->run()){
			// Insert data
		}else{
			$this->render('admin/product_form');
		}
	}
	
	
	public function edit($id)
	{
		//Setting page variable
		$this->page_data->title = 'Edit Product';
		$this->page_data->action = 'edit';
		
		
		if($this->form_validation->run()){
			$data = array();
			$fields_key = array();

			//Cari nama input dg awalan "product"
			foreach($this->input->post() as $field=>$value){
				if (strpos($field,'product') !== false) {
					$fields_key[] = $field;
					$data[$field] = $value;
				}
			}	

			if(!in_array('product_is_featured', $fields_key)){
				$data['product_is_featured'] = '0';
			}
			
			
			if($this->products_m->update_product($id, $data)){
				redirect('admin/products');
			}else{
				$this->render('admin/product_form');
			}
		}else{

			$this->prod_data = $this->products_m->get_product($id);
			
			$this->render('admin/product_form');
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	// -------------------- Callback Function --------------------------- //
	
	function _checkbox($str){
		
		if($this->input->post('product_is_featured') != NULL){
			//$this->prod_data->data->product_is_featured = 1;
		}else{
			//$this->prod_data->data->product_is_featured = 1;
		}
	}
}
