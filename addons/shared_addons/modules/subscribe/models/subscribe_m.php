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
						'label' => 'Nama Depan',
						'rules' => 'trim|required|xss_clean',
				),
				'last_name' => array(
						'field' => 'last_name',
						'label' => 'Nama Belakang',
						'rules' => 'trim|required|xss_clean',
				),
				'email' => array(
						'field' => 'email',
						'label' => 'Email',
						'rules' => 'trim|required|valid_email|is_unique[default_inn_subscribe.email]|xss_clean',
				),
				'address' => array(
						'field' => 'address',
						'label' => 'Alamat',
						'rules' => 'required|min_length[10]|xss_clean',
				),
				'city' => array(
						'field' => 'city',
						'label' => 'Kota',
						'rules' => 'trim|required|xss_clean',
				),
				'area_code' => array(
						'field' => 'area_code',
						'label' => 'Kode Area',
						'rules' => 'trim|required|numeric|xss_clean',
				),
				'phone' => array(
						'field' => 'phone',
						'label' => 'Telepon',
						'rules' => 'trim|required|numeric|xss_clean',
				),
				'mobile' => array(
						'field' => 'mobile',
						'label' => 'Mobile Phone',
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
		$subscriber->city = '';
		$subscriber->area_code = '';
		$subscriber->phone = '';
		$subscriber->mobile = '';
		$subscriber->email = '';
		
		return $subscriber;
	}
	
	public function get_subscriber($fields = '', $single = false){
		if($fields != '' || $fields != NULL){
			$this->db->select($fields);
		}
		
		if($single){
			$method = 'row';
		}else{
			$method = 'result';
		}
		
		return $this->db->get($this->_table)->$method();
	}
	
	public function get_subscriber_by($fields, $where, $single = false){
		$this->db->where($where);
		return $this->get_subscriber($fields, $single);
	}
	
	
	
	
	//UTILITY FUNCTION
	
	//Get the data ID from db insert operation
	public function get_id(){
		$query = $this->db->query('SELECT LAST_INSERT_ID()');
		$row = $query->row_array();
	
		return $row['LAST_INSERT_ID()'];
	}
	
	//Count Result Data
	public function count_subscriber(){
// 		$this->db->from($this->_table);

		$query = $this->db->get($this->_table);
		return $query->num_rows();
		
		//return $this->db->count_all_results();
	}
}