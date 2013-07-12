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

	/**
	 * List all items
	 */
	public function index()
	{
		$sh = $this->epg_sh_m->get_epg();

		$this->template
			->title($this->module_details['name'])
			->set('shows', $sh)
			->build('epg');
	}
	
	public function show($id){
		$sh = $this->epg_sh_m->get_show_by(NULL, array('id'=>$id), TRUE);
		
		$this->template
			->title($this->module_details['name'])
			->set('shows', $sh)
			->build('show');
	}
}
