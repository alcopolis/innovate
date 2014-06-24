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
		$pagination = create_pagination('admin/epg/index', $this->epg_sh_m->count_featured_show(), 5);
		
		var_dump($pagination['limit'], $pagination['offset']);
		
		$featured = $this->epg_sh_m->limit($pagination['limit'], $pagination['offset'])->get_featured_show();
		
		$this->template
			->title($this->module_details['name'])
			->set('featured', $featured)
			->set('pagination', $pagination)
			->build('admin/dashboard');
	}
}
