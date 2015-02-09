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
		parent::__construct();		$this->page_data = new stdClass();				$this->load->model('epg/models/epg_highlights_m');		$this->load->model('epg/models/epg_ch_m');
		//Library
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('alcopolis');
		
		// Set validation rules
		$this->form_validation->set_rules($this->epg_highlights_m->rules);
	}	
	private function render($var = NULL, $view = 'admin/highlights')
	{
		$this->template
		->title($this->module_details['name'])
		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
		->append_js('module::main.js')
		->append_css('module::style.css')		->set($var)
		->build($view);
	}		public function index(){		$result = $this->epg_highlights_m->get_all_highlights();		$this->render(array('highlights'=>$result));	}		
	public function create(){		echo 'create';		}	
	public function edit($id = NULL){		$this->page_data->title = 'Edit Highlights';
		$this->page_data->action = 'edit';		$this->page_data->editor_type = 'markdown';				$result = $this->epg_highlights_m->get_highlights_by(array('id'=>$id));		$all_channel = $this->epg_ch_m->get_all_channel(array('is_active'=>1));				$channels = array();		foreach($all_channel as $ch){			$channels[$ch->id] = $ch->name;		}						$this->render(array('hl'=>$result[0], 'channels'=>$channels ,'page'=>$this->page_data), 'admin/highlights_form');
	}			public function delete($id = NULL){
		echo 'delete ' . $id;
	}
}
