<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Subscribe extends Module {

	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Subscribe'
			),
			'description' => array(
				'en' => 'New Customer Subscription'
			),
			'backend' => TRUE,
			'menu' => 'content'
		);
	}

	public function install()
	{
		$this->dbforge->drop_table('inn_subscribe');
		//$this->db->delete('settings', array('module' => 'sample'));    //Maybe usefull for future projects

		$subscribe_table = array(
                        'id' => array(
									  'type' => 'INT',
									  'constraint' => '11',
									  'auto_increment' => FALSE
						),
						'first_name' => array(
								'type' => 'VARCHAR',
								'constraint' => '20'
						),
						'last_name' => array(
								'type' => 'VARCHAR',
								'constraint' => '20'
						),
						'address' => array(
								'type' => 'TEXT',
						),
						'kelurahan' => array(
								'type' => 'TEXT',
						),
						'phone' => array(
								'type' => 'VARCHAR',
								'constraint' => '20'
						),
						'mobile' => array(
								'type' => 'VARCHAR',
								'constraint' => '20'
						),
						'email' => array(
								'type' => 'VARCHAR',
								'constraint' => '100'
						),
						'closing_flag' => array(
								'type' => 'INT',
								'constraint' => '11'
						)
				);

		$this->dbforge->add_field($subscribe_table);
		$this->dbforge->add_key('id', TRUE);

		if($this->dbforge->create_table('inn_subscribe'))
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
