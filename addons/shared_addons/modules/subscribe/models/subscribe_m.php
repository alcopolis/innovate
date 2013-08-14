<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Subscribe_m extends MY_Model {
	
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
				'email' => array(
						'field' => 'email',
						'label' => 'Email',
						'rules' => 'required|valid_email|is_unique[users.email]|xss_clean',
				),
				'address' => array(
						'field' => 'address',
						'label' => 'Address',
						'rules' => 'required|xss_clean',
				),
				'area_code' => array(
						'field' => 'area_code',
						'label' => 'Area Code',
						'rules' => 'trim|required|numeric|xss_clean',
				),
				'phone' => array(
						'field' => 'phone',
						'label' => 'Phone',
						'rules' => 'trim|required|numeric|xss_clean',
				),
				'mobile' => array(
						'field' => 'mobile',
						'label' => 'Mobile',
						'rules' => 'trim|required|numeric|xss_clean',
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
	
	
	public function get_new(){
		$subscriber =  new stdClass();
		
		$subscriber->first_name = '';
		$subscriber->last_name = '';
		$subscriber->address = '';
		$subscriber->area_code = '';
		$subscriber->phone = '';
		$subscriber->mobile = '';
		$subscriber->email = '';
		
		return $subscriber;
	}
	
	
}