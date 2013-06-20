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
	}
	
	public function get($slug){
		$q = $this->db->get_where($this->_table, array('slug' => $slug));
		
		if($q->num_rows() > 0){
			return $q->row();
		}
	}
	
	public function get_all(){
		$q = $this->db->get($this->_table);
	
		return $q;
	}
	
	public function update($primary_value = NULL, $data = NULL, $skip_validation = false){
		return 'update method';
	}
	
	public function delete($id=NULL){
		return 'delete method';
	}
}