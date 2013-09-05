<?php

class Admin_Packages extends Admin_Controller {
	
	protected $section = 'packages';
	protected $data;
	protected $post;
	
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
		
		$this->data = new stdClass();
		$this->data->section = $this->section;
	
		$this->load->model('packages_m');
	}
	
	/**
	 * Index methods, lists all pages
	 */
	public function index()
	{
		$this->template
			->title($this->module_details['name'] . ' ' . $this->data->section)
			->set('data', $this->data)
			->build('admin/packages');

		//echo 'Packages Index';
	}
	
	public function create()
	{
		if($this->input-get('prod_id') != null){
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
	
	
	
	
	public function edit($slug)
	{
		echo 'Edit Packages';
	}
}