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
				)
		);
	}
	
	
	
	public function install()
	{
		$this->dbforge->drop_table('inn_promotion');

		$promo = array(
				'id' => array('type' => 'INT','constraint' => '11','auto_increment' => TRUE, 'primary' => TRUE),
				'slug' => array('type' => 'VARCHAR','constraint' => '100'),
				'body' => array('type' => 'TEXT'),
				'category' => array('type' => 'VARCHAR','constraint' => '100'),
				'tags' => array('type' => 'VARCHAR','constraint' => '100'),
				'publish' => array('type' => 'DATE'),
				'ended' => array('type' => 'DATE'),
				'poster' => array('type' => 'VARCHAR', 'constraint' => '100')
		);

		$this->dbforge->add_field($promo);
		$this->dbforge->add_key('id', TRUE);
				
		if($this->dbforge->create_table('inn_promotion'))
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