<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Promotion extends Module {
	public $version = '1.0';
	
	public function info()
	{
		return array(
				'name' => array(
						'en' => 'Promotion'
				),
				'description' => array(
						'en' => 'Promotion Page'
				),
				'frontend' => true,
				'backend' => true,
				'skip_xss' => true,
				'menu' => 'content',
				
				'sections' => array(
						'promotion' => array(
								'name' => 'Promotion',
								'uri' => 'admin/promotion',
								'shortcuts' => array(
									'create' => array(
											'name' 	=> 'Add',
											'uri' 	=> 'admin/promotion/create',
											'class' => 'add'
									)
								)
						),
						'category' => array(
								'name' => 'Category',
								'uri' => 'admin/promotion/category',
								'shortcuts' => array(
									'create' => array(
										'name' => 'Add',
										'uri' => 'admin/promotion/category/add',
										'class' => 'add'
									)
								)
						)
				)
		);
	}
	
	
	
	public function install()
	{
		//$this->dbforge->drop_table('inn_promotion_category');
		//$this->dbforge->drop_table('inn_promotion');

		$promo = array(
				'id' => array('type' => 'INT','constraint' => '11','auto_increment' => TRUE, 'primary' => TRUE),
				'cat' => array('type'=>'INT', 'constraint' => '11'),
				'name' => array('type' => 'VARCHAR','constraint' => '100'),
				'slug' => array('type' => 'VARCHAR','constraint' => '100'),
				'body' => array('type' => 'TEXT'),
				'tags' => array('type' => 'VARCHAR','constraint' => '100', 'null' => TRUE),
				'status' => array('type' => 'VARCHAR', 'constraint' => '20', 'null' => TRUE),
				'featured' => array('type' => 'TINYINT', 'constraint' => '1'),
				'featured_uri' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE),
				'featured_copy' => array('type' => 'TEXT', 'null' => TRUE),
				'poster' => array('type' => 'TEXT', 'null' => TRUE),
				'publish' => array('type' => 'DATE', 'null' => TRUE),
				'ended' => array('type' => 'DATE', 'null' => TRUE),
				'author' => array('type' => 'INT', 'constraint' => '11' ),
				'css' => array('type' => 'TEXT', 'null' => TRUE),
				'js' => array('type' => 'TEXT', 'null' => TRUE)
		);

		$promo_cat = array(
				'id' => array('type' => 'INT','constraint' => '11','auto_increment' => TRUE, 'primary' => TRUE),
				'cat' => array('type'=>'VARCHAR', 'constraint' => '20'),
				'description' => array('type' => 'VARCHAR','constraint' => '255')
		);
		
		$this->dbforge->add_field($promo);
		$this->dbforge->add_key('id', TRUE);
				
	if($this->dbforge->create_table('inn_promotion'))
		{
			$this->dbforge->add_field($promo_cat);
			$this->dbforge->add_key('id', TRUE);
			
			if($this->dbforge->create_table('inn_promotion_category'))
			{
				return TRUE;
			}
		}else{
			return FALSE;
		}
	}
	
	public function uninstall()
	{
		if($this->dbforge->drop_table('inn_promotion') && $this->dbforge->drop_table('inn_promotion_category')){
			return TRUE;
		}else{
			return FALSE;
		}
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