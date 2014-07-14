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
	protected $ch_data;	protected $logo_path;
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
		$this->page_data = new stdClass();		$this->logo_path = $this->module_details['path'] . '/upload/logo';		
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
		$all_channels = $this->epg_ch_m->order_by('cat', 'ASC')->order_by('is_active','DESC')->limit($pagination['limit'], $pagination['offset'])->get_all_channel();
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
	}			public function do_upload($rename){		//Upload image config		$var = '';		$this->upload_config = array(			'allowed_types' => 'jpg|jpeg|png',			'upload_path' => $this->logo_path,			'max_size' => 100,			'overwrite' => true,			'file_name' => $rename,		);		
		$this->load->library('upload');
		$this->load->library('image_lib');				$this->upload->initialize($this->upload_config);		if($this->upload->do_upload('poster')){			$upload_data = $this->upload->data();			$var = $upload_data['file_name'];			$image_width = $upload_data['image_width'];			$image_height = $upload_data['image_height'];			$axis_x = 0;			$axis_y = 0;			if($image_width > 240){				$axis_x = ($image_width - 240)/2;			}			if($image_height > 240){				$axis_y = ($image_height - 240)/2;			}			// Resize			$resize_config = array(				'source_image' => $upload_data['full_path'],				'maintain_ration' => true,				'width' => 240,				'height' =>240,				'master_dim' => 'auto',			);						$this->image_lib->clear();			$this->image_lib->initialize($resize_config);			if ($this->image_lib->resize())			{				$crop_config = array(					'source_image' => $upload_data['full_path'],					'new_image' => $this->img_path . '/square',					'x_axis' => $axis_x,					'y_axis' => 0,					'width' => 240,					'height' => 240,					'maintain_ratio' => false                                   				);				$this->image_lib->clear();				$this->image_lib->initialize($crop_config);				if (!$this->image_lib->crop())				{					echo $this->image_lib->display_errors();				}			}else{				echo $this->image_lib->display_errors();			}		}else{			$upload_data = $this->upload->display_errors();		}		return $var;	}
}
