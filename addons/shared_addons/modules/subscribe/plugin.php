<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Plugin_Subscribe extends Plugin
{
	
	public $version = '1.0.0';
	
	public $name = array(
			'en'	=> 'Subscribe'
	);
	
	public $description = array(
			'en'	=> 'Subscribe plugin'
	);
	
	public function _self_doc()
	{
		$info = array(
			'select_pack' => array(
						'description' => array(// a single sentence to explain the purpose of this method
								'en' => 'Return Packages List',
						),
						'single' => true,// will it work as a single tag?
						'double' => false,// how about as a double tag?
						'variables' => '',// list all variables available inside the double tag. Separate them|like|this
						'attributes' => array(
								'product-slug' => array(
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
		$this->load->model('packages_m');
	}
	
	
	function select_pack()
	{
		print_r($this->attribute('product-slug'));
		$pid = $this->products_m->get_product_by('id', array('slug'=>$this->attribute('product-slug')), TRUE);
		return $pid;
	}
}

/* End of file plugin.php */