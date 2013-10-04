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
	}

	
	function render($view, $var = NULL){		
		$this->template
			->title($this->module_details['name'])
			->append_js('module::main.js')
			->append_css('module::style.css')
			->set($var)
			->build($view);
	}
	
	
	public function index()
	{
		$channels = $this->epg_ch_m->get_all_channel();
		$ch[0] = 'Select';
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
		
		
		$sh = $this->epg_sh_m->get_epg();
		
		$this->render('epg', array('shows'=>$sh, 'ch'=>$ch, 'cat'=>$cat));
		
// 		$this->template
// 			->title($this->module_details['name'])
// 			->set('shows', $sh)
// 			->build('epg');
	}
	
	public function show($id){
		
		$sh = $this->epg_sh_m->get_show_detail($id);
		$title = $sh->title;
		$cid = $sh->cid;
		$date = $sh->date;
		
		$similar = $this->epg_sh_m->similar_show(array('title'=>$title, 'cid'=>$cid, 'date > '=>$date), 'id, date, time, duration');
		
		$this->render('show', array('shows'=>$sh, 'similar'=>$similar));		
	}
}
