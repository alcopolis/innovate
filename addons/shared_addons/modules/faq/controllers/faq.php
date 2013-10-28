<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Subscriber Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */
class Faq extends Public_Controller
{
	
	protected $faq_data;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('faq_m');
		$this->load->model('faq_cat_m');
	}
	
	
	function render($view, $var){
		$this->template
		->title($this->module_details['name'])
		->append_css('module::faq.css')
		->append_js('module::faq.js')
		->set($var)
		->build($view);
	}
	
	
	public function index(){
		$this->faq_data = $this->faq_m->order_by('category', 'ASC')->get_faq(NULL, FALSE);
		$faq_cat = $this->faq_cat_m->get_category(NULL, FALSE);
		$this->render('faq', array('faqs' => $this->faq_data, 'cats' => $faq_cat));
	}
}