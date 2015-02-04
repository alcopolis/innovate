<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */

class Admin_Highlights extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();		$this->load->model('epg_highlights_m');
		//Library
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('alcopolis');
		
		// Set validation rules
		$this->form_validation->set_rules($this->epg_highlights_m->rules);
	}	
	public function index()
	{
		$this->template
		->title($this->module_details['name'])
		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
		->append_js('module::main.js')
		->append_css('module::style.css')
		->build('admin/highlights');
	}	
	public function create(){		echo 'create';		}	
	public function edit($id = NULL){
		echo 'edit ' . $id;		$result = $this->epg_highlights_m->get_by(array('ch_id'=>$id));				var_dump($result);
	}			public function delete($id = NULL){
		echo 'delete ' . $id;
	}
}
