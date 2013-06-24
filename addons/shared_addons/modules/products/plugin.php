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
		);
	
		return $info;
	}
	
	public function __construct()
	{	
		$this->load->model('products_m');
	}
	
	public function js()
	{	
		$prod = $this->products_m->get($this->attribute('value'));		
		$js = $prod->attribute['product_js'];
		
		return '<script>' . $js . '</script>';
	}
	
	public function css()
	{
		$prod = $this->products_m->get($this->attribute('value'));
		$css = $prod->attribute['product_css'];
		
		//var_dump($css);
	
		return '<style type="text/css">' . $css . '</style>';
	}
}