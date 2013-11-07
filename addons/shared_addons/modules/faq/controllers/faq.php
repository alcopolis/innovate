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
		$limit = 3;
		
		$faq_cat = $this->faq_cat_m->order_by('id', 'DESC')->get_category(NULL, FALSE);
		$this->faq_data = $this->faq_m->order_by('count', 'DESC')->limit($limit)->get_faq(NULL, FALSE);

		$this->render('index', array('faqs' => $this->faq_data, 'cats' => $faq_cat, 'curr_group' => NULL));
	}
	
	public function group($group = NULL){
		
		$faq_cat = $this->faq_cat_m->order_by('id', 'DESC')->get_category(NULL, FALSE);
		$selected_cat = $this->faq_cat_m->get_category_by(array('slug'=>$group), NULL, TRUE);
		$this->faq_data = $this->faq_m->order_by('count', 'DESC')->get_faq_by(array('category'=>$selected_cat->id), NULL, FALSE);
		
		$curr_group = $this->faq_cat_m->get_category_by(array('slug'=>$group), NULL, TRUE);
		$this->render('faq', array('faqs' => $this->faq_data, 'cats' => $faq_cat, 'curr_group'=>$curr_group));
	}
	
	
	public function view($slug){
		$faq_cat = $this->faq_cat_m->order_by('id', 'DESC')->get_category(NULL, FALSE);
		$this->faq_data = $this->faq_m->get_faq_by(array('slug'=>$slug), NULL, TRUE);
		
		$this->faq_m->add_count($this->faq_data->id);
		
		$curr_group = $this->faq_cat_m->get_category_by(array('id'=>$this->faq_data->category), NULL, TRUE);
		$all_faqs_by_group = $this->faq_m->get_faq_by(array('category'=>$curr_group->id), NULL, FALSE);

		
		$this->render('faq_view', array('faqs' => $this->faq_data, 'cats' => $faq_cat, 'curr_group'=>$curr_group, 'all_faqs'=>$all_faqs_by_group));
	}
	
	
	public function view_page(){
		
	}
}