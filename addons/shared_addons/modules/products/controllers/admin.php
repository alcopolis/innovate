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
	protected $pack_data;

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
		
		$this->load->model('products_m');
		$this->load->model('packages_m');
		$this->load->model('files/file_folders_m');
		
		$this->load->library('alcopolis');
		$this->load->library('files/files');
		
		$this->prod_data = new stdClass();
		$this->pack_data = new stdClass();
		
		
		$this->page_data = new stdClass();
		$this->page_data->section = $this->section;
		$this->page_data->editor_type = 'wysiwyg-advanced';
		
		
		// Set our validation rules
		$this->rules = $this->products_m->_rules;
		$this->form_validation->set_rules($this->rules);
	}

	
	function render($view){
		$this->template
			->title($this->module_details['name'])
			->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
			->append_js('module::product_form.js')
			->set('prod', $this->prod_data)
			->set('pack', $this->pack_data)
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
			$this->prod_data = $this->products_m->add_new();
			$this->pack_data = NULL;
			
			$this->render('admin/product_form');
		}
	}

	
	public function edit($id)
	{
		//Setting page variable
		$this->page_data->title = 'Edit Product';
		$this->page_data->action = 'edit';
	
		if($this->form_validation->run()){
			
			
		}else{
			$this->prod_data = $this->products_m->get_product_by(NULL, array('id'=>$id), TRUE);
			$this->pack_data = $this->packages_m->get_packages_by(NULL, array('prod_id'=>$id));
			//var_dump($this->pack_data);
			
			$this->render('admin/product_form');
		}
	}
	
	
	
	
	//-------------------- Upload poster function ------------------------ //
	
	public function do_upload(){
	
		$prod_data = $this->input->post('form_data');
		
		if($prod_data['poster_id'] != ''){
			if(Files::delete_file($prod_data['poster_id'])){
				$this->products_m->update($prod_data['id'], array('poster'=>''));
			}
		}
	
		$folder_id = $this->file_folders_m->get_by('slug', 'products')->id;
	
		$result = Files::upload($folder_id, $prod_data['slug'], 'poster', 1920, false, true);
		$file_data = $this->parse_file_data($result['data']);
		//$this->products_m->update($prod_data['id'], array('poster'=>$file_data));
		
	
		$respond = array(
				'status'=>$result['status'],
				'message'=>$result['message'],
				'file'=>Files::$path . $result['data']['filename'],
		);
	
		//Send ajax respond
		echo json_encode($respond);
	}
	
	
	function parse_file_data($data){
		$result = array();
		$key = array('id', 'folder_id', 'name', 'path', 'filename');
	
		foreach($key as $k){
			$result[$k] = $data[$k];
		}
	
		return json_encode($result);
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
