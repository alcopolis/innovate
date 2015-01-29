<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Pages controller
 *
 * @author 		PyroCMS Dev Team
 * @package 	PyroCMS\Core\Modules\Products\Controllers
 */
class Promotion extends Public_Controller {
	
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
		$temp = $this->category_m->get_category('', TRUE);
		foreach($temp as $key=>$val){
			$this->cat_data[$key] = $val->cat;
		}
	}
	
	
	
	function render($view, $data=NULL){
		$this->template
		->title($this->module_details['name'])
		->append_js('module::main.js')
		->append_js('module::promo_form.js')
		->append_css('module::style_front.css')
		->set('page', $this->page_data)
		->set('promos', $this->promo_data)
		->set('poster', json_decode($data->poster))
		->set('cats', $this->cat_data)
		->set('data', $data)
		->build($view);
	}
	
	public function index(){
		redirect('/');
	}
	
	public function view($slug=NULL){
		if($slug!= NULL){
			$data = $this->promotion_m->get_promo_by('', array('slug'=>$slug), TRUE);
			$this->render('promo-view', $data);
		}else{
			redirect('/');
		}
	}
	
	
	private function _get_promo_list(){
		return $this->promotion_m->get_promo_by('', array('cat'=>0, 'status'=>'published'), FALSE);
	}
}