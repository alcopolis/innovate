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
			->append_css('module::style.css')
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

	//Create New Product
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
			
			//set parent data and folder if parent_id != 0
			$files_tmp = array();
			
			if($this->form_data['parent_id'] != '0'){
				$parent_data = $this->products_m->get_product_by('slug', array('id'=>$this->form_data['parent_id']), TRUE);
				
				//create product folder
				$files_tmp['folder'] = $this->get_folder($parent_data->slug, $this->form_data['slug']);
			}else{
				//create product folder
				$files_tmp['folder'] = $this->get_folder('products', $this->form_data['slug']);
			}
			
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

	
	//Edit Product
	public function edit($id)
	{
		//Setting page variable
		$this->page_data->title = 'Edit Product';
		$this->page_data->action = 'edit';
		

		$this->prod_data = $this->products_m->get_product_by(NULL, array('id'=>$id), TRUE);
		$this->pack_data = $this->packages_m->get_packages_by(NULL, array('prod_id'=>$id));
		
		
		
		if($this->form_validation->run()){
			$parent_data;
			
			// Prepare form data
			$this->form_data = $this->alcopolis->array_from_post(array('parent_id', 'name', 'overview', 'body', 'section', 'tags', 'css', 'js', 'is_featured'), $this->input->post());
			
			//create slug
			$tmp = strtolower($this->input->post('name'));
			$this->form_data['slug'] = str_replace(' ', '-', $tmp);
				
			//set parent data and folder if parent_id != 0
			$files_tmp = json_decode($this->prod_data->files);
			
			if($files_tmp == NULL){
				if($this->form_data['parent_id'] != '0'){
					$parent_data = $this->products_m->get_product_by('slug', array('id'=>$this->form_data['parent_id']), TRUE);
					
					//create product folder
					$files_tmp['folder'] = $this->get_folder($parent_data->slug, $this->form_data['slug']);
				}else{
					//create product folder
					$files_tmp['folder'] = $this->get_folder('products', $this->form_data['slug']);
				}
				
				$this->form_data['files'] = json_encode($files_tmp);
			}
			
			//update data
			$this->products_m->update($id, $this->form_data);
			
			$this->prod_data = $this->products_m->get_product_by(NULL, array('id'=>$id), TRUE);
			$this->pack_data = $this->packages_m->get_packages_by(NULL, array('prod_id'=>$id));
			
			if($this->input->post('btnAction') == 'save_exit'){
				redirect('admin/products');
			}			
		}
		
		
		
		
		//Set Parent Product
		$tmp = $this->products_m->get_product_by('id, name', array('parent_id'=>0),FALSE);
		$parent_list[0] = 'No Parent';
		foreach($tmp as $val){
			$parent_list[$val->id] = $val->name;
		}
		
		//Parse files data from json
		$files = json_decode($this->prod_data->files, true);
		//$stored_attch = Files::folder_contents($files['folder']);
		
		if($files != ''){
			$stored_attch = array();
			if(count($files['attch']) > 0){
				foreach($files['attch'] as $name=>$file){
					$temp = Files::get_file($file['id']);
					$stored_attch[$name]['display'] = $file['display'];
					$stored_attch[$name]['data'] = $temp['data'];
				}
			}else{
				$stored_attch = NULL;
			}
		}
		
		$this->render('admin/product_form', array('parent'=>$parent_list, 'poster'=>$files['poster'], 'attachment'=>$stored_attch));

	}
	
	
	
	
	//-------------------- Attachment Files function ------------------------ //
	
	public function get_folder($parent, $slug){
		//create new folder if not exist and named it with product slug 
		$par = $this->file_folders_m->get_by('slug', $parent)->id;
		
		if($this->file_folders_m->get_by('slug', $slug) == NULL){
			Files::create_folder($par, $slug);
		}
		
		return $this->file_folders_m->get_by('slug', $slug)->id;
	}

	
	
	
	public function do_upload($form_id){
		$upload_data;
		$result;
		$respond = array();
		
		
		$prod_data = $this->input->post('form_data');
		
		$input_name = $form_id;
		$pid = $prod_data['id'];
		
		
		//Get products files json data
		$files_data = $this->parse_files_json($pid, true);
		
		if($prod_data['poster_id'] != ''){
			Files::delete_file($prod_data['poster_id']);
		}
			
		if($input_name == 'poster'){
			$result = Files::upload($files_data['folder'], $prod_data['slug'], 'poster', 1920, false, true);
			
			$upload_data = $this->parse_file_data($result['data']);
			foreach($upload_data as $key=>$val){
				$files_data['poster'][$key] = $val;
			}
			
			$this->products_m->update($prod_data['id'], array('files'=>json_encode($files_data)));
		
			$respond['message'] = 'Poster has been uploaded';
		}else{
			
			if(isset($files_data['attch'])){
				$stored_attch = count($files_data['attch']);
			}else{
				$stored_attch = 0;
			}
			
			//Uploading files
			$rename = $this->input->post('attchname');
			
			if($rename == ''){
				$rename = 'attachment-' . ($stored_attch+1);
			}
			$result = Files::upload($files_data['folder'], $rename, $input_name);
			
			
			//If upload success, insert metadata into db
			if($result['status']){
				$upload_data = $this->parse_file_data($result['data']);
				foreach($upload_data as $key=>$val){
					if($key == 'id'){
						$files_data['attch'][$rename]['id'] = $val;
						$files_data['attch'][$rename]['display'] = $this->input->post('attchdisptype');
					}
				}
				
				$this->products_m->update($prod_data['id'], array('files'=>json_encode($files_data)));
				
				
				
				//append list item
				$size = intval($upload_data['filesize']);
					
				if($size > 1024){
					$filesize = round($size/1024) . ' MB';
				}else{
					$filesize = $size . ' KB';
				}
					
				$respond['list'] .= '<tr><td>' . $upload_data['name'] . '</td>';
				$respond['list'] .= '<td>' . $filesize . '</td>';
				$respond['list'] .= '<td>' . $upload_data['mimetype'] . '</td>';
				$respond['list'] .= '<td>' . $this->input->post('attchdisptype') . '</td>';
				$respond['list'] .= '<td><a onclick="delete_attch(this)" class="button" style="padding:5px 10px 4px 10px;" data-id="' . $upload_data['id'] . '">Delete</a></td>';
				
				$respond['message'] = 'File has been uploaded';
			}else{
				$respond['message'] = strip_tags($result['message']);
			}
			
		}

		//Send ajax respond
		$respond['status'] = $result['status'];
		$respond['type'] = $input_name;
		$respond['file'] = Files::$path . $result['data']['filename'];
		
		echo json_encode($respond);
	}
	
	
	
	
	public function delete_attch($file_key){
		$prod_data = $this->input->post('form_data');
		
		$pid = $prod_data['id'];
		
		//Get products files json data
		$files_data = $this->parse_files_json($pid, true);
		$attch_list = $files_data['attch'];
		
		$result = Files::delete_file($attch_list[$file_key]['id']);
		
		unset($files_data['attch'][$file_key]);
		
		$this->products_m->update($prod_data['id'], array('files'=>json_encode($files_data)));
		
		$respond = array(
				'status'=>$result['status'],
				'message'=>$result['message']
		);
		
		echo json_encode($respond);
	}
	
	



	function parse_file_data($data, $key = array('id', 'path', 'name', 'filename', 'mimetype', 'filesize')){
		$result = array();
	
		foreach($key as $k){
			$result[$k] = $data[$k];
		}
	
		return $result;
	}
	
	
	private function parse_files_json($id, $assoc = FALSE){
		return json_decode($this->products_m->get_product_by('files', array('id'=>$id), TRUE)->files, $assoc);
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
