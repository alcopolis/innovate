<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */

class Admin_Upload extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('epg_sh_m');
		$this->load->model('epg_sh_cat_m');
		$this->load->model('epg_ch_m');
		
		//Library
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('alcopolis');
		
		// Set validation rules
		$this->form_validation->set_rules($this->epg_sh_m->rules);
	}
	
	
	public function index()
	{
		$this->template
		->title($this->module_details['name'])
		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
		->append_js('module::main.js')
		->append_css('module::style.css')
		->build('admin/upload_form');
	}

	
}
