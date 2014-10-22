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
				'en' => 'Quiz Module'
			),
			'frontend' => true,
			'backend' => true,
			'skip_xss' => true,
			'menu' => 'content',
			
			'sections' => array(
					
					'quiz' => array(
					
						'name' => 'Quiz',
						
						'uri' => 'admin/quiz',
				
							'shortcuts' => array(
									
									'create' => array(
							
										'name' => 'quiz:group_create_title',
							
										'uri' => 'admin/quiz/create',
							
										'class' => 'add'
									)
							)
					),
					
					'useractivity' => array(
					
						'name' => 'User Activity',
						
						'uri' => 'admin/quiz/useractivity',
						
					),
			)
		
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
				
				'inn_quiz_question' => array(
                        'id' => array('type' => 'INT',
						'constraint' => 11,
						'auto_increment' => TRUE,
						'primary' => TRUE),
						'quiz_id' => array('type' => 'INT',
						'constraint' => '11'),
						'question_admin' => array('type' => 'TEXT'),
						'answer_admin' => array('type' => 'TEXT')
				),
		));
		
		$useractivity_table = array(
                        'id' => array('type' => 'INT',
						'constraint' => 11,
						'auto_increment' => TRUE,
						'primary' => TRUE),
						'user_id' => array(
						'type' => 'INT', 
						'constraint' => 11),
						'quiz_id' => array(
						'type' => 'INT',
						'constraint' => 11),
						'answers' => array(
							'type' => 'TEXT',
							'point' => 'INT',
							'constraint' => 11)
				);

		$this->dbforge->add_field($useractivity_table);
		$this->dbforge->add_key('id', TRUE);
		
		if($this->dbforge->create_table('inn_quiz_user_activity'))
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
