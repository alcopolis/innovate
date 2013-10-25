<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Faq extends Module {

	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'FAQ'
			),
			'description' => array(
				'en' => 'Frequently Asked Questions'
			),
			'backend' => TRUE,
			'menu' => 'content',
			'shortcuts' => array(
					array(
							'name' => 'faq:group_create_title',
							'uri' => 'admin/faq/groups/create',
							'class' => 'add',
					),
			),
		);
	}

	public function install()
	{
		$this->dbforge->drop_table('inn_faq');
		$this->dbforge->drop_table('inn_faq_category');
		
		$this->install_tables(array(
				'inn_faq_category' => array(
						'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'primary' => true),
						'category' => array('type' => 'VARCHAR','constraint' => '20'),
				),
			));
		
		$faq_table = array(
                        'id' => array(
									  'type' => 'INT',
									  'constraint' => '11',
									  'auto_increment' => TRUE
						),
						'category' => array(
								'type' => 'INT',
								'constraint' => '11'
						),
						'Title' => array(
								'type' => 'VARCHAR',
								'constraint' => '50'
						),
						'question' => array(
								'type' => 'TEXT',
						),
						'answer' => array(
								'type' => 'TEXT',
						),
						'attachment' => array(
								'type' => 'VARCHAR',
								'constraint' => '200'
						),
				);

		$this->dbforge->add_field($faq_table);
		$this->dbforge->add_key('id', TRUE);

		if($this->dbforge->create_table('inn_faq'))
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
