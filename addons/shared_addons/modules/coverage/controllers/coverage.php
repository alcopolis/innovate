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
		if ($this->input->is_ajax_request()) {
	 		$limit = 10;
			
			//Variabel setup
			$city = $this->input->get('city');
			$page = $this->input->get('page');
			
			//Count query result
			$this->db->select('area');
			$this->db->where(array('city'=>$city));
			$this->db->from('inn_coverage');
			$query = $this->db->get();
					
			$count = $query->num_rows();
			$respond['numdata'] = $count;
			
			//Pagination setup
			$total_pages = floor($count);
			$offset = --$page * $limit;
			$respond['pageTotal'] = ceil($count/$limit);
					
			//Get area data
			$area = $this->coverage_m->get_area($city, $limit, $offset);	
			$respond['data'] = $area;
			
			//Return json
			echo json_encode($respond);
		}else{
			redirect('coverage');
		}
	}
	
	
}
