<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Epg extends Module {
	public $version = '1.0';
	
	public function info()
	{
		return array(
				'name' => array(
						'en' => 'EPG'
				),
				'description' => array(
						'en' => 'EPG Tools'
				),
				'frontend' => true,
				'backend' => true,
				'skip_xss' => true,
				'menu' => 'content',
				'sections' => array(
					'channels' => array(
						'name' => 'Channels',
						'uri' => 'admin/epg/channels',
						'shortcuts' => array(
							array(
								'name' => 'Add Channel',
								'uri' => 'admin/epg/channels/create',
								'class' => 'add',
							),
						),
					),
					'shows' => array(
						'name' => 'Shows',
						'uri' => 'admin/epg/shows',
						'shortcuts' => array(
							array(
								'name' => 'Add Shows',
								'uri' => 'admin/epg/shows/create',
								'class' => 'add',
							),
						),
					),
				)
		);
	}
	
	public function install()
	{
		$this->dbforge->drop_table('inn_epg_ch_detail');
		$this->dbforge->drop_table('inn_epg_show_detail');
		$this->dbforge->drop_table('inn_epg_show_category');
		//$this->db->delete('settings', array('module' => 'sample'));    //Maybe usefull for future projects
		
		// Create the channel detail table.
		$this->install_tables(array(
				'inn_epg_ch_detail' => array(
						'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'primary' => true),
						'name' => array('type' => 'VARCHAR','constraint' => '100'),
						'num' => array('type' => 'INT',	'constraint' => '11'),
						'cat' => array('type' => 'VARCHAR','constraint' => '100'),
						'desc' => array('type' => 'TEXT')
				),
				
				//Category table for show genre(movie, serial, news, etc)
				'inn_epg_show_category' => array(
						'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'primary' => true),
						'cat' => array('type' => 'VARCHAR','constraint' => '100'),
				),
		));
	
		$show = array(
					'id' => array('type' => 'INT','constraint' => '11','auto_increment' => TRUE, 'primary' => true),
					'cid' => array('type' => 'INT','constraint' => '11'),
					'cat_id' =>  array('type' => 'INT','constraint' => '11'),   //
					'title' => array('type' => 'VARCHAR','constraint' => '100'),
					'date' => array('type' => 'DATE'),
					'time' => array('type' => 'TIME'),
					'duration' => array('type' => 'TIME'),
					'syn_id' => array('type' => 'TEXT'),
					'syn_en' => array('type' => 'TEXT'),
					'is_featured' => array('type' => 'BOOLEAN'),
					'poster' => array('type' => 'TEXT')
		);
	
		$this->dbforge->add_field($show);
		$this->dbforge->add_key('id', TRUE);
	
		if($this->dbforge->create_table('inn_epg_show_detail'))
		{
			return TRUE;
		}
	}
	
	public function uninstall()
	{
		if($this->dbforge->drop_table('inn_epg_ch_detail') && $this->dbforge->drop_table('inn_epg_show_detail') && $this->dbforge->drop_table('inn_epg_show_category')){
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