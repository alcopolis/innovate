<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Subscriber Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */

class Admin_Channels extends Admin_Controller
{
	protected $section = 'channels';
	
	protected $page_data;
	protected $ch_data;

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('epg_ch_m');
		$this->load->library('form_validation');
		$this->load->library('alcopolis');
		$this->lang->load('epg');
		
		//variables
		$this->ch_data = new stdClass();
		$this->page_data = new stdClass();
		
		$this->page_data->section = $this->section;
		$this->page_data->editor_type = 'html';
		
		// Set validation rules
		$this->form_validation->set_rules($this->epg_ch_m->rules);
	}


	function render($view, $var = NULL){
		$this->template
		->title($this->module_details['name'])
		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
		->append_js('module::channel_form.js')
		->set($var)
		->build($view);
	}
	
	
	public function index()
	{				
		$pagination = create_pagination('admin/epg/channels/index', $this->epg_ch_m->count_channel(), 20,5);
		$all_channels = $this->epg_ch_m->order_by('is_active','DESC')->limit($pagination['limit'], $pagination['offset'])->get_all_channel();

		$this->render('admin/channels', array('pagination'=>$pagination, 'channels'=>$all_channels));
	}
	
	
	public function create(){
		$this->page_data->title = 'Add Channel';
		$this->page_data->action = 'create';
		
		$temp = $this->epg_ch_m->select('cat')->get_categories();
		
		foreach($temp as $key=>$cat){
			$this->ch_data->categories[] = $cat->cat;
		}
			
		
		if($this->form_validation->run()){
			// Insert data
			$data = $this->alcopolis->array_from_post(array('name', 'num', 'cat', 'desc'), $this->input->post());
			
			if($this->epg_ch_m->add_channel($data)){
				redirect('admin/epg/channels');
			}else{
				echo 'error';
				$this->render('admin/channel_form');
			}
		}else{
			$this->render('admin/channel_form');
		}
	}
	
	
	public function edit($id){
		$this->page_data->title = 'Edit Channel';
		$this->page_data->action = 'edit';
		
		if($this->form_validation->run()){
			
			//Process form		
			$data = $this->alcopolis->array_from_post(array('name', 'num', 'cat', 'desc', 'is_active'), $this->input->post());

			if($this->epg_ch_m->update_channel($id, $data)){
				redirect('admin/epg/channels');
			}else{
				$this->render('admin/channel_form', array('page'=>$this->page_data, 'ch'=>$this->ch_data));
			}
			
		}else{
			
			//Load Form
			$this->ch_data = $this->epg_ch_m->get_channel($id);
			$temp = $this->epg_ch_m->select('cat')->get_categories();
			
			foreach($temp as $key=>$cat){
				$this->ch_data->categories[] = $cat->cat;
			}
			
			$this->render('admin/channel_form', array('page'=>$this->page_data, 'ch'=>$this->ch_data));
		}
	}
}
