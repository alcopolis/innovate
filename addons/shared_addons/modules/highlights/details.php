<?php defined('BASEPATH') or exit('No direct script access allowed');



class Module_Highlights extends Module {
	public $version = '1.0';
	
	public function info()
	{
		$info = array(
					'name' => array('en' =>'Highlights'),
					'description' => array('en' => 'Highlights'),
					'frontend' => true,
					'backend' => true,
					'skip_xss' => true,
					'menu' => 'content',
					'sections' => array(
								'programs' => array(
											'name' => 'Program Highlights',
											'uri' => 'admin/highlights/programs',
											'shortcuts' => array(
														array(
																'name' => 'Add Program Highlights',
																'uri' => 'admin/highlights/programs/create',
																'class' => 'add'
															)
													)
										),
								'products' => array(
											'name' => 'Product Highlights',
											'uri' => 'admin/highlights/products',
											'shortcuts' => array(
														array(
																'name' => 'Add Product Highlights',
																'uri' => 'admin/highlights/products/create',
																'class' => 'add'
															)
													)
										),
							)
				);
		
		return $info;
	}
	
	public function install(){return true;}
	
	public function uninstall(){return true;}
	
	public function upgrade($old_version){}
}