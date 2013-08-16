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
	

	public function get_packages($fields = '', $single = false){
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
	
	public function get_packages_by($fields, $where, $single = false){
		$this->db->where($where);
		return $this->get_packages($fields, $single);
	}

}