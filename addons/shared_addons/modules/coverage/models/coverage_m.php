<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This is a sample module for PyroCMS
 *
 * @author 		Jerel Unruh - PyroCMS Dev Team
 * @website		http://unruhdesigns.com
 * @package 	PyroCMS
 * @subpackage 	Sample Module
 */
class Coverage_M extends MY_Model {
	
	protected $_table = 'inn_coverage';
	
// 	public $rules = array(
// 			'title' => array(
// 					'field' => 'title',
// 					'label' => 'Show Title',
// 					'rules' => 'trim|xss_clean'
// 			),
// 			'cid' => array(
// 					'field' => 'cid',
// 					'label' => 'Channel ID',
// 					'rules' => 'xss_clean'
// 			),
// 			'date' => array(
// 					'field' => 'date',
// 					'label' => 'Show Date',
// 					'rules' => 'xss_clean'
// 			),
// 			'syn_id' => array(
// 					'field' => 'syn_id',
// 					'label' => 'Sinopsis Indonesia',
// 					'rules' => 'trim|xss_clean'
// 			),
// 			'syn_en' => array(
// 					'field' => 'syn_en',
// 					'label' => 'Synopsis English',
// 					'rules' => 'trim|xss_clean'
// 			),
// 	);
	
	
// 	public $filter_rules = array(
// 			'date' => array(
// 					'field' => 'date',
// 					'label' => 'Show Date',
// 					'rules' => 'required|xss_clean'
// 			),
// 			'cat_id' => array(
// 					'field' => 'cat_id',
// 					'label' => 'Category ID',
// 					'rules' => 'xss_clean'
// 			)
// 	);
	
	
	
//=================== General Function ====================//
	
	public function __construct()
	{		
		parent::__construct();
	}
	
	
	public function get_city(){
		$temp = $this->db->select('city')->distinct('city')->get($this->_table)->result();
		
		$city['select'] = '- Pilih -';
		foreach($temp as $t){
			$city[$t->city] = $t->city;
		}
		
		return $city;
	}
	
	public function get_area($city, $limit=10, $offset){
		$temp = $this->db->select('area')->where('city', $city)->limit($limit, $offset)->get($this->_table)->result();
		
		$area = array();
		foreach($temp as $t){
			$area[] = $t->area;
		}
		
		return $area;
	}
	
}