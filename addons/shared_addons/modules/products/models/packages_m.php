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
class Packages_m extends MY_Model
{
	public function __construct() {
		parent::__construct();
		
		$this->_table = 'inn_products_packages';
		$field_table = 'inn_products_package_field';
	}
	
	//Get data produk dan paket2nya sesuai dengan slug input
	public function get_packages($id = NULL){	
		$pack_query = new stdClass();
		
		if($id == NULL || $id == ''){
			$pack_query = $this->db->get($this->_table)->result();
		}else{
			$pack_query->data = $this->db->where('package_id', $id)->get($this->_table)->row();
		}
		
		return $pack_query;
	}
	
	
	public function get_packages_by($fields = NULL, $condition = NULL, $single = FALSE){
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
	

}