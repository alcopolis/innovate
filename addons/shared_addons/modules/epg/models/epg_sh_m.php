<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Epg_Sh_m extends MY_Model {
	
	public function __construct()
	{		
		parent::__construct();
		
		/**
		 * If the sample module's table was named "samples"
		 * then MY_Model would find it automatically. Since
		 * I named it "sample" then we just set the name here.
		 */
		$this->_table = 'inn_epg_show_detail';
	}
	
	//View all subscriber
	public function index($email)
	{
		return array('asdd','asdf');
	}
	
	// how to get featured channel of the month
	public function get_featured_show()
	{
		$bln=date("m"); 
		$thn=date("Y");
		$hari= date("Y-m-d");
		$this->db->SELECT('t0.cid as channelid'); 
		$this->db->SELECT('t0.title as title');
		$this->db->SELECT('t0.date as tanggal');
		$this->db->SELECT('t0.time as jam');
		$this->db->SELECT('t0.syn_id as ina');
		$this->db->SELECT('t0.syn_en as eng');
		$this->db->SELECT('t0.poster as poster');
		$this->db->from('default_inn_epg_show_detail t0');
		$this->db->where('t0.poster',1);
		$this->db->where('t0.date',$hari);
		
		return $this->db->get()->result();
	}
	
	public function get_today_show()
	{
		$hari= date("Y-m-d");
		$this->db->SELECT('t0.cid as channelid'); 
		$this->db->SELECT('t0.title as title');
		$this->db->SELECT('t0.date as tanggal');
		$this->db->SELECT('t0.time as jam');
		$this->db->SELECT('t0.syn_id as ina');
		$this->db->SELECT('t0.syn_en as eng');
		$this->db->SELECT('t0.poster as poster');
		$this->db->from('default_inn_epg_show_detail t0');
		$this->db->where('t0.date',$hari);
		
		return $this->db->get()->result();
	}
	
	//Functionality
	public function add(){}
	
	public function edit(){}
	
	public function del(){}
	
	public function search(){}
}