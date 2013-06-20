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
		// here we use MY_Model's get_all() method to fetch everything
		$ch = $this->epg_ch_m->get_all();
		$sh = $this->epg_sh_m->get_all();

		// Build the view with sample/views/admin/items.php
		$this->template
			->title($this->module_details['name'])
			->set('ch', $ch)
			->set('sh', $sh)
			->build('admin/dashboard');
	}
	
// 	public function view_channels()
// 	{
// 		// here we use MY_Model's get_all() method to fetch everything
// 		$ch = $this->epg_ch_m->get_all();
	
// 		// Build the view with sample/views/admin/items.php
// 		$this->template
// 		->title($this->module_details['name'])
// 		->set('ch', $ch)
// 		->build('admin/channels');
// 	}
	
// 	public function view_shows()
// 	{
// 		// here we use MY_Model's get_all() method to fetch everything
// 		$sh = $this->epg_sh_m->get_all();
	
// 		// Build the view with sample/views/admin/items.php
// 		$this->template
// 		->title($this->module_details['name'])
// 		->set('sh', $sh)
// 		->build('admin/shows');
// 	}

	
// 	public function delete($id = 0)
// 	{
// 		echo $id;
		
// 		// make sure the button was clicked and that there is an array of ids
// 		if (isset($_POST['btnAction']) AND is_array($_POST['action_to']))
// 		{
// 			// pass the ids and let MY_Model delete the items
// 			$this->subscriber_m->delete_many($this->input->post('action_to'));
// 		}
// 		elseif (is_numeric($id))
// 		{
// 			// they just clicked the link so we'll delete that one
// 			$this->subscriber_m->delete($id);
// 		}
// 		redirect('admin/subscriber');
// 	}
}
