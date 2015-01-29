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
class Category_m extends MY_Model
{
	protected $category = array();
	protected $preset_category = array();

	public function __construct() {
		parent::__construct();
		$this->_table = 'inn_promotion_category';
	}
	
	function get_category($field = '', $return_all = FALSE){
		if($field != ''){
			$this->db->select($field);
		}
		
		$method = 'result';
		
		$return_all ? $method = 'result' : $method = 'row';
		
		return $this->db->get($this->_table)->$method();
	}
	
	function get_category_by($where = NULL, $field = '', $return_all = FALSE){
		$this->db->where($where);
		return $this->get_category($field, $return_all);
	}

}