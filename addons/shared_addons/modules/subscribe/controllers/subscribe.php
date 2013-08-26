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
	protected $packages = array();
	protected $rules = array();
	protected $packages_m;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('subscribe_m');
		$this->packages_m = $this->load->model('products/packages_m');
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('alcopolis');
		
		// Set our validation rules
		$this->rules = $this->subscribe_m->_rules;
		$this->form_validation->set_rules($this->rules);
		
		// Get product packages
// 		$this->packages[0] = '- Pilih Paket -';
// 		$temp = $this->packages_m->get_packages_by(NULL, array('package_cat'=>'basic'), FALSE);
// 		foreach($temp as $package){
// 			$this->packages[$package->package_id] = $package->package_name;
// 		}

		$this->packages = new stdClass();
		$this->packages->inet = $this->packages_result($this->packages_m->get_packages_by(NULL, array('package_group'=>'Super Cepat'), FALSE), 'Internet');
		$this->packages->tv = $this->packages_result($this->packages_m->get_packages_by(NULL, array('package_group'=>'Starter'), FALSE), 'TV');
	}
	
	private function packages_result($data, $info){
		$arr = array();
		
		$arr[0] = '- Paket ' . $info . ' -';
		foreach($data as $d){
			$arr[$d->package_id] = $d->package_name;
		}
		return $arr;
	}
	
	
	function render($view){
		$this->template
		->title($this->module_details['name'])
		->set('subscriber', $this->subscriber)
		->set('packages', $this->packages)
		->build($view);
	}
	
	
	public function index(){
		
		if($this->form_validation->run()){
			$pack = '';
			
			$db_fields = array('name', 'email', 'address', 'area_code', 'phone', 'mobile');
			$data = $this->alcopolis->array_from_post($db_fields, $this->input->post());
			
			//$data['packages'] = $this->packages_m->get_packages_by('package_name', array('package_id' => $this->input->post('packages')), TRUE)->package_name;
			//$this->packages_m->get_packages_by('package_name', array('package_id' => $this->input->post('packages-net')), TRUE)->package_name;
			
			if($this->input->post('packages-net') != '0' and $this->input->post('packages-tv') != '0'){
				$pack = $this->packages_m->get_packages_by('package_name', array('package_id' => $this->input->post('packages-net')), TRUE)->package_name . ' & ' . $this->packages_m->get_packages_by('package_name', array('package_id' => $this->input->post('packages-tv')), TRUE)->package_name;
			}else{
				if($this->input->post('packages-net') != '0'){
					$pack = $this->packages_m->get_packages_by('package_name', array('package_id' => $this->input->post('packages-net')), TRUE)->package_name;
				}elseif($this->input->post('packages-tv') != '0'){
					$pack = $this->packages_m->get_packages_by('package_name', array('package_id' => $this->input->post('packages-tv')), TRUE)->package_name;
				}
			}
			
			$data['packages'] = $pack;
			$data['date'] = date('Y-m-d');
			
			if($this->subscribe_m->insert($data)){
				redirect('subscribe/success');
			}
		}else{
			$this->subscriber = $this->subscribe_m->get_new();
			$this->render('subscribe');
		}
	}
	
	public function success(){
		$this->render('success');
	}
	
	
	public function pack_info(){
// 		$id = $this->input->post('packages');
// 		$pack = $this->packages_m->get_packages_by(NULL, array('package_id' => $id), TRUE);
				
		//Send ajax respond
		$pack = array();
		$inet_id = $this->input->post('packages-net');
		$tv_id = $this->input->post('packages-tv');

		
		if($inet_id != '0' and $tv_id != '0'){
			$inet = $this->packages_m->get_packages_by(NULL, array('package_id' => $inet_id), TRUE);
			$tv = $this->packages_m->get_packages_by(NULL, array('package_id' => $tv_id), TRUE);
			
			$pack = array(
				'bundle' => true,
				'data' => array(
					'net' => $inet,
					'tv' => $tv
				)	
			);
		}else{
			
			if($inet_id != '0'){
				$inet = $this->packages_m->get_packages_by(NULL, array('package_id' => $inet_id), TRUE);
				$pack['data'] = $inet;
			}elseif($tv_id != '0'){
				$tv = $this->packages_m->get_packages_by(NULL, array('package_id' => $tv_id), TRUE);
				$pack['data'] = $tv;
			}
			
			$pack['bundle'] = false;
		}
		
		echo json_encode($pack);
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