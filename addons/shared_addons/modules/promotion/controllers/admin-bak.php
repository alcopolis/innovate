<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin Promotion controller
 *
 * @author 		Adriant Rivano
 * @package 	Addons\Shared_Addons\Modules\Promotion\Controllers
 */
class Admin extends Admin_Controller {
	
	protected $section = 'promotion';
	protected $rules = array();
	
	protected $page_data;
	protected $user_data;
	protected $promo_data;
	protected $poster_data;
	protected $cat_data;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('promotion_m');
		$this->load->model('category_m');
		$this->load->model('files/file_folders_m');
		
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library('alcopolis');
		$this->load->library('files/files');
		
		$this->page_data = new stdClass();
		$this->user_data = new stdClass();
		$this->promo_data = new stdClass();
		//$this->poster_data = new stdClass();
		//$this->cat_data = new stdClass();
		
		$this->page_data->section = $this->section;
		$this->page_data->editor_type = 'wysiwyg-advanced';
		
		$this->user_data->id = $this->current_user->id;
		$this->user_data->name = $this->current_user->username;
		$this->user_data->role = $this->session->userdata('group');
		
		// Set validation rules
		$this->rules = $this->promotion_m->rules;
		$this->form_validation->set_rules($this->rules);
		
		// Get Category
		$temp = $this->category_m->get_categories();
		foreach($temp as $key=>$val){
			$this->cat_data[$key] = $val->cat;
		}
	}
	
	
	
	function render($view){
		$this->template
		->title($this->module_details['name'])
		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
		->append_js('module::main.js')
		->append_js('module::promo_form.js')
		->set('page', $this->page_data)
		->set('promos', $this->promo_data)
		->set('poster', $this->poster_data)
		->set('cats', $this->cat_data)
		->build($view);
	}
	
	
	
	public function index(){
		//Update promo status based on publish date
		$this->update_promo_status();
		
		$this->promo_data = $this->promotion_m->get_promo();
		$this->cat_data = $this->category_m->get_categories();
		
		$this->render('admin/index');

	}
	
	
	
	public function create()
	{
		$this->page_data->title = 'Add Promotion';
		$this->page_data->action = 'create';
		
		if($this->form_validation->run()){
			$db_fields = array('cat', 'name', 'slug', 'body', 'tags', 'publish', 'css', 'js');
				
			$data = $this->alcopolis->array_from_post($db_fields, $this->input->post());

			$data['author'] = $this->session->userdata('id');
			
			//Publish Ended
			$data['ended'] = $this->input->post('ended') == '' ? NULL : $this->input->post('ended');
				
			if($this->promotion_m->insert($data)){
				redirect('admin/promotion');
			}
		}
		
		$this->render('admin/promo_form');
	}
	
	
	
	public function edit($id)
	{
						
		if($this->form_validation->run()){
			$db_fields = array('cat', 'name', 'slug', 'body', 'tags', 'featured_copy', 'featured_uri', 'publish', 'css', 'js');

			$data = $this->alcopolis->array_from_post($db_fields, $this->input->post());

			//Set featured status
			$data['featured'] = $this->input->post('featured') == NULL ? 0 : 1;
			
			$data['author'] = $this->session->userdata('id');
			
			//Publish Ended
			$data['ended'] = $this->input->post('ended') == '' ? NULL : $this->input->post('ended');
			
			if($this->promotion_m->update($id, $data)){
				if($this->input->post('btnAction') == 'save_exit'){
					redirect('admin/promotion');
				}
			}
		}	
		
		
		$this->page_data->title = 'Edit Promotion';
		$this->page_data->action = 'edit';
		
		$this->promo_data = $this->promotion_m->get($id);
		
		if($this->promo_data->poster != ''){
			$poster = json_decode($this->promo_data->poster);
			$this->poster_data = array(
					'id' => $poster->id,
					'name' => $poster->name,
					'file' => Files::$path . $poster->filename,
					'description' => $poster->description,
					'keywords' => $poster->keywords,
					'alt_attr' => $poster->alt_attribute,
					'mimetype' => $poster->mimetype,
			);
		}
		
		$this->render('admin/promo_form');
	}
	
	
	
	
	//---------------------- tool --------------------------

	function update_promo_status(){
		$hari= date("Y-m-d");		
		
		//Set Publish
		$publish = $this->promotion_m->get_promo_by('id, status', array('publish'=>$hari), false);
		foreach ($publish as $pub){
			$this->promotion_m->update($pub->id, array('status'=>'published'));
		}
		
		//Set Archived
		$archived = $this->promotion_m->get_promo_by('id, status', array('ended < ' => $hari, 'ended !=' => '0000-00-00'), false);
		foreach ($archived as $arc){
			$this->promotion_m->update($arc->id, array('status'=>'archived'));
		}
	}
	
	
	public function do_upload(){
		
		$promo_data = $this->input->post('form_data');

		if($promo_data['poster_id'] != ''){
			if(Files::delete_file($promo_data['poster_id'])){
				$this->promotion_m->update($promo_data['id'], array('poster'=>''));
			}
		}
		
		$folder_id = $this->file_folders_m->get_by('slug', 'promotion')->id;
		
		$result = Files::upload($folder_id, $promo_data['slug'], 'poster', 1920, false, true);
		
		//if($result['status']){
		$file_data = $this->parse_file_data($result['data']);
		$this->promotion_m->update($promo_data['id'], array('poster'=>$file_data));
		//}
		
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
	
	
	function poster_crop($image, $w, $h){
		$config = array(
				'source_image' => $image['file'],
				'maintain_ratio' => FALSE,
				'width' => $w,
				'height' => $h,
				'new_image' => $image['path'] . 'med-' . $image['name']	. 'jpg'
			);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->crop();
	}
	
}