<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
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
	protected $sh_cat = array();
	protected $ch_data;
	protected $upload_config;

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('epg_sh_m');
		$this->load->model('epg_sh_cat_m');
		$this->load->model('epg_ch_m');
		
		//variables
		$this->sh_data = new stdClass();
		$this->ch_data = new stdClass();
		$this->page_data = new stdClass();
		
		$temp = $this->epg_sh_cat_m->get_categories();
		foreach ($temp as $t){
			$this->sh_cat[$t->id] = $t->cat;
		}
		
		$this->page_data->section = $this->section;
		$this->page_data->editor_type = 'wysiwyg-simple';
		
		$this->img_path = $this->module_details['path'] . '/upload/shows';
		
		//Library
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('image_lib');
		$this->load->library('alcopolis');
		
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
			->append_css('module::style.css')
			->set($var)
			->build($view);
	}
	
	
	public function index()
	{
		
		// get channel
		$temp = $this->epg_ch_m->get_all_channel();
		$ch[0] = 'Select';
		foreach($temp as $v){
			$ch[$v->id] = $v->name;
		}
		
		
		//if($this->input->post() != NULL){
		if($this->form_validation->run()){
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
			$this->sh_data = $this->epg_sh_m->featured_list();				
			$this->render('admin/shows', array('page'=>$this->page_data, 'ch'=>$ch, 'sh'=>$this->sh_data, 'sh_cat'=>$this->sh_cat));
		}
	}

	
	public function edit($id){
		$this->page_data->title = 'Edit Show';
				
		$this->sh_data = $this->epg_sh_m->get_show_by(NULL, array('id'=>$id), TRUE);
		$title = $this->sh_data->title;
		$cid = $this->sh_data->cid;
		$date = $this->sh_data->date;
		
		$similar = $this->epg_sh_m->similar_show(array('title'=>$title, 'cid'=>$cid, 'date>'=>$date), 'id, date, time, duration');
		
		$this->ch_data = $this->epg_ch_m->get_channel($cid);

		
		if($this->form_validation->run()){
			//Process form
			$input_post = array();
			
			$data = $this->alcopolis->array_from_post(array('title', 'is_featured', 'cat_id', 'syn_id', 'syn_en', 'trailer'), $this->input->post());
			
			if($this->sh_data->poster != ''){	
				$data['poster'] = $this->sh_data->poster;
			}else{
				$img_name = $this->poster_upload($this->sh_data->id);
				if($img_name != NULL){
					$data['poster'] = $img_name;
				}
			}
			
			if($this->epg_sh_m->update_show($this->sh_data->title, $data)){
				if($this->input->post('btnAction') == 'save_exit'){
					redirect('admin/epg/shows');
				}else{
					$this->sh_data = $this->epg_sh_m->get_show_by(NULL, array('id'=>$id), TRUE);	
					$title = $this->sh_data->title;
					$cid = $this->sh_data->cid;
					$date = $this->sh_data->date;
					$similar = $this->epg_sh_m->similar_show(array('title'=>$title, 'cid'=>$cid, 'date>'=>$date), 'id, date, time, duration');
										
					$this->render('admin/show_form', array('page'=>$this->page_data, 'sh'=>$this->sh_data, 'ch'=>$this->ch_data, 'similar'=>$similar, 'sh_cat'=>$this->sh_cat));
				}
			}
		}else{
			//load form				
			$this->render('admin/show_form', array('page'=>$this->page_data, 'sh'=>$this->sh_data, 'ch'=>$this->ch_data, 'similar'=>$similar, 'sh_cat'=>$this->sh_cat));
		}
	}
	
	
	function poster_upload($rename){
		//Upload image config
		
		$var = '';
		
		$this->upload_config = array(
			'allowed_types' => 'jpg|jpeg|png',
			'upload_path' => $this->img_path,
			'max_size' => 1024,
			'overwrite' => true,
			'file_name' => $rename,
		);
		
		$this->upload->initialize($this->upload_config);
		
		if($this->upload->do_upload('poster')){
		
			$upload_data = $this->upload->data();
			
			$var = $upload_data['file_name'];
			$image_width = $upload_data['image_width'];
			$image_height = $upload_data['image_height'];
			
			
			$axis_x = 0;
			$axis_y = 0;
		
			if($image_width > 500){
				$axis_x = ($image_width - 500)/2;
			}
			if($image_height > 500){
				$axis_y = ($image_height - 500)/2;
			}
		
			// Resize
			$resize_config = array(
				'source_image' => $upload_data['full_path'],
				'maintain_ration' => true,
				'width' => 1600,
				'height' =>1200,
				'master_dim' => 'auto',
			);
		
			$this->image_lib->clear();
			$this->image_lib->initialize($resize_config);
		
			if ($this->image_lib->resize())
			{
				$crop_config = array(
					'source_image' => $upload_data['full_path'],
					'new_image' => $this->img_path . '/square',
					'x_axis' => $axis_x,
					'y_axis' => 0,
					'width' => 500,
					'height' => 500,
					'maintain_ratio' => false
				);
		
				$this->image_lib->clear();
				$this->image_lib->initialize($crop_config);
		
				if (!$this->image_lib->crop())
				{
					echo $this->image_lib->display_errors();
				}
			}else{
				echo $this->image_lib->display_errors();
			}
		}else{
			$upload_data = $this->upload->display_errors();
		}
		
		return $var;
	}
	
	
	public function delete($id = 0){echo $id;}
}
