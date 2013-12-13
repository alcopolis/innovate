<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Coverage extends Module {

	public $version = '1.0';

	public function info()
	{
		$info = array(
			'name' => array(
				'en' => 'Coverage'
			),
			'description' => array(
				'en' => 'Service Covarege Area'
			),
			'frontend' => true,
			'backend' => true,
			'skip_xss' => true,
			'menu' => 'data',
				
			'sections' => array(
						  	'coverage' => array(
						  				'name' => 'Coverage',
						  				'uri' => 'admin/coverage',
						  				'shortcuts' => array(
						  					array(
						  						'name' => 'Add',
						  						'uri' => 'admin/coverage/create',
						  						'class' => 'add'
						  					)
						  				),
						  	),		
			 		),
		);
		
		
		return $info;
	}

	public function install()
	{		
		$this->dbforge->drop_table('inn_test');

		$test = array(
				'id' => array('type' => 'INT','constraint' => '11','auto_increment' => TRUE, 'primary' => TRUE),
				'slug' => array('type' => 'VARCHAR','constraint' => '100'),
				'body' => array('type' => 'TEXT'),
				'category' => array('type' => 'VARCHAR','constraint' => '100'),
				'tags' => array('type' => 'VARCHAR','constraint' => '100'),
				'publish' => array('type' => 'DATE'),
				'ended' => array('type' => 'DATE'),
				'poster' => array('type' => 'VARCHAR', 'constraint' => '100')
		);

		$this->dbforge->add_field($test);
		$this->dbforge->add_key('id', TRUE);
				
		if($this->dbforge->create_table('inn_test'))
		{
			return TRUE;
		}
	}

	public function uninstall()
	{	
		$this->dbforge->drop_table('inn_test');
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
/* End of file details.php */
