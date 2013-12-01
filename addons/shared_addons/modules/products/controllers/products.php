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
	protected $pack;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('products_m');
		$this->load->model('packages_m');
		$this->load->library('files/files');
	}

	
	private function render($view, $var = NULL){
		$this->template
		->title($this->module_details['name'])
		->append_js('module::main.js')
		->append_css('module::style_front.css')
		->set($var)
		->build('products');
	}
	
	
	public function view($slug){
		$this->product = $this->products_m->get_product_by(NULL, array('slug' => $slug), true);
		
		$pack_group_id = $this->packages_m->group_by('group_id')->order_by('id', 'ASC')->get_packages_by('group_id', array('prod_id' => $this->product->id));
		$groups = array();
		
		foreach($pack_group_id as $pgi){			
			$this->pack[$pgi->group_id]['data'] = $this->packages_m->get_group_by(array('id' => $pgi->group_id), TRUE);
			$this->pack[$pgi->group_id]['pack'] = $this->packages_m->order_by('id', 'ASC')->get_packages_by(NULL, array('prod_id' => $this->product->id, 'group_id' => $pgi->group_id));
		}
		
		
		if($this->product != NULL){
			//Set up variable
			$files_cont = json_decode($this->product->files, true);
			$poster = $files_cont['poster'];
			$files = $files_cont['attch'];
			
			//get bundle data
			$bundle = json_decode($this->product->bundle);
			
			$data = array(
					'product' => $this->product,
					'poster' => $poster,
					'files' => $files,
					'packages' => $this->pack,
					'bundle' => $bundle
			);
			
			$this->render('products', $data);
		}else{
			//Redirect to Missing Page
		}
	}
	
	
}