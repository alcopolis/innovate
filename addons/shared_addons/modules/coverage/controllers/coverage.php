<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * EPG Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	EPG Module
 */

class Coverage extends Public_Controller
{
	protected $section = 'items';

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('coverage_m');
		
	}

	
	function render($view, $var = NULL){		
		$this->template
			->title($this->module_details['name'])
			->append_js('module::main.js')
			//->append_css('module::style.css')
			->set($var)
			->build($view);
	}
	
	
	public function index()
	{
		$cities = $this->coverage_m->get_city();	
		$this->render('index', array('cities'=>$cities));
	}
	
	public function get_area($city){
		$area = $this->coverage_m->get_area($city);	
		
		$data = '<ul>';
		foreach($area as $a){
			$data .= '<li>' . $a . '</li>';
		}
		$data .= '</ul>';
		
		$respond['data'] = $data;
		
		echo json_encode($respond);
	}
	
	
}
