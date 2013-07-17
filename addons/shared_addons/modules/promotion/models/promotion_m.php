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
class Promotion_m extends MY_Model
{
	protected $promo;
	protected $method;
	
	public function __construct() {
		parent::__construct();
		$this->_table = 'inn_promotion';
	}
	
	public function get_promo($fields = '', $single = false){
		
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
	
	public function get_promo_by($fields, $where, $single = false){
		$this->db->where($where);
		return $this->get_promo($fields, $single);
	}
	
	
	
	//------- CRUD Function ----------//
	
	
	
}