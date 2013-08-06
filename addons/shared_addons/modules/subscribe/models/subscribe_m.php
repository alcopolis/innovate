<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Subscriber_m extends MY_Model {
	
	public $_rules = array(
				'first_name' => array(
						'field' => 'first_name',
						'label' => 'First Name',
						'rules' => 'trim|required|max_length[20]|xss_clean',
				),
				'last_name' => array(
						'field' => 'last_name',
						'label' => 'Last Name',
						'rules' => 'trim|required|max_length[20]|xss_clean',
				),
				'address' => array(
						'field' => 'address',
						'label' => 'Address',
						'rules' => 'required|xss_clean',
				),
				'phone' => array(
						'field' => 'Phone',
						'label' => 'Phone',
						'rules' => 'required|max_length[20]|xss_clean',
				),
				'mobile' => array(
						'field' => 'mobile',
						'label' => 'Mobile Phone',
						'rules' => 'required|max_length[20]|xss_clean',
				),
				'email' => array(
						'field' => 'Email',
						'label' => 'Email Address',
						'rules' => 'required|max_length[100]|xss_clean',
				),
			);
	
	public function __construct()
	{		
		parent::__construct();
		
		/**
		 * If the sample module's table was named "samples"
		 * then MY_Model would find it automatically. Since
		 * I named it "sample" then we just set the name here.
		 */
		$this->_table = 'inn_subscribe';
	}
	
	//View all subscriber
// 	public function index($email)
// 	{
// 		return array('asdd','asdf');
// 	}
	
	//Add subscriber
// 	public function process($email)
// 	{		
				
// 		//Check duplicate		
// 		if($this->count_by('email',$email) > 0){
// 			$exist = 'yes';
// 		}else{
// 			$exist = 'no';
// 			$data = array(
// 					'email' => $email
// 			);
// 			$this->insert($data);
// 		}
		
// 		return $exist;
// 	}

	
}