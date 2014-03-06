<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_ott_registrasi extends Module {

    public $version = '1.0';

    public function info() {
        return array(
            'name' => array(
                'en' => 'OTT Registrasi'
            ),
            'description' => array(
                'en' => 'Registrasi Mobile OTT'
            ),
            'frontend' => true,
            'backend' => true,
            'skip_xss' => true,
            'menu' => 'content',
        );
    }

    public function install() {
        $this->dbforge->drop_table('inn_ott_registrasi');
        //$this->db->delete('settings', array('module' => 'sample'));    //Maybe usefull for future projects

        $ott_registrasi_table = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => TRUE
            ),
            'subscriberID' => array(
                'type' => 'VARCHAR',
                'constraint' => '60'
            ),
            'custPhone' => array(
                'type' => 'VARCHAR',
                'constraint' => '60'
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'email_key' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            ),
            'custName' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
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
            'created' => array(
                'type' => 'DATETIME',
                'null' => FALSE,
                'default' => '0000-00-00 00:00:00'
            ),
        );

        $this->dbforge->add_field($ott_registrasi_table);
        $this->dbforge->add_key('id', TRUE);

        if ($this->dbforge->create_table('inn_ott_registrasi')) {
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
