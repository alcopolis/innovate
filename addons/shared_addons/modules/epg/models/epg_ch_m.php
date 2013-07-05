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
	
	public function __construct()
	{		
		parent::__construct();
		
		/**
		 * If the sample module's table was named "samples"
		 * then MY_Model would find it automatically. Since
		 * I named it "sample" then we just set the name here.
		 */
		$this->_table = 'inn_epg_ch_detail';
	}
	
	//View all subscriber
	public function index($email)
	{
		return array('asdd','asdf');
	}
	
	//Functionality
	// get all channel list for the admin page editor
	public function get_all_channel()
	{
		$this->db->select('default_inn_epg_ch_detail.id');
		$this->db->select('default_inn_epg_ch_detail.`name`');
		$this->db->select('default_inn_epg_ch_detail.num');
		$this->db->select('default_inn_epg_ch_detail.`desc`');
		$this->db->select('default_inn_epg_ch_detail.logo');
		$this->db->select('default_inn_epg_show_category.cat');
		$this->db->from('default_inn_epg_ch_detail');
		$this->db->join('default_inn_epg_show_category' ,'default_inn_epg_show_category.id = default_inn_epg_ch_detail.cat'); 
		
		return $this->db->get()->result();
	}
	
	public function add(){}
	
	public function edit(){}
	
	public function del(){}
	
	public function search()
	{
			
	}
}