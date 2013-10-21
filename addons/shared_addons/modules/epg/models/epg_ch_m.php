<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Epg_Ch_m extends MY_Model {
	
	/** @var array The validation rules */
	public $rules = array(
			'name' => array(
					'field' => 'name',
					'label' => 'Channel Name',
					'rules' => 'trim|required|max_length[100]|xss_clean'
			),
			'num' => array(
					'field' => 'num',
					'label' => 'Channel Number',
					'rules' => 'trim|required|max_length[3]|xss_clean'
			),
	);
	
	
	
	
	public function __construct()
	{		
		parent::__construct();
		$this->_table = 'inn_epg_ch_detail';
	}
	

	public function get_all_channel()
	{
// 		$this->db->select('id, name, num, cat, desc, logo');
// 		$this->db->from('default_inn_epg_ch_detail');
		
		
		$this->db->select('t0.id, t0.name, t0.num, t1.cat, t0.is_active, t0.desc, t0.logo');
		$this->db->from('default_inn_epg_ch_detail t0');
		$this->db->join('default_inn_epg_ch_category t1' ,'t1.id = t0.cat'); 
		
		return $this->db->get()->result();
	}
	
	public function count_channel(){
		$this->db->from($this->_table);
		return $this->db->count_all_results();
	}
	
	
	public function get_channel($id = NULL)
	{
		//$this->db->select('name, num');
		$this->db->where('id',$id);
		return $this->db->get($this->_table)->row();
	}
	
	public function get_channel_by($where, $fields = '', $single = FALSE)
	{
		if($single){
			$method = 'row';
		}else{
			$method = 'result';
		}
		
		if($fields != ''){
			$this->db->select(fields);
		}else{
			$this->db->select('*');
		}
		
		$this->db->where($where);
		return $this->db->get($this->_table)->$method();
	}
	
	public function add_channel(){
		//echo 'Added';
	}
	
	
	public function update_channel($id, $data){
		$this->db->where('id', $id);
		
		if($this->db->update($this->_table, $data)){
			return TRUE;
			echo 'TRUE';
		}else{
			return FALSE;
			echo 'FALSE';
		}
	}
	
	public function get_categories()
	{
		return $this->db->get('inn_epg_ch_category')->result();
	}
	
	public function get_category_by($where, $single = FALSE)
	{
		$method = 'result';
		
		if($single){
			$method = 'row';
		}
		
		if(isset($where)){
			$this->db->where($where);	
		}
		
		return $this->db->get('inn_epg_ch_category')->$method();
	}
}