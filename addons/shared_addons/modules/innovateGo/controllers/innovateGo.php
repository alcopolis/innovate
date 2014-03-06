<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Subscriber Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */
class InnovateGo extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->innovateGo = 0;
        $this->ADMIN_PATH = base_url() . 'admin';

        $this->load->model('innovateGo_m');
//        $this->packages_m = $this->load->model('products/packages_m');

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('alcopolis');

        // Set our validation rules
        $this->rules = $this->innovateGo_m->_rules;
        $this->form_validation->set_rules($this->rules);
        $this->form_validation->set_error_delimiters('<small style="color:red;">', '</small>');
        $this->form_validation->set_message('is_unique', 'You have been signed up with this %s');

        $this->packages = new stdClass();
//        $this->packages->inet = $this->packages_result($this->packages_m->get_packages_by(NULL, array('group_id' => '1'), FALSE), 'Internet Super Cepat');
//        $this->packages->tv = $this->packages_result($this->packages_m->get_packages_by(NULL, array('group_id' => '2'), FALSE), 'Televisi Starter');
    }

    function render($view, $var = NULL) {
        $this->template
                ->title($this->module_details['name'])
                ->append_css('module::preview.css')
                ->append_js('module::modernizr.js')
                ->append_js('module::jquery-1.9.1.js')
                ->append_js('module::bootstrap.js')
                ->append_js('module::respond.src.js')
                ->append_js('module::jquery.icheck.js')
                ->append_js('module::placeholders.min.js')
                ->append_js('module::waypoints.min.js')
                ->append_js('module::jquery.panelSnap.js')
                ->set('innovateGo', $this->innovateGo)
                ->set('packages', $this->packages)
                ->set($var)
                ->build($view);
    }

    public function index() {
        if ($this->form_validation->run()) {
            $nowadate = date('Y-m-d h:i:s');
            $user = array(
                'custName' => $this->input->post('custName'),
                'custPhone' => $this->input->post('custPhone'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => do_hash($this->input->post('password'), 'MD5'),
                'email_key' => do_hash($nowadate, 'MD5'),
                'subscriberID' => $this->input->post('username'),
                'created' => $nowadate
            );
            $id_user = $this->innovateGo_m->save_innovateGo($id = NULL, $user);
            if ($id_user) {
                $this->innovateGo_m->send_email_activation($id_user);
            }
            redirect('innovateGo/success');
        } else {
            $this->render('go');
        }
    }

    public function success() {
        $data['success'] = 'Terima kasih telah mendaftar account Innovate Go bersama kami, kami telah mengirimkan email aktivasi ke email anda';
        $this->render('go', $data);
    }

    public function email_activation() {
        $id = $this->uri->segment(3);
        $email_key = $this->uri->segment(4);
        if ($this->innovateGo_m->activate_user($id, $email_key)) {
            $this->innovateGo_m->send_to_product($id);
            $data['success'] = 'Terima Kasih! Account Innovate Go anda telah aktif';
            $this->render('go', $data);
        } else {
            $data['success'] = 'Mohon maaf account anda telah aktif sebelumnya';
            $this->render('go', $data);
        }
    }

}
