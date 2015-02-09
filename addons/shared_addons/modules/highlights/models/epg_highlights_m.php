<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Epg_Highlights_m extends MY_Model {
	
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
	
	
	public function add_new(){
		$ch = new stdClass();
		
		$ch->name = '';
		$ch->num = NULL;
		$ch->cat = 0;
		$ch->desc = '';
		$ch->hd = 0;
		$ch->is_active = 0;
		$ch->logo = '';
		return $ch;
	}
	
	
	public function __construct()
	{		
		parent::__construct();
		$this->_table = 'inn_epg_highlights';
	}
	
	
	public function get_highlights($fields = NULL, $single = FALSE)
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
	
	
	public function get_highlights_by($where = NULL, $fields = NULL, $single = FALSE)
	{
		$method = 'result';
		
		if($single){
			$method = 'row';
		}
		
		if(isset($where)){
			$this->db->where($where);	
		}
		
		return $this->get_highlights($fields, $single);
	}
	
	
	public function get_all_highlights()
	{
		$this->db->select('t0.*');
		$this->db->select('t1.name');
		$this->db->from('default_inn_epg_highlights t0');
		$this->db->join('default_inn_epg_ch_detail t1','t1.id = t0.ch_id','left');
		
// 		var_dump($this->db->get()->result());
// 		die();
		return $this->db->get()->result();
	}
}