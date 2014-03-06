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
	protected $section = 'subscribe';
	protected $rules = array();
	
	protected $page_data;
	protected $subscribes_data;
	protected $filter;

	public function __construct()
	{
		parent::__construct();

	}
	
	
	
	function render($view, $var){
		$this->template
		->title($this->module_details['name'])
//		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
//		->append_js('module::subscribe-admin.js')
//		->set('subscribes', $this->subscribes_data)
//		->set('filter', $this->filter)
//		->set($var)
		->build($view);
	}
	

	/**
	 * List all items
	 */
	public function index()
	{
		echo 'asdfasdfasdf';
	}
	
	
	
	
	
	
	
	
	
	
	
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
