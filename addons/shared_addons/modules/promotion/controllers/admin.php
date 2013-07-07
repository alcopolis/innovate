<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Pages controller
 *
 * @author 		PyroCMS Dev Team
 * @package 	PyroCMS\Core\Modules\Products\Controllers
 */
class Admin extends Admin_Controller {
	
	
	public function __construct()
	{
		parent::__construct();
	
		$this->load->model('promotion_m');
		$this->load->model('category_m');
	}
	
	public function index(){
		$promos = $this->promotion_m->get_promotions();
		$cats = $this->category_m->get_categories();
		
		$this->template
			->title($this->module_details['name'])
			->set('promos', $promos)
			->set('cats', $cats)
			->build('admin/index');
	}
	
}