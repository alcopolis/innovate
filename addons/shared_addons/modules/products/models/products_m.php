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
	
	//Get data by request
	public function get_parts($field=NULL, $table=NULL, $where=NULL){
		$part = new stdClass();
		
		$this->db->select($field);
		$this->db->from($table);
		$this->db->where($where);
		
		return $this->db->get()->result();
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
	
}