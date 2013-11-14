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
		$this->load->library('files/files');
	}

	
	private function render($view, $var){
		$this->template
		->title($this->module_details['name'])
		->append_css('module::style_front.css')
		->set($var)
		->build('products');
	}
	
	public function view($slug){
		$this->product = $this->products_m->get_product_by(NULL, array('slug' => $slug), true);
		
		if($this->product != NULL){
			//Set up variable
			$files_cont = json_decode($this->product->files, true);
			$poster = $files_cont['poster'];
			$files = $files_cont['attch'];
			$data = array(
					'product' => $this->product,
					'poster' => $poster,
					'files' => $files
			);
			
			$this->render('products', $data);
		}else{
			//Redirect to Missing Page
		}
	}
	
	
}