<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FAQ Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */

class Admin extends Admin_Controller
{
	protected $section = 'quiz';
	protected $rules = array();
	
	protected $quiz_data;
	protected $page_data;
	
	public function __construct()
	{
		parent::__construct();
		
	
	}
	
	
	
	function render($view, $var){
		
	}
	
	function index(){
	
	}
	
	
/*	function create($c){
		
	
	}
	
	
	function edit($id){
		
	}
	
	function delete($id){
		$this->quiz_m->delete($id);
		$this->index();
	} */
	
}
