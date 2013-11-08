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
	
	protected $_table = 'inn_epg_show_detail';
	
	public $rules = array(
			'title' => array(
					'field' => 'title',
					'label' => 'Show Title',
					'rules' => 'trim|xss_clean'
			),
			'cid' => array(
					'field' => 'cid',
					'label' => 'Channel ID',
					'rules' => 'xss_clean'
			),
			'date' => array(
					'field' => 'date',
					'label' => 'Show Date',
					'rules' => 'xss_clean'
			),
			'syn_id' => array(
					'field' => 'syn_id',
					'label' => 'Sinopsis Indonesia',
					'rules' => 'trim|xss_clean'
			),
			'syn_en' => array(
					'field' => 'syn_en',
					'label' => 'Synopsis English',
					'rules' => 'trim|xss_clean'
			),
	);
	
	
	public $filter_rules = array(
			'date' => array(
					'field' => 'date',
					'label' => 'Show Date',
					'rules' => 'required|xss_clean'
			),
			'cat_id' => array(
					'field' => 'cat_id',
					'label' => 'Category ID',
					'rules' => 'xss_clean'
			)
	);
	
	
	
//=================== General Function ====================//
	
	public function __construct()
	{		
		parent::__construct();
		//$this->_table = 'inn_epg_show_detail';
	}
	
	
	public function get_show($fields = NULL, $single = FALSE)
	{
		$hari= date("Y-m-d");
	
		if($fields != NULL){
			$this->db->select($fields);
		}
	
		if($single){
			$method = 'row';
		}else{
			$method = 'result';
		}
	
		$this->db->where('date >=', $hari);
	
		return $this->db->get($this->_table)->$method();
	}
	
	
	public function get_show_by($fields, $where, $single = FALSE){
		$this->db->where($where);
		return $this->get_show($fields, $single);
	}
	
	public function get_show_detail($id){
		$this->db->select('t0.id, t0.title, t0.cid, t0.date, t0.time, t0.duration, t0.syn_id, t0.syn_en, t0.poster, t0.trailer');
		$this->db->select('t1.name, t1.num, t1.logo');
		$this->db->from('inn_epg_show_detail t0');
		$this->db->join('inn_epg_ch_detail t1', 't0.cid = t1.id', 'RIGHT');
		$this->db->where('t0.id',$id);
	
		return $this->db->get()->row();
	}
	
	

//=================== Admin Function ====================//
	
	

	public function featured_list(){
		$hari= date('Y-m-d');
		
		$this->db->select('t0.id, t0.cid, t0.cat_id, t0.title, t0.date, t0.time, t0.duration, t1.name');
		$this->db->from('inn_epg_show_detail t0');
		$this->db->join('inn_epg_ch_detail t1', 't1.id = t0.cid', 'LEFT');
		$this->db->where(array('t0.date>='=>$hari,'t0.is_featured'=> 1));
		$this->db->order_by('cid', 'ASC');
		$this->db->order_by('date', 'ASC');
		$this->db->group_by('title');
		
		return $this->db->get()->result();
	}
	
	
	public function similar_show($var = NULL, $fields = NULL, $limit = NULL){
		
		if(is_array($var)){
			if(isset($fields)){
				$this->db->select($fields);
			}
			
			if(isset($limit)){
				$this->db->limit($limit);
			}

			$this->db->where($var);
			return $this->db->get($this->_table)->result();
		}else{
			return FALSE;
		}
	}
	
	
	public function update_show_data($data){
		
	}
	

	
	
	
	
//=================== Frontend Function ====================//

	public function get_featured_show($category = NULL)
	{
		$bln=date("m");
		$thn=date("Y");
		$hari= date('Y-m-d');
	
		$harirange=date('Y-m-d',strtotime("+7 day"));
	
		$this->db->SELECT('t0.id as showid');
		$this->db->SELECT('t0.cid as channelid');
		$this->db->SELECT('t0.title as title');
		$this->db->SELECT('t0.date as tanggal');
		$this->db->SELECT('t0.time as jam');
		$this->db->SELECT('t0.syn_id as ina');
		$this->db->SELECT('t0.syn_en as eng');
		$this->db->SELECT('t0.poster as poster');
		$this->db->SELECT('t0.trailer as trailer');
		$this->db->SELECT('t1.name as chname');
		$this->db->from('inn_epg_ch_detail t1');
		
		$this->db->join('inn_epg_show_detail t0','t1.id = t0.cid','LEFT');
		
		if(isset($category)){
			$this->db->where('t0.cat_id', $category);
		}
		$this->db->where('t0.is_featured',1);
 		$this->db->where('t0.date >= ',$hari);
		$this->db->group_by('poster');
			
		return $this->db->get()->result();
	}
	
	
	
	public function count_featured_show(){
		$bln=date("m");
		$thn=date("Y");
		$hari= date("Y-m-d");
		
		$harirange=date('Y-m-d',strtotime("+7 day"));
		
		$this->db->from('inn_epg_show_detail');
		$this->db->where('is_featured',1);
		$this->db->where('date>=',$hari);
		$this->db->where('date<=',$harirange);
		
		return $this->db->count_all_results();
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

	
		
	public function get_count($fields = NULL)
	{
		$hari= date("Y-m-d");
	
		if($fields != NULL){
			$this->db->select($fields);
		}
	
		$this->db->where('date >=', $hari);	
		return $this->db->get($this->_table)->num_rows();
	}
	
	
	public function get_count_by($fields, $where){
		$this->db->where($where);
		return $this->get_count($fields);
	}
	
	
	
	
	
	
	
	
	
//============= EPG FUNCTION ===============
	
	
	public function get_epg($fields = NULL, $single = FALSE)
	{
		$data = new stdClass();
		$method = 'result';

		
		if($fields == NULL && !$single){
			$hari= date("Y-m-d");
			
			$chs = $this->db->where('is_active', 1)->order_by('name', 'asc')->get('inn_epg_ch_detail')->result();
			
			foreach($chs as $ch){
				$key = $ch->id;
			
				$data->$key = new stdClass();
				$data->$key->ch = $ch;
			
				$this->db->where('cid',$key);
				$this->db->where('date',$hari);
				$data->$key->sh = $this->db->get($this->_table)->result();
			}
		}else{
			$this->db->select($fields);
			
			if($single){
				$method = 'row';
			}else{
				$method = 'result';
			}
			
			$data = $this->db->get($this->_table)->$method();
		}
		
		return $data;
	}
	
	
	
	
	
	public function get_epg_by($where){
		$data = new stdClass();
		
		if($where['cat_id'] == '0'){
			$chs = $this->db->where('is_active', 1)->order_by('name', 'asc')->get('inn_epg_ch_detail')->result();
		}else{
			$chs = $this->db->where(array('is_active'=>1, 'cat'=>$where['cat_id']))->order_by('name', 'asc')->get('inn_epg_ch_detail')->result();
		}
		
			
		foreach($chs as $ch){
			$key = $ch->id;
				
			$data->$key = new stdClass();
			$data->$key->ch = $ch;

			$this->db->where('cid',$key);
			$this->db->where('date', $where['date']);
			$data->$key->sh = $this->db->get($this->_table)->result();
		}
				
		return $data;
	}
	
	
	
	
	
	
	
	
	
//============= CRUD FUNCTION ===============	

	
	public function update_show($title, $data){
		$this->db->where('title', $title);
	
		if($this->db->update($this->_table, $data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function add(){}
	
	public function edit(){}
	
	public function del(){}
	
	public function search(){}
}