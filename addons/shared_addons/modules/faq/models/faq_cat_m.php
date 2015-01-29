<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Faq_Cat_m extends MY_Model {
	
	public $_rules = array(
				'category' => array(
						'field' => 'category',
						'label' => 'Title',
						'rules' => 'required|trim|xss_clean'
				),
			);
	
	public function __construct()
	{		
		parent::__construct();
		
		/**
		 * If the sample module's table was named "samples"
		 * then MY_Model would find it automatically. Since
		 * I named it "sample" then we just set the name here.
		 */
		$this->_table = 'inn_faq_category';
		$this->load->model('faq_m');
	}
	
	
	public function add_new(){
	
		$cat = new stdClass();
	
		$cat->id = NULL;
		$cat->category = '';
	
		return $cat;
	}
	
	public function get_category($fields=NULL, $single=FALSE){
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
	
	public function get_category_by($where=NULL, $fields=NULL, $single=FALSE){
		if(isset($where)){
			if(isset($where)){
				$this->db->where($where);
			}
			
			return $this->get_category($fields, $single);
		}else{
			return FALSE;
		}
	}
	
	
	
	//Category tree
	protected $temp = array();
	
	public function getTree($parent = 0, $level = 0){
		$result = $this->db->where('parent_id', $parent)->get($this->_table)->result();
	
		foreach($result as $row){
			$this->temp[$row->id] = $row;
			$this->getTree($row->id, $level+1);
		}
	
		$tree = $this->temp;
	
		return $tree;
	}
	
	
	public function catTree(){
		$raw = $this->db->where('parent_id', NULL)->get($this->_table)->result();
		$child = array();
		
		foreach ($raw as $c){
			$child[$c->id] = $c;
			$child[$c->id]->child = $this->getChild(intval($c->id));
		}
		
		return $child;
	}
	
	public function getChild($id = NULL){
		$result = array();
		
		if($id != NULL){
			$childsRaw = $this->db->where('parent_id', $id)->get($this->_table)->result();
			
			foreach ($childsRaw as $chr){
				$result[$chr->id] = $chr;
				
				if($chr->parent_id != NULL){
					$result[$chr->id]->child = $this->getChild(intval($chr->id));
				}
			}
		}else{
			$result[$chr->id] = $chr;
		}
		
		return $result;
	}
	
	
	//CRUD
	public function insert_category($data){
		if($this->db->insert($this->_table, $data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function update_category($id, $data){
		if($this->db->where('id', $id)->update($this->_table, $data)){
			return TRUE;
		}
		
		return FALSE;
	}
	
	public function delete_category($slug){
		$cat_data = $this->db->where('slug', $slug)->get($this->_table)->row();

		if($this->db->delete($this->_table, array('id' => $cat_data->id))){
			if($this->db->delete('inn_faq', array('category' => $cat_data->id))){
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}	
}