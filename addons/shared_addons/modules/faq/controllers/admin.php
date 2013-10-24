<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Subscriber Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */

class Admin extends Admin_Controller
{
	protected $section = 'faq';
	protected $rules = array();
	
	protected $page_data;
	
	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('subscribe_m');
		$this->load->library('form_validation');
		$this->load->library('phpexcel/PHPExcel');
		$this->load->library('files/files');
		$this->load->model('files/file_folders_m');
		
		// Set our validation rules
		$this->rules = $this->subscribe_m->_rules;
		$this->form_validation->set_rules($this->rules);
	}
	
	
	
	function render($view, $var){
		$this->template
		->title($this->module_details['name'])
//		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
		->append_js('module::subscribe-admin.js')
		->set('subscribes', $this->subscribes_data)
		->set('filter', $this->filter)
		->set($var)
		->build($view);
	}
	
}
