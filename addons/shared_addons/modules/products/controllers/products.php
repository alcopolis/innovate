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
	
	function view($slug=NULL){
		$this->product = $this->products_m->get($slug);

		if($this->product != NULL){
			$this->template
			->title($this->module_details['name'])
			->append_css('module::style_front.css')
			->set('product', $this->product)
			->build('products');
		}else{
			//Redirect to Missing Page
		}
	}
	
	function tes(){
		$this->result = $this->products_m->inn_get_by('field', array('field_name'=>'Saluran Premium'), TRUE);
		var_dump($this->result);
	}
}