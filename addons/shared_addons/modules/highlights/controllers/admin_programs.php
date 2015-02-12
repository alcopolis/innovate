<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */

class Admin_Programs extends Admin_Controller
{	protected $page_data;	
	public function __construct()
	{
		parent::__construct();		$this->page_data = new stdClass();				$this->load->model('hl_programs_m');		$this->load->model('epg/epg_ch_m');
		//Library
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('alcopolis');		$this->load->library('files/files');
		
		// Set validation rules
		$this->form_validation->set_rules($this->hl_programs_m->rules);
	}	
	private function render($var = NULL, $view = 'admin/hl_programs')
	{
		$this->template
		->title($this->module_details['name'])
		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
		//->append_js('module::main.js')
		//->append_css('module::style.css')		->set($var)
		->build($view);
	}		public function index(){		$result = $this->hl_programs_m->get_all_highlights();		$this->render(array('highlights'=>$result));	}		
	public function create(){		if($this->form_validation->run()){			$fileupload = $this->upload($id, $this->input->post('title'));
				
			$db_fields = array('ch_id', 'title', 'sinopsis', 'start_date', 'end_date');
			$data = $this->alcopolis->array_from_post($db_fields, $this->input->post());
				
			$data['poster'] = $fileupload['data']['id'];
			$data['modify'] = date('U');
			$data['slug'] = str_replace(' ', '-', trim(strtolower($data['title'])));
				
			if($this->hl_programs_m->insert($data)){				$id = $this->hl_programs_m->insert_id();				
				if($this->input->post('btnAction') == 'save_exit'){
					redirect('admin/highlights/programs');
				}								redirect('admin/highlights/programs/edit/' . $id);
			}		}				$this->page_data->title = 'Create Highlights';
		$this->page_data->action = 'create';
		$this->page_data->editor_type = 'markdown';
		
		
		$result = $this->hl_programs_m->add_new();
		$all_channel = $this->epg_ch_m->get_all_channel(array('is_active'=>1));
		
		$channels = array();
		foreach($all_channel as $ch){
			$channels[$ch->id] = $ch->name;
		}
		
		$poster = Files::get_file($result->poster);
			
		$this->render(array('hl'=>$result,'poster' => $poster['data']->filename, 'channels'=>$channels ,'page'=>$this->page_data), 'admin/hl_programs_form');	}	
	public function edit($id = NULL){				if($this->form_validation->run()){			//var_dump(); die();						$fileupload = $this->upload($id, $this->input->post('title'));						$db_fields = array('ch_id', 'title', 'sinopsis', 'start_date', 'end_date');
			$data = $this->alcopolis->array_from_post($db_fields, $this->input->post());						$data['poster'] = $fileupload['data']['id'];			$data['modify'] = date('U');			$data['slug'] = str_replace(' ', '-', trim(strtolower($data['title'])));						if($this->hl_programs_m->update($id, $data)){				if($this->input->post('btnAction') == 'save_exit'){
					redirect('admin/highlights/programs');
				}			}		}				$this->page_data->title = 'Edit Highlights';
		$this->page_data->action = 'edit';
		$this->page_data->editor_type = 'markdown';				
		$result = $this->hl_programs_m->get_highlights_by(array('id'=>$id));		$all_channel = $this->epg_ch_m->get_all_channel(array('is_active'=>1));				$channels = array();		foreach($all_channel as $ch){			$channels[$ch->id] = $ch->name;		}				$poster = Files::get_file($result[0]->poster);					$this->render(array('hl'=>$result[0],'poster' => $poster['data']->filename, 'channels'=>$channels ,'page'=>$this->page_data), 'admin/hl_programs_form');
	}			public function delete($id = NULL){
		echo 'delete ' . $id;
	}			// -------------------------------------------------------------------------------------------------------------------- //			private function upload($id = NULL, $name = 'Highlights'){		$folder = $this->folder_search('highlights', 'id');						if(!$folder['status']){			//create highlights folder			$create = Files::create_folder(1, 'highlights');		}				$imgid = $this->hl_programs_m->get_highlights_by(array('id'=>$id), 'poster', true);				if(isset($imgid->poster) || $imgid->poster != ''){			//Replace
			$fileobj = Files::get_file($imgid->poster);			unlink('uploads/default/files/' . $fileobj['data']->filename);						$file = Files::upload($folder['data']->id, $name, 'poster', false, false, false, false, NULL, $fileobj['data']);		}else{			//Upload			$file = Files::upload($folder['data']->id, $name, 'poster');		}				return $file;	}	
	private function folder_search($terms = '', $returns=''){
		$result  = array();				if($terms != ''){
			$this->db->select($returns);
			$this->db->where('name', strtolower($terms));
	
			$result['data'] = $this->db->get('default_file_folders')->row();
			$result['status'] = count((array)$result['data']) > 0 ? true : false;	
			return $result;		}
	}		private function file_search($terms = '', $returns=''){			}
}
