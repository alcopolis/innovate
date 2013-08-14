<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Subscriber Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */
class Subscribe extends Public_Controller
{
	
	protected $subscriber;
	protected $rules = array();
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('subscribe_m');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('alcopolis');
		
		// Set our validation rules
		$this->rules = $this->subscribe_m->_rules;
		$this->form_validation->set_rules($this->rules);
	}
	
	
	function render($view){
		$this->template
		->title($this->module_details['name'])
		->set('subscriber', $this->subscriber)
		->build($view);
	}
	
	
	public function index(){
		$this->subscriber = $this->subscribe_m->get_new();
		
		if($this->form_validation->run()){
			
			$db_fields = array('first_name', 'last_name', 'email', 'address', 'area_code', 'phone', 'mobile');
				
			$data = $this->alcopolis->array_from_post($db_fields, $this->input->post());
			
			if($this->subscribe_m->insert($data)){
				echo 'inserted';
			}
		}else{
			$this->render('subscribe');
		}
	}
	
	
	
	//Validation callback
	function _area_code($area){
		$area = trim($area);
		$match = '/^\(?[0-9]\)$/';
		$replace = '/^\(?[0-9]\)$/';
		$return = '$1';
		
		if (preg_match($match, $area)){
			return preg_replace($replace, $return, $area);
		} else {
			$this->form_validation->set_message('_validate_area_code', 'Kode area tidak valid: ' . $area);
			return false;
		}
	}
	
	
	function _validate_phone_number($value){		
		$value = trim($value);
		
		if(strlen($value) == 10){
			$match = '/^\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{3}$/';
			$replace = '/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{3})$/';
		}elseif (strlen($value) == 11){
			$match = '/^\(?[0-9]{3}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{4}$/';
			$replace = '/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/';
		}elseif (strlen($value) == 13){
			$match = '/^\(?[0-9]{4}\)?[-. ]?[0-9]{3}[-. ]?[0-9]{5}$/';
			$replace = '/^\(?([0-9]{4})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{5})$/';
		}
		
		$return = '($1) $2$3';
		
		if (preg_match($match, $value)){
			return preg_replace($replace, $return, $value);
		} else {
			$this->form_validation->set_message('_validate_phone_number', 'Format nomor telepon yang anda masukkan tidak valid: ' . $value);
			return false;
		}
	}

}