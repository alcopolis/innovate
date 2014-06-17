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
	protected $logo_whSize = 240;
	protected $sh_file_path;
	protected $ch_file_path;

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
		$this->ch_file_path = UPLOAD_PATH .'modules/epg/channels/';
		$this->sh_file_path = UPLOAD_PATH .'modules/epg/shows/';
		
		$this->page_data->section = $this->section;
		$this->page_data->editor_type = 'html';
		
		// Set validation rules
		$this->form_validation->set_rules($this->epg_ch_m->rules);
	}


	function render($view, $var = NULL){
		$this->template
		->title($this->module_details['name'])
		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
		->append_css('module::style.css')
		->append_js('module::channel_form.js')
		->set('notif', $this->session->flashdata('notif'))
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
		
		
		$this->ch_data = $this->epg_ch_m->get_channel($id);
		
		if($this->form_validation->run()){
			
			//Process form
			$data = $this->alcopolis->array_from_post(array('name', 'num', 'cat', 'desc', 'is_active', 'hd'), $this->input->post());
			
			//Upload logo file
			if($_FILES['logo']['name'] != ''){
				$upload_result;
				
				if($this->ch_data->logo != ''){
					$upload_result = $this->_upload($this->input->post(), TRUE, $this->ch_data->logo);
				}else{
					$upload_result = $this->_upload($this->input->post(), FALSE);
				}
				
				if($upload_result['status']){
					$data['logo'] = $upload_result['uri'];
				}
				
				
				if($this->epg_ch_m->update_channel($id, $data)){
					if($this->input->post('btnAction') == 'save_exit'){
						redirect('admin/epg/channels');
					}
				}
			}
		}
		
			
		//Load Form
		$temp = $this->epg_ch_m->select('cat')->get_categories();
		
		foreach($temp as $key=>$cat){
			$this->ch_data->categories[] = $cat->cat;
		}
		
		$this->render('admin/channel_form', array('page'=>$this->page_data, 'ch'=>$this->ch_data));
		
	}
	
	
	
	
	//===============================================================================================================================
	
	private function _upload($post_data, $replace = TRUE, $file_path = NULL){
		$upload_data;
		
		//Replace action = TRUE
		if(isset($file_path)){
			if($replace){
				unlink($file_path);
			}
		}
		
		$upload_config = array(
				'upload_path'	=> $this->ch_file_path,
				'file_name'	=> str_replace(' ', '-', strtolower($post_data['name'])),
				'allowed_types'   => 'jpg|jpeg|png',
		);
		
		$this->load->library('upload', $upload_config);
		
		if ($this->upload->do_upload('logo')){
			$file = $this->upload->data();

			$upload_data = array(
					'status' => TRUE,
					'uri'	=> $this->ch_file_path . $file['file_name']
			);
			
			
			//Resize if necessary			
			
			if($file['image_width'] > $this->logo_whSize || $file['image_height'] > $this->logo_whSize){
				$this->load->library('image_lib');
				
				$config['image_library']    = 'gd2';
				$config['source_image']     = $file['full_path'];
//				$config['new_image']        = $file['full_path'];
				$config['maintain_ratio']   = TRUE;
				$config['master_dim']		= 'auto';
				$config['width']            = $this->logo_whSize;
				$config['height']           = $this->logo_whSize;
				
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
			}
			
			
			$this->session->set_flashdata('notif', 'Logo Updated');
		}else{
			$upload_data = array(
					'status' => FALSE,
					'msg' => $this->upload->display_errors()
				);
			
			$this->session->set_flashdata('notif', $this->upload->display_errors());
		}
			
		return $upload_data;
	}
	
	
	private function _replace_logo($id){
		echo 'replace function here';
	}
}
