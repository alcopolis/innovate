<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Hl_Programs_m extends MY_Model {
	
	/** @var array The validation rules */
	public $rules = array(
			'title' => array(
					'field' => 'title',
					'label' => 'Program TItle',
					'rules' => 'trim|required|max_length[100]|xss_clean'
			),
	);
	
	
	public function add_new(){
		$hl = new stdClass();
		
		$hl->ch_id = 0;
		$hl->title = '';
		$hl->slug = '';
		$hl->sinopsis = '';
		$hl->poster = '';
		$hl->show_time = NULL;
		$hl->start_date = NULL;
		$hl->end_date = NULL;
		$hl->modify = NULL;
		$hl->status = 'inactive';
		
		return $hl;
	}
	
	
	public function __construct()
	{		
		parent::__construct();
		$this->_table = 'inn_highlights_programs';
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
		$this->db->from('default_inn_highlights_programs t0');
		$this->db->join('default_inn_epg_ch_detail t1','t1.id = t0.ch_id','left');
		
		return $this->db->get()->result();
	}
	
	
	public function compile_highlights($where = NULL, $cat = NULL){
		$catID = NULL;
		
		if(isset($cat) && $cat !== ''){
			$this->db->select('id');
			$this->db->where('cat', $cat);
			$catID = $this->db->get('default_inn_epg_ch_category')->row()->id;
		}
		
		if(isset($where)){			
			$this->db->select('t0.*');
			$this->db->select('t1.name, t1.logo');
			$this->db->select('t2.path, t2.description');
			$this->db->from('inn_highlights_programs t0');
			$this->db->join('inn_epg_ch_detail t1', 't1.id = t0.ch_id','left');
			$this->db->join('files t2', 't2.id = t0.poster','left');
		
			$this->db->where($where);
			if(isset($cat)){
				$this->db->where('t1.cat', $catID);
			}
			
			return $this->db->get()->result();
		}	

		
	}
}