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
	protected $subscribe_data;

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('subscribe_m');
		$this->load->library('form_validation');
		
		// Set our validation rules
		$this->rules = $this->subscribe_m->_rules;
		$this->form_validation->set_rules($this->rules);
	}
	
	
	
	function render($view){
		$this->template
		->title($this->module_details['name'])
		->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
		->append_js('module::product_form.js')
		->set('prod', $this->prod_data)
		->set('page', $this->page_data)
		->build($view);
	}
	

	/**
	 * List all items
	 */
	public function index()
	{
		// here we use MY_Model's get_all() method to fetch everything
		$items = $this->subscriber_m->get_all();

		// Build the view with sample/views/admin/items.php
		$this->template
			->title($this->module_details['name'])
			->set('items', $items)
			->build('admin/items');
	}

	
	public function delete($id = 0)
	{
		echo $id;
		
		// make sure the button was clicked and that there is an array of ids
		if (isset($_POST['btnAction']) AND is_array($_POST['action_to']))
		{
			// pass the ids and let MY_Model delete the items
			$this->subscriber_m->delete_many($this->input->post('action_to'));
		}
		elseif (is_numeric($id))
		{
			// they just clicked the link so we'll delete that one
			$this->subscriber_m->delete($id);
		}
		redirect('admin/subscriber');
	}
	
	
}
