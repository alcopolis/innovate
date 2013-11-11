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
	
	//Form and files var
	protected $form_data;
	protected $files;

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
		
		//init var
		$this->form_data = array();
		$this->files = array();
	}

	
	function render($view, $var = NULL){
		$this->template
			->title($this->module_details['name'])
			->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
			->append_js('module::product_form.js')
			->set('prod', $this->prod_data)
			->set('pack', $this->pack_data)
			->set('page', $this->page_data)
			->set($var)
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
			$parent_data;
			
			
			// Prepare form data
			$this->form_data = $this->alcopolis->array_from_post(array('parent_id', 'name', 'overview', 'body', 'section', 'tags', 'css', 'js', 'is_featured'), $this->input->post());
				
			//create slug
			$tmp = strtolower($this->input->post('name'));
			$this->form_data['slug'] = str_replace(' ', '-', $tmp);
			
			//set parent data if parent_id != 0
			if($this->form_data['parent_id'] != '0'){
				$parent_data = $this->products_m->get_product_by('slug', array('id'=>$this->form_data['parent_id']), TRUE);
			}
			
			//create product folder
			$files_tmp = array();
			$files_tmp['folder'] = $this->get_folder($parent_data->slug, $this->form_data['slug']);
			$this->form_data['files'] = json_encode($files_tmp);
			
			//insert data
			$new_id = $this->products_m->insert_prod($this->form_data);

			//redirects
			if($this->input->post('btnAction') == 'save_exit'){
				redirect('admin/products');
			}else{
				redirect('admin/products/edit/' . $new_id);
			}
		}else{
			$this->prod_data = $this->products_m->add_new();
			$this->pack_data = NULL;
			
			//Set Parent Product
			$tmp = $this->products_m->get_product_by('id, name', array('parent_id'=>0),FALSE);
			
			$parent_list[0] = 'No Parent';
			foreach($tmp as $val){
				$parent_list[$val->id] = $val->name;
			}
			
			$this->render('admin/product_form', array('parent'=>$parent_list));
		}
		
		
	}

	
	
	
	
	
	
	
	public function edit($id)
	{
		//Setting page variable
		$this->page_data->title = 'Edit Product';
		$this->page_data->action = 'edit';
		
	
		if($this->form_validation->run()){
			$parent_data;
			
			// Prepare form data
			$this->form_data = $this->alcopolis->array_from_post(array('parent_id', 'name', 'overview', 'body', 'section', 'tags', 'css', 'js', 'is_featured'), $this->input->post());
			
			//create slug
			$tmp = strtolower($this->input->post('name'));
			$this->form_data['slug'] = str_replace(' ', '-', $tmp);
				
			//set parent data if parent_id != 0
			if($this->form_data['parent_id'] != '0'){
				$parent_data = $this->products_m->get_product_by('slug', array('id'=>$this->form_data['parent_id']), TRUE);
			}
				
			//create product folder
			$files_tmp = array();
			$files_tmp['folder'] = $this->get_folder($parent_data->slug, $this->form_data['slug']);
			$this->form_data['files'] = json_encode($files_tmp);
				
			//insert data
			$this->products_m->update($id, $this->form_data);
			
			if($this->input->post('btnAction') == 'save_exit'){
				redirect('admin/products');
			}			
		}
		
		
		
		$this->prod_data = $this->products_m->get_product_by(NULL, array('id'=>$id), TRUE);
		$this->pack_data = $this->packages_m->get_packages_by(NULL, array('prod_id'=>$id));
		
		
		//Set Parent Product
		$tmp = $this->products_m->get_product_by('id, name', array('parent_id'=>0),FALSE);
		
		$parent_list[0] = 'No Parent';
		foreach($tmp as $val){
			$parent_list[$val->id] = $val->name;
		}
		
		$this->render('admin/product_form', array('parent'=>$parent_list));
		
			
		
// 		$this->prod_data = $this->products_m->get_product_by(NULL, array('id'=>$id), TRUE);
// 		echo $this->get_folder($this->prod_data->slug);
		
	}
	
	
	
	
	//-------------------- Upload function ------------------------ //
	
	public function get_folder($parent, $slug){
		//create new folder if not exist and named it with product slug 
		$par = $this->file_folders_m->get_by('slug', $parent)->id;
		
		if($this->file_folders_m->get_by('slug', $slug) == NULL){
			Files::create_folder($par, $slug);
		}
		
		return $this->file_folders_m->get_by('slug', $slug)->id;
	}
	
	
// 	public function do_upload(){
	
// 		$prod_data = $this->input->post('form_data');
		
// 		if($prod_data['poster_id'] != ''){
// 			if(Files::delete_file($prod_data['poster_id'])){
// 				$this->products_m->update($prod_data['id'], array('poster'=>''));
// 			}
// 		}
	
// 		$folder_id = $this->file_folders_m->get_by('slug', 'products')->id;
	
// 		$result = Files::upload($folder_id, $prod_data['slug'], 'poster', 1920, false, true);
// 		$file_data = $this->parse_file_data($result['data']);
// 		//$this->products_m->update($prod_data['id'], array('poster'=>$file_data));
		
	
// 		$respond = array(
// 				'status'=>$result['status'],
// 				'message'=>$result['message'],
// 				'file'=>Files::$path . $result['data']['filename'],
// 		);
	
// 		//Send ajax respond
// 		echo json_encode($respond);
// 	}

	
	
	
	public function do_upload($form_id){
	
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
	
	
	
	
	
	
// 	// -------------------- Callback Function --------------------------- //
	
// 	function _checkbox($str){
		
// 		if($this->input->post('product_is_featured') != NULL){
// 			//$this->prod_data->data->product_is_featured = 1;
// 		}else{
// 			//$this->prod_data->data->product_is_featured = 1;
// 		}
//	}
}
