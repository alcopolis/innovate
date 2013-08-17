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
	protected $section = 'subscribe';
	protected $rules = array();
	
	protected $page_data;
	protected $subscribes_data;
	protected $filter;
	protected $query_data;

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('subscribe_m');
		$this->load->library('form_validation');
		
		// Set our validation rules
		$this->rules = $this->subscribe_m->_rules;
		$this->form_validation->set_rules($this->rules);
	}
	
	
	
	function render($view){
		$this->template
		->title($this->module_details['name'])
		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
//		->append_js('module::product_form.js')
		->set('subscribes', $this->subscribes_data)
		->set('filter', $this->filter)
		->build($view);
	}
	

	/**
	 * List all items
	 */
	public function index()
	{
		$this->filter =  new stdClass();
		
		
		if($this->input->post() != NULL){
			if($this->input->post('status') != 'no_entry'){
				$this->subscribe_m->where(array('closing_flag'=>$this->input->post('status')));
			}
			
			if($this->input->post('search_key') != 'no_entry' && $this->input->post('search_term') != ''){

				//if search by date, reformat date input into mysql format
				if($this->input->post('search_key') == 'date'){
 					$d = strtotime($this->input->post('search_term'));
					$this->subscribe_m->like($this->input->post('search_key'), date('Y-m-d', $d), 'both');
				}else{
					$this->subscribe_m->like($this->input->post('search_key'), $this->input->post('search_term'), 'both');	
				}			
			}
			
			if($this->input->post('sort') != 'no_entry'){
				$this->subscribe_m->order_by($this->input->post('sort'), 'asc');
			}
			
			$this->filter->search_key = $this->input->post('search_key');
			$this->filter->search_term = $this->input->post('search_term');
			$this->filter->status = $this->input->post('status');
			$this->filter->sort = $this->input->post('sort');
		}else{
			$this->filter->search_key = '';
			$this->filter->search_term = '';
			$this->filter->status = '';
			$this->filter->sort = '';
			
			$this->subscribe_m->order_by('date', 'desc');
		}
		
		$this->subscribes_data = $this->subscribe_m->get_all();
		$this->query_data = $this->subscribes_data;
		$this->render('admin/index');
	}

	
	
	public function savecsv($input){
		 $this->load->library('phpexcel/PHPExcel');

		$sheet = $this->phpexcel->getActiveSheet();
		$sheet->getColumnDimension('A')->setWidth(5);
		$sheet->setCellValue('A1','First Row');
		
		$writer = new PHPExcel_Writer_Excel5($this->phpexcel);
		header('Content-type: application/vnd.ms-excel');
		$writer->save('php://output');  
	}
	
// 	public function delete($id = 0)
// 	{
// 		echo $id;
		
// 		// make sure the button was clicked and that there is an array of ids
// 		if (isset($_POST['btnAction']) AND is_array($_POST['action_to']))
// 		{
// 			// pass the ids and let MY_Model delete the items
// 			$this->subscriber_m->delete_many($this->input->post('action_to'));
// 		}
// 		elseif (is_numeric($id))
// 		{
// 			// they just clicked the link so we'll delete that one
// 			$this->subscriber_m->delete($id);
// 		}
// 		redirect('admin/subscriber');
// 	}
	
	
}
