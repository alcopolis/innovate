<?php

class Admin_Packages extends Admin_Controller {
	
	protected $section = 'packages';
	protected $data;
	
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
// 		$this->template
// 			->title($this->module_details['name'] . ' ' . $this->data->section)
// 			->set('data', $this->data)
// 			->build('admin/packages');

		echo 'Packages Index';
	}
	
	public function create()
	{
		echo 'Create New Packages';
	}
	
	public function edit($slug)
	{
		echo 'Edit Packages';
	}
}