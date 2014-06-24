<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Products extends Module {
	public $version = '1.0';
	
	public function info()
	{
		return array(
				'name' => array(
						'en' => 'Products'
				),
				'description' => array(
						'en' => 'Products Page'
				),
				'frontend' => true,
				'backend' => true,
				'skip_xss' => true,
				'menu' => 'content',
				
				'sections' => array(
						'products' => array(
								'name' => 'Products',
								'uri' => 'admin/products',
									'shortcuts' => array(
											'create' => array(
													'name' 	=> lang('products:create'),
													'uri' 	=> 'admin/products/create',
													'class' => 'add'
											)
									)
						),
						'packages' => array(
								'name' => 'Product Packages',
								'uri' => 'admin/products/packages',
								'shortcuts' => array(
										'create' => array(
												'name' 	=> 'Add packages',
												'uri' 	=> 'admin/products/packages/create',
												'class' => 'add'
										)
								)
						),
				)
		);
	}
	
	
	
	public function install()
	{
		//$this->dbforge->drop_table('inn_products_data');
		//$this->dbforge->drop_table('inn_products_packages');

		$this->install_tables(array(
			'inn_products_packages' => array(
				'id' => array('type' => 'INT','constraint' => '11','auto_increment' => TRUE, 'primary' => TRUE),
				'prod_id' => array('type' => 'INT','constraint' => '11'),
				'name' => array('type' => 'VARCHAR','constraint' => '100'),   
				'price' => array('type' => 'VARCHAR','constraint' => '100'),
				'body' => array('type' => 'TEXT'),
				'pack_item_info' => array('type' => 'TEXT')
			)
		));

		$prod = array(
				'id' => array('type' => 'INT','constraint' => '11','auto_increment' => TRUE, 'primary' => TRUE),
				'name' => array('type' => 'VARCHAR','constraint' => '100'),
				'slug' =>  array('type' => 'VARCHAR','constraint' => '100'),   //
				'body' => array('type' => 'TEXT'),
				'section' => array('type' => 'VARCHAR','constraint' => '10'),
				'css' => array('type' => 'TEXT'),
				'js' => array('type' => 'TEXT'),
				'is_featured' => array('type' => 'BOOLEAN'),
				'poster' => array('type' => 'TEXT'),
				'tags' =>  array('type' => 'VARCHAR','constraint' => '255'),
		);
		
		$this->dbforge->add_field($prod);
		$this->dbforge->add_key('id', TRUE);
		
		if($this->dbforge->create_table('inn_products_data'))
		{
			return TRUE;
		}
	}
	
	public function uninstall()
	{
		return TRUE;
	}
	
	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}
	
	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
	}
}