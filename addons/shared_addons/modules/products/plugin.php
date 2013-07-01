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
				'price' => array(
						'description' => array(// a single sentence to explain the purpose of this method
								'en' => 'Return Package detail',
						),
						'single' => true,// will it work as a single tag?
						'double' => false,// how about as a double tag?
						'variables' => '',// list all variables available inside the double tag. Separate them|like|this
						'attributes' => array(
								'group' => array(
										'type' => 'text',// Can be: slug, number, flag, text, array, any.
										'flags' => '',
										'default' => '',
										'required' => true,
								),
						),
				),
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
		$prod = $this->products_m->inn_get('product', $this->attribute('value'), 'slug', TRUE);
		$js = $prod->product_js;	
			
		return '<script>' . $js . '</script>';
	}
	
	
	public function css()
	{
		$prod = $this->products_m->inn_get('product', $this->attribute('value'), 'slug', TRUE);
		$css = $prod->product_css;
			
		return '<style type="text/css">' . $css . '</style>';
	}
	
	


	public function price()
	{
		$return = '';
		$packs = $this->products_m->inn_get_by('package', array('package_group'=>$this->attribute('group')));	
	
		//var_dump($packs);
		
		foreach($packs as $pack){
			$prod_id = $pack->package_prod_id;
			$pack_id = $pack->package_id;
			
			$default_field = $this->products_m->inn_get_by('field', array('product_id'=>$prod_id, 'package_id'=>0), TRUE);
			$fields = $this->products_m->inn_get_by('field', array('product_id'=>$prod_id, 'package_id'=>$pack_id));
			
			//var_dump($fields);
			
			$return .= '<div style="float:left;margin:10px;" class="price-table" id="' . strtolower(implode('-', explode(' ', $pack->package_name))) . '">';
			$return .= '<h2>' . $pack->package_name . '</h2>';
			
			foreach($fields as $field){
				$return .= '<p><small>' . $field->field_name . '</small><br/>' . $field->field_value . '</p>';
			}
			
			if($default_field != NULL){
				$return .= '<p><small>' . $default_field->field_name . '</small><br/>' . $default_field->field_value . '</p>';
			}
			
			$return .= '</div>';
		}
			
		return $return;
	}
	
	
}