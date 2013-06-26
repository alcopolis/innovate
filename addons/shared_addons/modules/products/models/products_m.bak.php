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
		$this->load->model('packages_m');
	}
	
	
	//Get data produk dan paket2nya sesuai dengan slug input
	public function get($slug){		
		$product = new stdClass();
		
		//Get product record
		$product->attribute = $this->db->get_where($this->_table, array('product_slug' => $slug))->row_array();
		
		//Get product packages record
		$this->db->select('*');
		$this->db->from('inn_products_packages');
		$this->db->where('package_prod_id', intval($product->attribute['product_id']));
		
		$product->packages = $this->db->get()->result_array();
		
		//Get custom package fields record
		foreach($product->packages as $key=>$package){
			$this->db->select('field_name, field_value');
			$this->db->from('inn_products_packages_field');
			$this->db->where('package_id', intval($package['package_id']));
			$product->packages[$key]['fields'] = $this->db->get()->result_array();
			
			
			//var_dump($product->packages[$key]['fields']);
		}
		var_dump($product);
		echo '<br>';
		
		return $product;
	}
	
	//Get semua data produk saja
	public function get_all(){
		$q = $this->db->get($this->_table);
		return $q;		
	}
	
	
	public function insert($data, $skip_validation = false){		
		var_dump($data);
	}
	
	public function update($id, $data, $skip_validation = false){
		foreach($data as $key=>$value){
			echo $key . ' => ' . $value . '<br/>';
		}
		
		$this->db->where('product_id', $id);
		$this->db->update($this->_table, $data);
	}
	
	
	public function delete($id=NULL){
		return 'delete method';
	}
	
	
	//Get data for frontend rendering
	public function render($slug){
// 		if(isset($slug) && $slug != ''){			
// 			//return 'data raw';
// 			$raw->product = $this->get($slug);
// 			$raw->packages = $this->packages_m->get_packages($slug);
// 		}
	}
}