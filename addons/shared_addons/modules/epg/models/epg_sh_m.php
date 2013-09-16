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
	
	public $rules = array(
			'syn_id' => array(
					'field' => 'syn_id',
					'label' => 'Sinopsis Indonesia',
					'rules' => 'trim|required|xss_clean'
			),
			'syn_en' => array(
					'field' => 'syn_en',
					'label' => 'Synopsis English',
					'rules' => 'trim|required|xss_clean'
			),
	);
	
	public function __construct()
	{		
		parent::__construct();
		$this->_table = 'inn_epg_show_detail';
	}
	
	

//============= SHOW FUNCTION ===============	
	
	public function get_featured_show()
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
		$this->db->where('t0.is_featured',1);
		$this->db->where('t0.date>=',$hari);
		$this->db->where('t0.date<=',$harirange);
			
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
		$this->db->select('t0.id, t0.title, t0.cid, t0.date, t0.time, t0.duration, t0.syn_id, t0.syn_en, t0.poster');
		$this->db->select('t1.name, t1.num, t1.logo');
		$this->db->from('inn_epg_show_detail t0');
		$this->db->join('inn_epg_ch_detail t1', 't0.cid = t1.id', 'RIGHT');
		$this->db->where('t0.id',$id);
		
		return $this->db->get()->row();
	}
	
	
	
	
	
	
	public function get_count($fields = NULL)
	{
		$hari= date("Y-m-d");
	
		if($fields != NULL){
			$this->db->select($fields);
		}
	
		$this->db->where('date >=', $hari);
		
		//var_dump($this->db->get($this->_table)->num_rows());
	
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
			
			$chs = $this->db->get('inn_epg_ch_detail')->result();
			
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
	
	
	public function get_epg_by($fields, $where, $single = FALSE){
		$this->db->where($where);
		return $this->get_epg($fields, $single);
	}
	
	
	
	
	
	
	
	
	
//============= CRUD FUNCTION ===============	

	
	public function update_show($id, $data){
		$this->db->where('id', $id);
		
		//var_dump($data);
	
		if($this->db->update($this->_table, $data)){
			return TRUE;
			echo 'TRUE';
		}else{
			return FALSE;
			echo 'FALSE';
		}
	}

	public function add(){}
	
	public function edit(){}
	
	public function del(){}
	
	public function search(){}
}