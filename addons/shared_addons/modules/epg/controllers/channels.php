<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Subscriber Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */

class Channels extends Admin_Controller
{
	protected $section = 'items';

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('epg_ch_m');
		$this->load->library('form_validation');
		$this->lang->load('epg');
	}

	/**
	 * List all items
	 */
	public function index()
	{		
		$pagination = create_pagination('admin/epg/channels/index', $this->epg_ch_m->count_channel(), 10, 3);
		$all_channels = $this->epg_ch_m->limit($pagination['limit'], $pagination['offset'])->get_all_channel();
		
		$this->template
			->title($this->module_details['name'])
			->set('pagination', $pagination)
			->set('channels', $all_channels)
			->set_partial('filters', 'admin/partials/channel_filters')
			->build('admin/channels');
	}
	

	
}
