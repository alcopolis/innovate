<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Template Plugin
 *
 * Display theme templates
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Plugins
 */
class Plugin_Products extends Plugin
{
	public $version = '1.0.0';
	
	public $name = array(
			'en'	=> 'Products'
	);
	
	public $description = array(
			'en'	=> 'Tes plugin'
	);
	
	public function _self_doc()
	{
		$info = array(
				'js' => array(
						'description' => array(// a single sentence to explain the purpose of this method
								'en' => 'Return custom JS',
						),
						'single' => true,// will it work as a single tag?
						'double' => false,// how about as a double tag?
						'variables' => '',// list all variables available inside the double tag. Separate them|like|this
						'attributes' => array(
								'value' => array(
										'type' => 'text',// Can be: slug, number, flag, text, array, any.
										'flags' => '',
										'default' => '',
										'required' => true,
								),
						),
				),
				'css' => array(
						'description' => array(// a single sentence to explain the purpose of this method
								'en' => 'Return custom CSS',
						),
						'single' => true,// will it work as a single tag?
						'double' => false,// how about as a double tag?
						'variables' => '',// list all variables available inside the double tag. Separate them|like|this
						'attributes' => array(
								'value' => array(
										'type' => 'text',// Can be: slug, number, flag, text, array, any.
										'flags' => '',
										'default' => '',
										'required' => true,
								),
						),
				),
				'featured' => array(
						'description' => array(// a single sentence to explain the purpose of this method
								'en' => ''
						),
						'single' => true,// will it work as a single tag?
						'double' => false,// how about as a double tag?
// 						'variables' => '',// list all variables available inside the double tag. Separate them|like|this
// 							'section' => array(
// 								'type' => 'text',// Can be: slug, number, flag, text, array, any.
// 								'flags' => '',// flags are predefined values like asc|desc|random.
// 								'default' => '',// this attribute defaults to this if no value is given
// 								'required' => true,// is this attribute required?		
// 							),
				),
				
				'files' => array(
						'description' => array(// a single sentence to explain the purpose of this method
								'en' => 'Return attachment files as links or embed',
						),
						'single' => true,// will it work as a single tag?
						'double' => false,// how about as a double tag?
						'variables' => '',// list all variables available inside the double tag. Separate them|like|this
						'attributes' => array(
 								'name' => array(
										'type' => 'text',// Can be: slug, number, flag, text, array, any.
										'flags' => '',
										'default' => '',
										'required' => true,
								),
								'product' => array(
										'type' => 'text',// Can be: slug, number, flag, text, array, any.
										'flags' => '',
										'default' => '',
										'required' => true,
								),
								'display' => array(
										'type' => 'text',// Can be: slug, number, flag, text, array, any.
										'flags' => '',
										'default' => '',
										'required' => true,
								),
						),
				),
		);
	
		return $info;
	}
	
	public function __construct()
	{	
		$this->load->model('products_m');
	}	
	

	public function js()
	{	
 		$prod = $this->products_m->get_product_by(NULL, array('slug'=>$this->attribute('value')), true);
 		$js = $prod->js;	
			
 		return '<script>' . $js . '</script>';
	}
	
	
	public function css()
	{
		$prod = $this->products_m->get_product_by(NULL, array('slug'=>$this->attribute('value')), true);
		$css = $prod->css;
			
		return '<style type="text/css">' . $css . '</style>';
	}
	
	function featured(){
		$data = '';
		//$key = $this->attribute('section');
	
		$fields = array(
				'name',
				'slug',
				'teaser',
		);
	
		$raw = $this->products_m->get_product_by($fields, array('is_featured'=>1), false);
		
		foreach($raw as $featured){			
			$data .= '<div class="product-featured" style="margin:20px; width:25%; float:left;">';
			$data .= '<h3>' . $featured->name . '</h3>';		
			$data .= substr($featured->teaser, 0, 150) . ' ...<br/>';
			$data .= '<a href="products/view/' . $featured->slug . '">Learn more &raquo;</a>';
			$data .= '</div>';
		}
		
		return $data;
	}
	
	
	function files(){ 
		$key = $this->attribute('name');
		$prod_slug = $this->attribute('product');
		
		
		$temp = json_decode($this->products_m->get_product_by(NULL, array('slug'=>$prod_slug), true)->files);
		
		$files = FILES::get_file($temp->attch->$key->id)['data'];
		$display = $temp->attch->$key->display;
		
		return '<a class="attch-' . $display . '" href="{{url:site}}uploads/default/files/' . $files->filename . '">' . $files->name . '</a>';
	}
}