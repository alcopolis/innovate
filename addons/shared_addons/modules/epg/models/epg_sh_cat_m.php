<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Epg_Sh_Cat_m extends MY_Model {
	
	public function __construct()
	{		
		parent::__construct();
		$this->_table = 'inn_epg_show_category';
	}
	
	
	public function get_categories()
	{
		return $this->db->get($this->_table)->result();
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
		
		return $this->db->get($this->_table)->$method();
	}
	
}