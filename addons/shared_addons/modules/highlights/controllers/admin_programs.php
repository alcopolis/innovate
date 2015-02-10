<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */

class Admin_Programs extends Admin_Controller
{	protected $page_data;	
	public function __construct()
	{
		parent::__construct();		$this->page_data = new stdClass();				$this->load->model('hl_programs_m');		$this->load->model('epg/epg_ch_m');
		//Library
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('alcopolis');
		
		// Set validation rules
		$this->form_validation->set_rules($this->hl_programs_m->rules);
	}	
	private function render($var = NULL, $view = 'admin/hl_programs')
	{
		$this->template
		->title($this->module_details['name'])
		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
		//->append_js('module::main.js')
		//->append_css('module::style.css')		->set($var)
		->build($view);
	}		public function index(){		$result = $this->hl_programs_m->get_all_highlights();		$this->render(array('highlights'=>$result));	}		
	public function create(){		echo 'create';		}	
	public function edit($id = NULL){		$this->page_data->title = 'Edit Highlights';
		$this->page_data->action = 'edit';		$this->page_data->editor_type = 'markdown';				$result = $this->hl_programs_m->get_highlights_by(array('id'=>$id));		$all_channel = $this->epg_ch_m->get_all_channel(array('is_active'=>1));				$channels = array();		foreach($all_channel as $ch){			$channels[$ch->id] = $ch->name;		}						$this->render(array('hl'=>$result[0], 'channels'=>$channels ,'page'=>$this->page_data), 'admin/hl_programs_form');
	}			public function delete($id = NULL){
		echo 'delete ' . $id;
	}			// -------------------------------------------------------------------------------------------------------------------- //		public function do_upload(){
	
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
}
