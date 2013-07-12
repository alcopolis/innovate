<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Subscriber Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */

class Admin_Shows extends Admin_Controller
{
	protected $section = 'shows';
	
	protected $page_data;
	protected $ch_data;

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('epg_sh_m');
		$this->load->library('form_validation');
		$this->load->library('alcopolis');
		$this->lang->load('epg');
		
		//variables
		$this->sh_data = new stdClass();
		$this->page_data = new stdClass();
		
		$this->page_data->section = $this->section;
		$this->page_data->editor_type = 'wysiwyg-simple';
		
		// Set validation rules
		$this->form_validation->set_rules($this->epg_sh_m->rules);
	}

	/**
	 * List all items
	 */
	
	function render($view, $var = NULL){
		$this->template
			->title($this->module_details['name'])
			->set($var)
			->build($view);
	}
	
	
	public function index()
	{
		$this->render('admin/shows');
	}
	
	
	public function filter_by($filter = NULL){echo $filter;}
	
	public function update($id = 0){echo $id;}
	
	public function delete($id = 0){echo $id;}
}
