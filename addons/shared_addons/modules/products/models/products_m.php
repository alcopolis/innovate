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
	
	//Start Product Model
	
	public function __construct() {
		parent::__construct();
		
		
		$this->_table = 'inn_products_data';
	}
	
	
	public function get($slug){
// 		$this->db->select('inn_products_data.*');
// 		$this->db->select('inn_products_packages.*');
// 		$this->db->from('inn_products_data');
// 		$this->db->join('inn_products_packages', 'inn_products_data.id = inn_products_packages.package_prod_id');
// 		$this->db->where('product_slug', $slug);
		
// 		$q = $this->db->get();
		
// 		if($q->num_rows() > 0){
// 			var_dump($q->row());
// 			return $q->row();
// 		}
		

		//$q = $this->db->get_where($this->_table, array('product_slug' => $slug));
		
		$product = new stdClass();
		
		//Get product record
		$product->data = $this->db->get_where($this->_table, array('product_slug' => $slug))->row();
		
		//Get product packages record
		$this->db->select('*');
		$this->db->from('inn_products_packages');
		$this->db->where('package_prod_id', intval($product->data->id));
		
		$product->packages = $this->db->get();
		
// 		for($i=0; $i < $product->packages->num_rows(); $i++){
// 			var_dump($product->packages->row($i));
// 		}

		return $product;
	}
	
	public function get_all(){
		$q = $this->db->get($this->_table);
	
		return $q;
	}
	
	
	
	public function insert($id = NULL, $data = array(), $skip_validation = FALSE){
		if($id){
			return 'update method';
		}else{
			return 'insert method';
		}
	}
	
	
	
	
	public function delete($id=NULL){
		return 'delete method';
	}
}