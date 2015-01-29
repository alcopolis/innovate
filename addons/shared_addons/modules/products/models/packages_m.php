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
	protected $_table = 'inn_products_packages';
	protected $group_table = 'inn_products_packages_group';
	
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
					'rules' => 'required',
			),
			'body' => array(
					'field' => 'body',
					'label' => 'body',
					'rules' => 'xss_clean',
			),
			'group_id' => array(
					'field' => 'group_id',
					'label' => 'group_id',
					'rules' => 'xss_clean',
			),
		);
	
	
	public function __construct() {
		parent::__construct();
		//$field_table = 'inn_products_package_field';
	}
	

	public function get_packages($fields = '', $single = false){
		if($fields != '' || $fields != NULL){
			$this->db->select($fields);
		}
		
		$query = $this->db->get($this->_table);
		
		if($single){
			$method = 'row';
		}else{
			$method = 'result';
		}

		
		if($query->num_rows() > 0){
			return  $query->$method();
		}else{
			return NULL;
		}
		
		$this->db->flush_cache();
	}
	
	public function get_packages_by($fields, $where, $single = false){
		$this->db->where($where);
		return $this->get_packages($fields, $single);
	}
	
	public function update_package($id, $data){
		$this->db->where('id', $id);
	
		if($this->db->update($this->_table, $data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	
	
	//UTILITY FUNCTION
	//Get package group
	public function get_group($fields = '', $single = false){
		$method = 'result';
		
		if($fields != '' || $fields != NULL){
			$this->db->select($fields);
		}
	
		if($single){
			$method = 'row';
		}else{
			$method = 'result';
		}
		
		return $this->db->get($this->group_table)->$method();
	}
	
	public function get_group_by($where, $single, $fields){
		$this->db->where($where);
		return $this->get_group($fields, $single);
	}
	
	
	
	//Get the data ID from db insert operation
	public function get_id(){
		$query = $this->db->query('SELECT LAST_INSERT_ID()');
		$row = $query->row_array();
	
		return $row['LAST_INSERT_ID()'];
	}

}