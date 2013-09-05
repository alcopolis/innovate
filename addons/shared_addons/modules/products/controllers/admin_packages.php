<?php

class Admin_Packages extends Admin_Controller {
	
	protected $section = 'packages';
	
	protected $packages_data;
	protected $page_data;
	protected $data_filter;
	
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
		$this->page_data = new stdClass();
		$this->page_data->section = $this->section;
		$this->page_data->post_type = 'wysiwyg-simple';
		$this->data_filter = array('name, cat, slug, price, body, group');
	
		$this->load->model('packages_m');
		$this->load->model('products_m');
		$this->load->library('alcopolis');
		
		//Validation rules
		$this->rules = $this->packages_m->_rules;
		$this->form_validation->set_rules($this->rules);
	}
	
	
	public function render($view, $var = NULL){
		if(isset($var)){
			$this->template->set($var);
		}
		
		$this->template
			->title($this->module_details['name'] . ' ' . $this->page_data->section)
			->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
			->append_js('module::product_form.js')
			->set('page_data', $this->page_data)
			->set('packages_data', $this->packages_data)
			->build($view);
	}
	
	
	
	
	/**
	 * Index methods, lists all pages
	 */
	public function index()
	{
		$this->packages_data = $this->packages_m->get_all();
		$this->render('admin/packages');
		//echo 'Packages Index';
	}
	
	public function create()
	{
		$this->page_data->action = 'create';
		$this->rules['name']['rules'] = 'trim|required|is_unique[inn_products_packages_copy.name]|xss_clean';
		$this->rules['slug']['rules'] = 'trim|required|is_unique[inn_products_packages_copy.slug]|xss_clean';
		$this->form_validation->set_rules($this->rules);
		
		if($this->input->get('prod_id') != null){
			//create from product page
			
		}else{
			//create from package page
		}
		
		
// 		$post = new stdClass();
// 		$post->type = 'wysiwyg-advanced';
		
// 		$this->data->form_action = 'create';
// 		$this->data->page_title = 'New Package';
		
// 		$this->template
// 			->title($this->data->page_title)
// 			->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
// 			->append_js('module::product_form.js')
// 			->set('data', $this->data)
// 			->set('post', $post)
// 			->build('admin/package_form');
	}
	
	
	
	
	public function edit($id)
	{
		$this->page_data->action = 'edit';
		
		if($this->form_validation->run()){
			var_dump($this->input->post());
			
			
			$data = $this->alcopolis->array_from_post();
			
			if($this->input->post('btnAction') == 'save_exit'){
				$this->index();
			}
		}else{
			
		}
		
		$this->packages_data = $this->packages_m->get_packages_by('', array('id' => $id), true);
		$this->packages_data->prod_name = $this->products_m->get_product_by('product_name', array('product_id' => $this->packages_data->prod_id), true);
		
		$this->render('admin/package_form');
		
	}
}