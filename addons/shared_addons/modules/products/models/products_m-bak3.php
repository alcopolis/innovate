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
	
	/** @var array The validation rules */
	public $product_rules = array(
			'product_name' => array(
					'field' => 'product_name',
					'label' => 'Name',
					'rules' => 'trim|htmlspecialchars|required|max_length[200]|xss_clean'
			),
			'product_slug' => array(
					'field' => 'product_slug',
					'label' => 'Slug',
					'rules' => 'trim|required|alpha_dot_dash|max_length[200]|xss_clean'
			),
	);
	
	
	
//  Rules ini tempatnya di package_m
//
// 	public $package_rules = array(
// 			'package_name' => array(
// 					'field' => 'package_name',
// 					'label' => 'Name',
// 					'rules' => 'trim|htmlspecialchars|max_length[200]'
// 			),
// 			'package_slug' => array(
// 					'field' => 'package_slug',
// 					'label' => 'Slug',
// 					'rules' => 'trim|alpha_dot_dash|max_length[200]'
// 			)
// 	);
	
	
	
	//Start Product Model
	protected $product;
	
	public function __construct() {
		parent::__construct();
		$this->_table = 'inn_products_data';
	}
	
	
	//Get data produk dan paket2nya sesuai dengan slug input
	public function get_product($id = NULL){	
		$prod_query = new stdClass();
		
		if($id == NULL || $id == ''){
			$prod_query = $this->db->get($this->_table)->result();
		}else{
			$prod_query->data = $this->db->where('product_id', $id)->get($this->_table)->row();
			$prod_query->packages = $this->get_packages($prod_query->data->product_id);
		}
		
		return $prod_query;
	}
	
	
	public function get_product_by($fields = NULL, $condition = NULL, $single = FALSE){
		$method = 'result';
		
		if($fields != NULL){
			$this->db->select($fields);
		}
		
		if($condition != NULL){
			$this->db->where($condition);
		}
		
		if($single){
			$method = 'row';
		}else{
			$method = 'result';
		}
		
		return $this->db->get($this->_table)->$method();
	}
	
	
	public function get_packages($id = NULL){
		$packages_table = 'inn_products_packages';
		
		if($id != NULL || $id != ''){
			return $this->db->where('package_prod_id', $id)
							->get($packages_table)->result();
		}
	}
	
	
	public function update_product($id, $data){
		$this->db->where('product_id', $id);
		
		if($this->db->update($this->_table, $data)){
			return TRUE;
		}else{
			return FALSE;
		}		
	}

}