<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The public controller for the Products module.
 *
 * @author		PyroCMS Dev Team
 * @package		PyroCMS\Core\Modules\Products\Controllers
 */
class Products extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
	
		$this->load->model('products_m');
	}
	
	function view($slug){
		
		if($this->products_m->get($slug)){
			$content =  $this->products_m->get($slug);
			
			$this->template
			->title($this->module_details['name'])
			->set('data', $content)
			->build('products');
		}else{
			//Redirect to Missing Page
		}
	}
}