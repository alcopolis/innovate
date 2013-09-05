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
	public $_rules = array(
			'name' => array(
					'field' => 'name',
					'label' => 'name',
					'rules' => 'trim|required|xss_clean',
			),
			'slug' => array(
					'field' => 'slug',
					'label' => 'slug',
					'rules' => 'trim|required|xss_clean',
			),
			'price' => array(
					'field' => 'price',
					'label' => 'price',
					'rules' => 'required|numeric',
			),
			'body' => array(
					'field' => 'body',
					'label' => 'body',
					'rules' => 'xss_clean',
			),
			'group' => array(
					'field' => 'group',
					'label' => 'group',
					'rules' => 'xss_clean',
			),
		);
	
	
	public function __construct() {
		parent::__construct();
		
		//$this->_table = 'inn_products_packages';
		$this->_table = 'inn_products_packages_copy';
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