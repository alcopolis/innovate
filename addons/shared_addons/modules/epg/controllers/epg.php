<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * EPG Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	EPG Module
 */

class Epg extends Public_Controller
{
	protected $section = 'items';
	public function __construct()
	{
		parent::__construct();
		// Load all the required classes
		$this->load->model('epg_ch_m');
		$this->load->model('epg_sh_m');
		$this->load->library('form_validation');
		$this->lang->load('epg');
		// Set validation rules
		$this->form_validation->set_rules($this->epg_sh_m->filter_rules);
	}

	function render($view, $var = NULL){		
		$this->template
			//->title($this->module_details['name'])
			->append_js('module::main.js')
			->append_css('module::style.css')			->append_css('module::front.css')
			->set($var)
			->build($view);
	}
	public function index()
	{
		$channels = $this->epg_ch_m->get_all_channel();
		foreach($channels as $c){
			$ch[$c->id] = $c->name;
		}
		$cats = $this->epg_ch_m->get_categories();
		foreach($cats as $ct){
			if($ct->id == '0'){
				$cat[0] = 'All Categories';
			}else{
				$cat[$ct->id] = $ct->cat;
			}
		}
		$tgl = '';
		if($this->form_validation->run()){			$cond = array(
				'date' => $this->input->post('date'),
				'cat_id' => $this->input->post('cat_id')
			);
			$sh = $this->epg_sh_m->get_epg_by($cond);
		}else{
			$sh = $this->epg_sh_m->get_epg();
			$tgl = date('Y-m-d');
		}		$this->template->title('TV Guide');
		$this->render('epg', array('shows'=>$sh, 'ch'=>$ch, 'cat'=>$cat, 'tgl'=>$tgl));
	}
	public function show($id = NULL){		if($id != NULL){
			$sh = $this->epg_sh_m->get_show_detail($id);
			$title = $sh->title;
			$cid = $sh->cid;
			$date = $sh->date;
		
			$similar = $this->epg_sh_m->similar_show(array('title'=>$title, 'cid'=>$cid, 'date > '=>$date), 'id, date, time, duration', 5);
			$this->template->title($title);
			$this->render('show', array('shows'=>$sh, 'similar'=>$similar));
		}else{			redirect('404');		}
	}
	
	public function channel_lineup(){
		$cats = $this->epg_ch_m->get_categories();		foreach($cats as $ct){
			if($ct->id == '0'){
				$cat[0] = 'All Categories';
			}else{
				$cat[$ct->id] = $ct->cat;
			}
		}
		if($this->input->post('cat_id') == NULL || $this->input->post('cat_id') == '0'){
			$c = 'All Categories';
		}else{
			$c = $cat[intval($this->input->post('cat_id'))];
		}
		$this->render('channel_lineup', array('cat'=>$cat, 'category'=>$c));
	}				// ======================== AJAX Function ================================== //		public function today_sched($id){		$respond = array();		$cid = $id;		$raw_sched;				if($cid){			$this->load->library('table');						$raw_sched = $this->epg_sh_m->get_show_by('time, title', array('cid'=>$cid, 'date'=>'2014-04-02'), FALSE);						if(count($raw_sched) > 0){				
				$tmpl = array (							'table_open'  => '<table border="0" cellpadding="2" cellspacing="1">',							'row_start'           => '<tr>',							
							'row_alt_start'       => '<tr class="alt">',						);
				$this->table->set_template($tmpl);								foreach($raw_sched as $r){					$time = date_create($r->time);					$this->table->add_row(date_format($time, 'H:i'), $r->title);				}								$respond['status'] = TRUE;				$respond['schedule'] = $this->table->generate();			}else{				$respond['status'] = TRUE;
				$respond['schedule'] = 'No data';			}					}else{			$respond['status'] = FALSE;		}				echo json_encode($respond);	}
}
