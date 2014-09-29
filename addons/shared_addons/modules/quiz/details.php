<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Quiz extends Module {

	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Quiz'
			),
			'description' => array(
				'en' => 'Quiz Tools'
			),
			'backend' => TRUE,
			'menu' => 'content',
			'shortcuts' => array(
					array(
							'name' => 'quiz:group_create_title',
							'uri' => 'admin/quiz/groups/create',
							'class' => 'add',
					),
			),
		);
	}

	public function install()		
	{
		$this->install_tables(array(
				'inn_quiz' => array(
                        'id' => array('type' => 'INT',
						'constraint' => 11,
						'auto_increment' => TRUE, 
						'primary' => TRUE),
						'name' => array('type' => 'VARCHAR',
						'constraint' => '50'),
						'slug' => array('type' => 'VARCHAR',
						'constraint' => '200'),
						'start_date' => array('type' => 'DATE'),
						'end_date' => array('type' => 'DATE'),
						'description' => array('type' => 'VARCHAR',
						'constraint' => '200'),
						'theme' => array(
								'type' => 'VARCHAR',
								'constraint' => '100')
				),
				
				'inn_quiz_user' => array(
                        'id' => array('type' => 'INT',
						'constraint' => 11,
						'auto_increment' => TRUE,
						'primary' => TRUE),
						'name' => array('type' => 'VARCHAR',
						'constraint' => '50'),
						'email' => array('type' => 'VARCHAR',
						'constraint' => '50'),
						'mobile' => array('type' => 'INT',
						'constraint' => '15'),
						'status' => array('type' => 'VARCHAR',
						'constraint' => '200'
						),
				),
		));
		
		$question_table = array(
                        'id' => array('type' => 'INT',
						'constraint' => 11,
						'auto_increment' => TRUE,
						'primary' => TRUE),
						'question_admin' => array(
						'type' => 'TEXT'),
						'answer_admin' => array(
						'type' => 'TEXT'),
						'answer_user' => array(
						'type' => 'TEXT')
				);

		$this->dbforge->add_field($question_table);
		$this->dbforge->add_key('id', TRUE);
		
		if($this->dbforge->create_table('inn_quiz_question'))
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
