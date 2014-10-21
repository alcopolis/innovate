<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**

 * Subscriber Module

 *

 * @author 		Adriant Rivano

 * @website		adriantrivano.com

 * @package 	PyroCMS

 * @subpackage 	Subscriber Module

 */



class Admin_Useractivity extends Admin_Controller
{
	protected $section = 'useractivity';
	//protected $page_data;
	protected $ac_data;
	
	protected $username;

	public function __construct()
	{
		parent::__construct();

		$this->load->model('quiz_user_activity_m');
		//$this->load->model('users/user_m');	
		
		//$this->load->library('form_validation');
		$this->load->library('alcopolis');


		//variables
		$this->ac_data = new stdClass();
		/*$this->page_data = new stdClass();
		
		$this->page_data->section = $this->section;
		$this->page_data->editor_type = 'html';*/

		
		// Set validation rules
//$this->form_validation->set_rules($this->quiz_user_activity_m->rules);
	}



	function render($view, $var = NULL){
		/*$this->template
		->title($this->module_details['name'])
		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
		->append_js('module::channel_form.js')
		->set('module_path', $this->module_details['path'])
		->set($var)
		->build($view);*/
		
		$this->template
		->set($var)
		->build($view);
	}

	

	public function index()
	{	
		//$pagination = create_pagination('admin/quiz/user_activity/index, 20,5');
		//$this->quiz_user_activity_m->order_by('username', 'ASC')->order_by('point','DESC')->limit($pagination['limit'], $pagination['offset'])->get_all_useractivity();
		
		$all_useractivity = $this->quiz_user_activity_m->order_by('username', 'ASC')->order_by('point','DESC')->get_all_useractivity();
		
		//var_dump ($this->quiz_user_activity_m->order_by('username', 'ASC')->order_by('point','DESC')->get_all_useractivity());
		
		//$this->render('user_activity' /*array('pagination'=> $pagination, 'answers'=>$all_answers)*/);
		
		$this->render('admin/user_activity', array('user_activity' => $all_useractivity));
	}

		

/*	public function create(){
		$this->page_data->title = 'Add Channel';
		$this->page_data->action = 'create';

		$temp = $this->epg_ch_m->select('cat')->get_categories();
	
		foreach($temp as $key=>$cat){
			$this->ch_data->categories[] = $cat->cat;
		}


		if($this->form_validation->run()){
			// Insert data
			$data = $this->alcopolis->array_from_post(array('name', 'num', 'cat', 'desc'), $this->input->post());
			
			$data['slug'] = str_replace(' ', '-', strtolower($data['name']));
			
			if($this->epg_ch_m->add_channel($data)){
				if($this->input->post('btnAction') == 'save_exit'){
					redirect('admin/epg/channels');
				}
			}
		}
		
		$this->render('admin/channel_form');
	}*/


	public function edit($id){
		$this->page_data->title = 'Edit User Activity';
		$this->page_data->action = 'edit';
		
		if($this->form_validation->run()){
			//Process form
			$data = $this->alcopolis->array_from_post(array('username', 'answers', 'point'), $this->input->post());
				
			$data['slug'] = str_replace(' ', '-', strtolower($data['username']));
				
			if($this->quiz_user_activity_m->update_useractivity($id, $data)){
				if($this->input->post('btnAction') == 'save_exit'){
					redirect('admin/quiz/user_activity');
				}
			}
		}
	}

	public function info($id){
		
		$this->ac_data = $this->quiz_user_activity_m->get_useractivity($id);
		
		$this->render('admin/info', array('info'=>$this->ac_data));
	}
	
	
	/*	//Load Form
		$this->ac_data = $this->quiz_user_activity_m->get_useractivity($id);
		$temp = $this->quiz_user_activity_m->select('username')->get_username();
	
		foreach($temp as $key=>$uname){
			$this->ac_data->username[] = $uname->uname;
		}
	
		$this->render('admin/useractivity_form', array('page'=>$this->page_data, 'ac'=>$this->ac_data));*/
			
}

