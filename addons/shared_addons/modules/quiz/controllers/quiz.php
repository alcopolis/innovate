<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FAQ Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */

class Quiz extends Public_Controller
{
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('alcopolis');
	}
	
	
	
	function render($view, $var){
		$this->template
		->title($this->module_details['name'])
		->set($var)
		->build($view);
	}
	
	function index(){
		$this->render('index', array());
	}
	
	function pages($slug=''){
		//echo $slug;
		$this->render('pages', array());
	}
}
