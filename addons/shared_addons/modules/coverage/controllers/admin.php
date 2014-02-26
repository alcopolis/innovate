<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * EPG Module
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
		
		$this->load->model('covarage_m');

		// Load all the required classes
	}

	/**
	 * List all items
	 */
	public function index()
	{		
		$this->template
			->title($this->module_details['name'])
			->build('admin/index');
		
	}
}
