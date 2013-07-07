<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Regular pages model
 *
 * @author Phil Sturgeon
 * @author Jerel Unruh
 * @author PyroCMS Dev Team
 * @package PyroCMS\Core\Modules\Pages\Models
 *
 */
class Promotion_m extends MY_Model
{
	protected $promo;
	
	public function __construct() {
		parent::__construct();
		$this->_table = 'inn_promotion';
	}
	
	public function get_promotions(){
		return $this->db->get($this->_table)->result();
	}
	
}