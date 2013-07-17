<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Pages controller
 *
 * @author 		PyroCMS Dev Team
 * @package 	PyroCMS\Core\Modules\Products\Controllers
 */
class Admin extends Admin_Controller {
	
	protected $section = 'promotion';
	protected $rules = array();
	
	protected $page_data;
	protected $user_data;
	protected $promo_data;
	protected $cat_data;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('promotion_m');
		$this->load->model('category_m');
		
		$this->page_data = new stdClass();
		$this->user_data = new stdClass();
		$this->promo_data = new stdClass();
		$this->cat_data = new stdClass();
		
		$this->page_data->section = $this->section;
		$this->page_data->editor_type = 'wysiwyg-advanced';
		
		$this->user_data->id = $this->current_user->id;
		$this->user_data->name = $this->current_user->username;
		$this->user_data->role = $this->session->userdata('group');
	}
	
	
	
	function render($view){
		$this->template
		->title($this->module_details['name'])
		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
//		->append_js('module::product_form.js')
		->set('page', $this->page_data)
		->set('promos', $this->promo_data)
		->set('cats', $this->cat_data)
		->build($view);
	}
	
	
	
	public function index(){
		//Update promo status based on publish date
		$this->update_promo_status();
		
		//Get data
		$this->promo_data = $this->promotion_m->get_promo();
		$this->cat_data = $this->category_m->get_categories();
		
		$this->render('admin/index');
	}
	
	public function create()
	{
		
	}
	
	public function edit($id)
	{
		$this->page_data->title = 'Edit Promotion';
		$this->page_data->action = 'edit';
		
		$this->cat_data = $this->category_m->get_categories();
		
		if($this->form_validation->run()){
			
		}else{			
			$this->promo_data = $this->promotion_m->get($id);
			$this->render('admin/promo_form');
		}
	}
	
	
	
	function update_promo_status(){
		$hari= date("Y-m-d");		
		
		//Set Publish
		$publish = $this->promotion_m->get_promo_by('id, status', array('publish'=>$hari), false);
		foreach ($publish as $pub){
			$this->promotion_m->update($pub->id, array('status'=>'publish'));
		}
		
		//Set Archived
		$archived = $this->promotion_m->get_promo_by('id, status', array('ended < ' => $hari, 'ended !=' => '0000-00-00'), false);
		foreach ($archived as $arc){
			$this->promotion_m->update($arc->id, array('status'=>'archived'));
		}
	}
	
}