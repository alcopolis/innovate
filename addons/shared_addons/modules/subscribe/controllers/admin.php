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
	

	/**
	 * List all items
	 */
	public function index()
	{
// 		$this->filter =  new stdClass();
		
// 		if($this->input->post() == NULL){
			
// 			$this->filter->search_key = '';
// 			$this->filter->search_term = '';
// 			$this->filter->status = '';
// 			$this->filter->sort = '';
				
// 			$this->subscribe_m->order_by('date', 'desc');
			
// 		}else{
// 			if($this->input->post('status') != 'no_entry'){
// 				$this->subscribe_m->where(array('closing_flag'=>$this->input->post('status')));
// 			}
				
// 			if($this->input->post('search_key') != 'no_entry' && $this->input->post('search_term') != ''){
			
// 				//if search by date, reformat date input into mysql format
// 				if($this->input->post('search_key') == 'date'){
// 					$d = strtotime($this->input->post('search_term'));
// 					$this->subscribe_m->like($this->input->post('search_key'), date('Y-m-d', $d), 'both');
// 				}else{
// 					$this->subscribe_m->like($this->input->post('search_key'), $this->input->post('search_term'), 'both');
// 				}
// 			}
				
// 			if($this->input->post('sort') != 'no_entry'){
// 				$this->subscribe_m->order_by($this->input->post('sort'), 'asc');
// 			}
				
// 			$this->filter->search_key = $this->input->post('search_key');
// 			$this->filter->search_term = $this->input->post('search_term');
// 			$this->filter->status = $this->input->post('status');
// 			$this->filter->sort = $this->input->post('sort');
// 		}

		
// 	 	$this->subscribes_data = $this->subscribe_m->get_all();
// 	 	$this->render('admin/index');

		
		
		$limit = 30;
		$pagination = create_pagination('admin/subscribe/index', $this->db->count_all('inn_subscribe'), $limit);
		
		$this->filter =  new stdClass();
		
		if($this->input->post() == NULL){
				
			$this->filter->search_key = '';
			$this->filter->search_term = '';
			$this->filter->status = '';
			$this->filter->sort = '';
		
			$this->subscribe_m->order_by('date', 'desc');
				
		}else{
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
		}
		
		
		$this->subscribes_data = $this->subscribe_m->limit($pagination['limit'], $pagination['offset'])->get_subscriber();
		$this->render('admin/index', array('pagination' => $pagination));
	}
	

	public function change_status(){
		$sid = $this->input->get('id');
		$val = $this->input->get('val');
		
		if($this->db->update('default_inn_subscribe', array('closing_flag' => $val), "id = " . $sid)){
			$respond = array();
			
			if($val == '2' || $val == '3'){
				$respond['lock'] = true;
				$respond['val'] = $val;
			}else{
				$respond['lock'] = false;
			}
		}
		
		echo json_encode($respond);
	}
	
	public function do_save(){
		
		//Get subscriber data from database		
		$fields = 'name, address, area_code, phone, mobile, email, packages, closing_flag, date';
		$where = NULL;
		
		if($this->input->post() == NULL){
				
			$this->subscribe_m->order_by('date', 'desc');
			$data = $this->subscribe_m->get_subscriber($fields);
			
		}else{
			
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
			
			if($this->input->post('status') != 'no_entry'){
				$where = array('closing_flag'=>$this->input->post('status'));
				$data = $this->subscribe_m->get_subscriber_by($fields, $where);
			}else{
				$data = $this->subscribe_m->get_subscriber($fields);
			}
		}
		
		
		
	//Process sql data into Excel format 
		$sheet = $this->phpexcel->getActiveSheet();
		$filename = 'Subscriber-' . time();
		
		//Metadata & Properties
		$this->phpexcel->getProperties()->setCreator('Innovate Admin');		
		$this->phpexcel->getProperties()->setTitle($filename);
		
		//Header
		$sheet->setCellValue('A1', 'NAME');
		$sheet->setCellValue('B1', 'ADDRESS');
		$sheet->setCellValue('C1', 'AREA CODE');
		$sheet->setCellValue('D1', 'PHONE NUMBER');
		$sheet->setCellValue('E1', 'MOBILE PHONE');
		$sheet->setCellValue('F1', 'EMAIL');
		$sheet->setCellValue('G1', 'PACKAGES');
		$sheet->setCellValue('H1', 'STATUS');
		$sheet->setCellValue('I1', 'SUBSCRIBE DATE');
		
		
		
		//Cell Formatting
		$sheet->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF33CCFF');
		$sheet->getStyle('A1:I1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
		$sheet->getStyle('A1:I1')->getFont()->setBold(true);
		
		$sheet->getRowDimension('1')->setRowHeight(40);
		$sheet->getStyle('A1:I1')->getAlignment()->setWrapText(true);
		$sheet->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$sheet->getStyle('A1:I1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setWidth(60);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setWidth(60);
		$sheet->getColumnDimension('G')->setAutoSize(true);
		$sheet->getColumnDimension('H')->setAutoSize(true);
		$sheet->getColumnDimension('I')->setAutoSize(true);
		
		
		
		//Set cell value
		$row_num = 2;
				
		foreach($data as $row){
						
			$c = 0;
			
			$status = '';
			foreach($row as $key=>$val){
				if($key == 'closing_flag'){
					switch($val){
						case '0': $status = 'Open'; break;
						case '1': $status = 'On Progress'; break;
						case '2': $status = 'Closed'; break;
					}
					$sheet->setCellValueExplicitByColumnAndRow($c, $row_num, $status, PHPExcel_Cell_DataType::TYPE_STRING);
				}else{
					$sheet->setCellValueExplicitByColumnAndRow($c, $row_num, $val, PHPExcel_Cell_DataType::TYPE_STRING);
				}
				
				
				$currCell = $sheet->getCellByColumnAndRow($c, $row_num);
				
				if($c == 1){
					$currCell->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
				}else{
					$currCell->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				}
				
				$currCell->getStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$sheet->getRowDimension($row_num)->setRowHeight(25);
				
				$c++;
			}
			
			$row_num++;
		}
				
		
		//Save data and send download link via ajax
		$writer = new PHPExcel_Writer_Excel2007($this->phpexcel);
		header('Content-type: application/vnd.ms-excel');	
		
		$file = 'temp/' . $filename . '.xlsx';
		$writer->save($file);
		
		$response = array(
					'status' => 'true',
					'url' => $this->config->base_url() . $file
				);
		
		echo json_encode($response);
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
