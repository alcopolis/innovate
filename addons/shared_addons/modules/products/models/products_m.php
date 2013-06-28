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
	protected $_table_name = '';
	protected $_primary_key = '';
	protected $_primary_filter = 'string';
	
	//Start Product Model
	protected $product;
	

	public function __construct() {
		parent::__construct();
		$this->_table = 'inn_products_data';
		$this->load->model('packages_m');
	}
	
	
	//Get data produk dan paket2nya sesuai dengan slug input
	public function get($slug){	
		$this->product = new stdClass();
		
		//Get product record
		$this->product->attribute = $this->db->get_where($this->_table, array('product_slug' => $slug))->row();
		
		//Get product packages record
		$this->db->select('*');
		$this->db->from('inn_products_packages');
		$this->db->where('package_prod_id', intval($this->product->attribute->product_id));
		
		//$this->product->packages = $this->db->get()->result_object();
		
		foreach($this->db->get()->result_object() as $key=>$package){
			$this->product->packages[$key] = $package;
			
			$this->db->select('field_name, field_value');
			$this->db->from('inn_products_packages_field');
			$this->db->where('package_id', intval($package->package_id));
			
			$fields = $this->db->get()->result_object();
			$this->product->packages[$key]->fields = $fields;
		}
		
		return $this->product;
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
	
	
	



//-------------------------------------------------------------------------------------//
	
	public function inn_get($prefix, $value = NULL, $key = NULL, $single = FALSE){

		//$this->db->cache_delete();
		
		if($prefix != NULL || $prefix != ''){
			switch($prefix){
				case 'product':
					$this->_table = 'inn_products_data';
					$this->_primary_key = 'product_' . $key;
					break;
				case 'package':
					$this->_table = 'inn_products_packages';
					$this->_primary_key = 'package_' . $key;
					break;
				case 'field':
					$this->_table = 'inn_products_packages_field';
					$this->_primary_key = 'field_' . $key;
					break;
			}
			
			if($value != NULL || $value != ''){
				$method = 'row';
				$this->db->where($this->_primary_key, $value);
			}elseif($single == TRUE){
				$method = 'row';
			}else{
				$method = 'result';
			}

			return $this->db->get($this->_table)->$method();
		}	
	}
	
	
	public function inn_get_by($prefix, $where, $single = FALSE){
		$this->db->where($where);
		return $this->inn_get($prefix, NULL, NULL, $single);
	}
	
	
	public function inn_construct_data($prod_id){
		$this->db->select(
			't1.package_name,
			t1.package_slug,
			t1.package_price,
			t1.package_body,
			t1.package_group,
			t2.field_name,
			t2.field_value'
		);
		$this->db->from('default_inn_products_data t0');
		$this->db->join('default_inn_products_packages t1','t1.package_prod_id = t0.product_id','LEFT');
		$this->db->join('default_inn_products_packages_field t2', 't2.package_id = t1.package_id', 'LEFT');
		$this->db->where('t0.product_id', $prod_id);
		
		return $this->db->get()->result();
		
	}
}