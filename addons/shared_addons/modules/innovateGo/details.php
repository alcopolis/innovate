<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_InnovateGo extends Module {

    public $version = '1.0';

    public function info() {
        return array(
            'name' => array(
                'en' => 'InnovateGo'
            ),
            'description' => array(
                'en' => 'InnovateGo'
            ),
            'frontend' => true,
            'backend' => true,
            'skip_xss' => true,
            'menu' => 'content',
        );
    }

    public function install() {
        $this->dbforge->drop_table('inn_innovateGo');
        //$this->db->delete('settings', array('module' => 'sample'));    //Maybe usefull for future projects

        $innovateGo_table = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => TRUE
            ),
            'custName' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'custPhone' => array(
                'type' => 'VARCHAR',
                'constraint' => '60'
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '20'
            ),
            'subscriberID' => array(
                'type' => 'VARCHAR',
                'constraint' => '60'
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '60'
            ),
            'activated' => array(
                'type' => 'CHAR',
                'constraint' => '1',
                'null' => FALSE,
                'default' => 0
            ),
            'activated' => array(
                'type' => 'DATETIME',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
        );

        $this->dbforge->add_field($innovateGo_table);
        $this->dbforge->add_key('id', TRUE);

        if ($this->dbforge->create_table('inn_innovateGo')) {
            return TRUE;
        }
    }

    public function uninstall() {
        return TRUE;
    }

    public function upgrade($old_version) {
        // Your Upgrade Logic
        return TRUE;
    }

    public function help() {
        // Return a string containing help info
        // You could include a file and return it here.
        return "No documentation has been added for this module.<br />Contact the module developer for assistance.";
    }

}

/* End of file details.php */
