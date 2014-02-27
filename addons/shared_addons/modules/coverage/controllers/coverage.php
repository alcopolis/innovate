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
	
	public function get_area(){
// 		$limit = 10;
// 		$pagination = create_pagination('admin/coverage/get_area', $this->db->count_all('inn_subscribe'), $limit);
		
		
		$city = $this->input->get('city');
		
		$this->db->where(array('city'=>$city));
		$this->db->from('inn_coverage');
 		$count = $this->db->count_all_results();
 		var_dump($count);
		
		
		$area = $this->coverage_m->get_area($city);	
		
		$respond['data'] = $area;
		
		//echo json_encode($respond);
	}
	
	
}
