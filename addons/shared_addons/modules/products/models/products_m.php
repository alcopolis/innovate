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
		
	protected $_table = 'inn_products_data';
	
	public $_rules = array(
			'name' => array(
					'field' => 'name',
					'label' => 'name',
					'rules' => 'trim|required|max_length[100]|xss_clean'
			),
			'slug' => array(
					'field' => 'slug',
					'label' => 'slug',
					'rules' => 'trim|required|alpha_dot_dash|max_length[200]|xss_clean'
			),
			'teaser' => array(
					'field' => 'teaser',
					'label' => 'teaser',
					'rules' => 'max_length[200]|xss_clean'
			),
			'body' => array(
					'field' => 'body',
					'label' => 'body',
					'rules' => 'xss_clean'
			),
	);
	
	
	
	public function __construct() {
		parent::__construct();
	}
	
	
	public function add_new(){
		$prod = new stdClass();
		
		$prod->name = '';
		$prod->slug = '';
		$prod->teaser = '';
		$prod->body = '';
		$prod->section = '';
		$prod->css = '';
		$prod->js = '';
		$prod->is_featured = '';
		$prod->tags = '';
		
		return $prod;
	}
	
	//Get data produk dan paket2nya sesuai dengan id input
	public function get_product($fields = NULL, $single = FALSE)
	{
	
		if(isset($fields)){
			$this->db->select($fields);
		}
	
		if($single){
			$method = 'row';
		}else{
			$method = 'result';
		}
				
		return $this->db->get($this->_table)->$method();
	}
	
	
	public function get_product_by($fields, $where, $single){
		if(isset($where)){
			$this->db->where($where);
		}
		
		return $this->get_product($fields, $single);
	}
	
	
// 	public function get_packages_for_product($id){
// 		$this->db->select('t1.*');
		
// 		$this->db->from('default_inn_products_data_copy t0');
// 		$this->db->join('default_inn_products_packages_copy t1','t1.prod_id = t0.id','LEFT');
// 		$this->db->where('t0.id', $id);

// 		return $this->db->get()->result();
// 	}

}