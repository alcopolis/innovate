<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Articles extends Module {

	public $version = '1.0';

	public function info()
	{
		return array(
			'name' => array(
				'en' => 'Articles'
			),
			'description' => array(
				'en' => 'Articles Admin'
			),
			'frontend' => true,
			'backend' => true,
			'skip_xss' => true,
			'menu' => 'content',
				
			'sections' => array(
					'articles' => array(
							'name' => 'Articles',
							'uri' => 'admin/articles',
							'shortcuts' => array(
									array(
											'name' 	=> 'Add',
											'uri' 	=> 'admin/articles/create',
											'class' => 'add',
									),
							),
					),
			),
		);
	}

	public function install()
	{
		//$this->dbforge->drop_table('inn_articles', 'inn_articles_category', 'inn_articles_tags');
		//$this->dbforge->drop_table('inn_articles');
		//$this->dbforge->drop_table('inn_articles_category');
		//$this->dbforge->drop_table('inn_articles_keywords');
		
		
// 		$this->install_tables(array(
// 				'inn_articles_category' => array(
// 						'id' => array('type' => 'INT','constraint' => '11','auto_increment' => TRUE, 'primary' => TRUE),
// 						'category' => array('type' => 'VARCHAR','constraint' => '100'),
// 				),
// 				'inn_articles_keywords' => array(
// 						'id' => array('type' => 'INT','constraint' => '11','auto_increment' => TRUE, 'primary' => TRUE),
// 						'keyword' => array('type' => 'VARCHAR','constraint' => '100'),
// 				),
// 		));
		
		
		
// 		$articles = array(
// 						'id' => array('type'=>'INT', 'constraint'=>'11', 'auto_increment'=>TRUE, 'primary'=>TRUE),
// 						'title' => array('type'=>'VARCHAR', 'constraint'=>'200'),
// 						'slug' => array('type'=>'VARCHAR', 'constraint'=>'220'),
// 						'intro' => array('type' => 'VARCHAR','constraint' => '200'),
// 						'body' => array('type' => 'TEXT'),
// 						'keywords' => array('type' => 'VARCHAR','constraint' => '200'),
// 						'created_on' => array('type' => 'INT','constraint' => '11'),
// 						'modified_on' => array('type' => 'INT','constraint' => '11'),
// 						'status' => array('type' => 'INT', 'constraint' => '1', 'default' => '0')						
// 					);
		
		
// 		$this->dbforge->add_field($articles);
// 		$this->dbforge->add_key('id', TRUE);

// 		if($this->dbforge->create_table('inn_articles'))
// 		{
// 			return TRUE;
// 		}
		
		return TRUE;
	}

	public function uninstall()
	{
// 		$this->dbforge->drop_table('inn_articles');
// 		$this->dbforge->drop_table('inn_articles_category');
// 		$this->dbforge->drop_table('inn_articles_keywords');
		
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
