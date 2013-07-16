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
	protected $img_path;
	protected $page_data;
	protected $sh_data;
	protected $upload_config;

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('epg_sh_m');
		$this->load->model('epg_ch_m');
		
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library('alcopolis');
		
		$this->lang->load('epg');
		
		//variables
		$this->sh_data = new stdClass();
		$this->page_data = new stdClass();
		
		$this->page_data->section = $this->section;
		$this->page_data->editor_type = 'wysiwyg-simple';
		
		$this->img_path = $this->module_details['path'] . '/upload/shows';
		
		// Set validation rules
		$this->form_validation->set_rules($this->epg_sh_m->rules);
	}

	
	/**
	 * List all items
	 */
	
	function render($view, $var = NULL){		
		$this->template
			->title($this->module_details['name'])
			->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
			->append_js('module::main.js')
			->set($var)
			->build($view);
	}
	
	
	public function index()
	{
		
	   	// get category
	   	$temp = $this->epg_ch_m->get_categories();
	   	foreach($temp as $v){
	   		$cat[$v->id] = $v->cat; 
	  	}
	   
	   	// get channel
	   	$temp = $this->epg_ch_m->get_all_channel();
	   
		$ch[0] = 'Select';
		foreach($temp as $v){
		    $ch[$v->id] = $v->name;
		}		
		
		if($this->input->post() != NULL){
			$this->page_data->view = 'filter';
			
			$post_input = $this->alcopolis->array_from_post(array('cid', 'date', 'title'), $this->input->post());
			
			$cond = array();
			foreach($post_input as $key=>$val){
				if($key != 'title' && ($val != NULL || $val != '')){
					$cond[$key] = $val;
				}elseif($key == 'title' && $val != ''){
					$this->epg_sh_m->like('title', $val, 'both');
				}
			}

			$this->sh_data = $this->epg_sh_m->get_show_by(NULL, $cond, FALSE);
			$ch_info = $this->epg_ch_m->get_channel($post_input['cid']);
			$this->render('admin/shows', array('page'=>$this->page_data, 'ch'=>$ch, 'sh'=>$this->sh_data, 'ch_info'=>$ch_info));
			
		}else{
			
			$this->page_data->view = 'featured';
			
			$this->db->select('t0.id, t0.title, t0.date, t0.time, t0.duration, t1.name');
			$this->db->from('inn_epg_show_detail t0');
			$this->db->join('inn_epg_ch_detail t1', 't1.id = t0.cid', 'LEFT');
			$this->db->where(array('t0.date>='=>date('Y-m-d'),'t0.is_featured'=> 1));
			$this->sh_data = $this->db->get()->result();
			
			$this->render('admin/shows', array('page'=>$this->page_data, 'ch'=>$ch, 'sh'=>$this->sh_data));
		}
	}

	
	public function edit($id){

		$this->page_data->title = 'Edit Show';
		
		$this->sh_data = $this->epg_sh_m->get_show_by(NULL, array('id'=>$id), TRUE);
		
		
		if($this->form_validation->run()){
			//Process form			
			$data = $this->alcopolis->array_from_post(array('is_featured', 'syn_id', 'syn_en'), $this->input->post());
			
			$this->poster_upload($this->sh_data->id);
			
			if($this->epg_sh_m->update_show($id, $data)){
				redirect('admin/epg/shows');
			}else{
				$this->render('admin/show_form', array('page'=>$this->page_data, 'sh'=>$this->sh_data));
			}
	
		}else{
	
			//Load Form
			$this->render('admin/show_form', array('page'=>$this->page_data, 'sh'=>$this->sh_data));
		}
	}
	
	
	function poster_upload($rename){
		//Upload image config
		$this->upload_config = array(
				'allowed_types' => 'jpg|jpeg|png',
				'upload_path' => $this->img_path,
				'max_width' => 1920,
				'max_size' => 2048,
				'overwrite' => true,
				'file_name' => $rename,
		);
			
		$this->upload->initialize($this->upload_config);
		
		if($this->upload->do_upload('poster')){
			$upload_data = $this->upload->data();
			
			$resize_config = array(
					'source_image' => $upload_data['full_path'],
					'new_image' => $this->img_path . '/thumbs',
					'maintain_ration' => true,
					'width' => 300,
					'height' => 150,
					'master_dim' => 'auto',
			);
			
			$this->image_lib->clear();
			$this->image_lib->initialize($resize_config);
			
			if (!$this->image_lib->resize())
			{
			    echo $this->image_lib->display_errors();
			}
		}else{
			$upload_data = $this->upload->display_errors();
		}
	}
	
	
	
	
	public function delete($id = 0){echo $id;}

}
