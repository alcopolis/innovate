<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Regular pages model
 *
 * @author Phil Sturgeon
 * @author Jerel Unruh
 * @author PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Pages\Models
 *
 */
class Products_m extends MY_Model
{
		
	protected $_table = 'inn_products_data_copy';
	
	public $_rules = array(
			'name' => array(
					'field' => 'name',
					'label' => 'name',
					'rules' => 'trim|required|max_length[100]|xss_clean'
			),
			'slug' => array(
					'field' => 'slug',
					'label' => 'slug',
					'rules' => 'trim|required|alpha_dot_dash|max_length[200]|xss_clean'
			),
			'teaser' => array(
					'field' => 'teaser',
					'label' => 'teaser',
					'rules' => 'max_length[200]|xss_clean'
			),
			'body' => array(
					'field' => 'body',
					'label' => 'body',
					'rules' => 'xss_clean'
			),
	);
	
	
	
	public function __construct() {
		parent::__construct();
	}
	
	
	//Get data produk dan paket2nya sesuai dengan id input
	public function get_product($fields = NULL, $single = FALSE)
	{
	
		if($fields != NULL){
			$this->db->select($fields);
		}
	
		if($single){
			$method = 'row';
		}else{
			$method = 'result';
		}
		
		$this->db->from('default_inn_products_data_copy t0');
		$this->db->join('default_inn_products_packages_copy t1','t1.prod_id = t0.id','LEFT');
		
		//return $this->db->get($this->_table)->$method();
		return $this->db->get()->result();
	}
	
	
	public function get_product_by($fields, $where, $single = FALSE){
		$this->db->where($where);
		return $this->get_product($fields, $single);
	}

}