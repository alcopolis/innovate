<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Ott_registrasi_m extends MY_Model {

    public $_rules = array(
        'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|is_unique[default_inn_ott_registrasi.email]|xss_clean',
        ),
        'custPhone' => array(
            'field' => 'custPhone',
            'label' => 'Nomor Telepon',
            'rules' => 'trim|required|numeric|xss_clean',
        ),
        'custName' => array(
            'field' => 'custName',
            'label' => 'Nama Lengkap',
            'rules' => 'required|xss_clean',
        ),
        'username' => array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|min_length[6]|is_unique[default_inn_ott_registrasi.username]|xss_clean',
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|xss_clean|min_length[5]|alpha_dash',
        ),
        'confirm_password' => array(
            'field' => 'confirm_password',
            'label' => 'Confirm Password',
            'rules' => 'trim|required|xss_clean|matches[password]',
        ),
    );

    public function __construct() {
        parent::__construct();

        /**
         * If the sample module's table was named "samples"
         * then MY_Model would find it automatically. Since
         * I named it "sample" then we just set the name here.
         */
        $this->_table = 'inn_ott_registrasi';
    }

    public function get_new() {
        $register = new stdClass();

        $register->id = '';
        $register->custID = '';
        $register->custName = '';
        $register->custPhone = '';
        $register->email = '';
        $register->subscriberID = '';

        return $register;
    }

    public function save_ott_registrasi($id, $data) {
        if ($id == NULL) { //save the profile
            if ($this->db->insert($this->_table, $data)) {
                $this->session->set_flashdata('notif', 'Data telah berhasil disimpan');
            } else {
                $this->session->set_flashdata('notif', 'Data gagal disimpan, silahkan coba beberapa saat lagi');
            }
        } else { //update the profile
            $this->result = $this->get_ott_registrasi_detail($id);
            $this->db->where('id', $id);
            if ($this->db->update($this->_table, $data)) {
                $this->session->set_flashdata('notif', 'Data telah berhasil disimpan');
            } else {
                $this->session->set_flashdata('notif', 'Data gagal disimpan, silahkan coba beberapa saat lagi');
            }
        }
        return $this->db->insert_id();
    }

    public function get_ott_registrasi_detail($id) {
        //$this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('id', $id);
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_subscriber($fields = '', $single = false) {
        if ($fields != '' || $fields != NULL) {
            $this->db->select($fields);
        }

        if ($single) {
            $method = 'row';
        } else {
            $method = 'result';
        }

        return $this->db->get($this->_table)->$method();
    }

    public function get_subscriber_by($fields, $where, $single = false) {
        $this->db->where($where);
        return $this->get_subscriber($fields, $single);
    }

    //UTILITY FUNCTION
    //Get the data ID from db insert operation
    public function get_id() {
        $query = $this->db->query('SELECT LAST_INSERT_ID()');
        $row = $query->row_array();

        return $row['LAST_INSERT_ID()'];
    }

    //Count Result Data
    public function count_subscriber() {
// 		$this->db->from($this->_table);

        $query = $this->db->get($this->_table);
        return $query->num_rows();

        //return $this->db->count_all_results();
    }

    public function send_email_activation($id_user) {
        $user = $this->get_ott_registrasi_detail($id_user);
        $msg = $this->generate_msg_email_activation($user);
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->from('webmaster@innovate-indonesia.com', 'Innovate OTT Email Activation');
        $this->email->to($user[0]->email);
        $this->email->cc('');
        $this->email->bcc('');
        $this->email->subject('Email Aktivasi');
        $this->email->message($msg);
        $this->email->send();
    }

    public function generate_msg_email_activation($user) {
        $msg = '
            Thanks for signing up! 
            Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below. 
 
            ------------------------ 
            subscriberID: ' . $user[0]->username . ' 
            ------------------------ 
 
            Please click this link to activate your account: 
 
            ' . site_url('ott_registrasi/email_activation/'. $user[0]->id . '/' . $user[0]->email_key);
        return $msg;
    }

    public function is_email_active($id) {
        $this->db->from($this->_table);
        $this->db->where('id', $id);
        $query = $this->db->get()->result();
        if ($query[0]->activated) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function activate_user($id, $email_key) {
        if ($this->is_email_active($id)) {
            $this->db->update($this->_table, array('activated' => 1), array('id' => $id, 'email_key' => $email_key));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function send_to_product($id_user) {
        $user = $this->get_ott_registrasi_detail($id_user);
        $msg = $this->generate_msg_to_product($user);
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = 'true';
		$config['priority'] = '1';
		$this->email->initialize($config);
        $this->load->library('email');
        $this->email->from('webmaster@innovate-indonesia.com', 'Innovate OTT Email Registration');
        $this->email->to('product@cepat.net.id');
        $this->email->cc('');
        $this->email->bcc('');
        $this->email->subject('Permohonan Berlangganan Innovate');
        $this->email->message($msg);
        $this->email->send();
    }

    public function generate_msg_to_product($data) {
        //send notification email to sales team
        $msg = '<p><strong>' . $data[0]->custName . '</strong> telah mengajukan permohonan berlangganan InnovateGO.</p>';
        $msg .= '<p>Mohon segera di follow up calon pelanggan ini dengan data berikut:</p>';
        $msg .= '<table><tr><td>Nama</td><td>: ' . $data[0]->custName . '</td></tr>';
        $msg .= '<tr><td>Subscriber ID</td><td>: ' . $data[0]->username . '</td></tr>';
        $msg .= '<tr><td>Telepon</td><td>: ' . $data[0]->custPhone . '</td></tr>';
        $msg .= '<tr><td>Email</td><td>: ' . $data[0]->email . '</td></tr></table>';
        //$msg .= '<p>Silahkan masuk ke <a href="' . $this->ADMIN_PATH . '">Admin Panel</a> untuk memproses permohonan ini.<br/><br/><br/><br/>Terima kasih.</p>';
		return $msg;
    }

}
