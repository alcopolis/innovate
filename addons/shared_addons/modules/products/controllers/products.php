<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The public controller for the Products module.
 *
 * @author		PyroCMS Dev Team
 * @package		PyroCMS\Core\Modules\Products\Controllers
 */
class Products extends Public_Controller
{
	
	protected $product;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('products_m');
	}
	
	public function view($slug){

		$this->product = $this->construct_data($slug);
		
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
	
	private function construct_data($slug){
		$prod = new stdClass();
		$prod->data = $this->products_m->inn_get('product', $slug, 'slug', true); //return object
		$prod->packages = $this->products_m->inn_construct_data($prod->data->product_id);
		
		return $prod;
	}
	
	
}