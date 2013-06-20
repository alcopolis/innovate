<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Subscriber extends Module {

	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Subscriber'
			),
			'description' => array(
				'en' => 'Subscribe tools'
			),
			'backend' => TRUE,
			'menu' => 'content'
		);
	}

	public function install()
	{
		$this->dbforge->drop_table('inn_subscriber');
		//$this->db->delete('settings', array('module' => 'sample'));    //Maybe usefull for future projects

		$subscriber = array(
                        'id' => array(
									  'type' => 'INT',
									  'constraint' => '11',
									  'auto_increment' => TRUE
									  ),
						'email' => array(
										'type' => 'VARCHAR',
										'constraint' => '100'
										)
						);

		$this->dbforge->add_field($subscriber);
		$this->dbforge->add_key('id', TRUE);

		if($this->dbforge->create_table('inn_subscriber'))
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
/* End of file details.php */
