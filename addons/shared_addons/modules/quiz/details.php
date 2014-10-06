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
		$this->dbforge->drop_table('inn_quiz');
// 		$this->dbforge->drop_table('inn_quiz_question');
// 		$this->dbforge->drop_table('inn_quiz_user_activity');
		
// 		$this->install_tables(
// 				array(
// 					'inn_quiz_question' => array(),
// 					'inn_quiz_user_activity' => array()
// 				)	
// 			);
		
		$quiz = array(
					'id' => array('type'=>'INT', 'constraint'=>'11', 'auto_increament'=>TRUE),
					'name' => array('type'=>'VARCHAR', 'constraint'=>'255'),
					'slug' => array('type'=>'TEXT'),
					'start_date' => array('type'=>'DATE'),
					'end_date' => array('type'=>'DATE'),
					'description' => array('type'=>'TEXT'),
					'theme' => array('type'=>'VARCHAR', 'constraint'=>'255'),
				);
		
		$this->dbforge->add_field($quiz);
		$this->dbforge->add_key('id', TRUE);
		
		if($this->dbforge->create_table('inn_quiz'))
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
