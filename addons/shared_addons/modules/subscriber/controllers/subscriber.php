<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Subscriber Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */
class Subscriber extends Public_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('subscriber_m');
		$this->load->library('form_validation');
		$this->lang->load('subscriber');
	}
	
	public function process(){
		$return_json = '';
		
		$email = $this->input->post('email');
		
		if($email != 'Enter your email address'){
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			
			if($this->form_validation->run()){
				$exist = $this->subscriber_m->process($email);
				$return_json = '{"email_check":"ok", "email":"' . $email . '", "exist":"' . $exist . '"}';
			}else{
				$return_json = '{"email_check":"invalid", "email":"' . $email . '"}';
			}
		}else{
			$return_json = '{"email_check":"no input"}';
		}
		
		echo $return_json;
	}
}