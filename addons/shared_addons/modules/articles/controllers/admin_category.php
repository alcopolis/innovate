<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Article Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Article Module
 */

class Admin_Category extends Admin_Controller
{	

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('articles_category_m');
	}
	
	
	private function render($view, $var = NULL){
		$this->template
			->title($this->module_details['name'])
			->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
			->append_js('module::article_form.js')
			->append_css('module::style.css')
			->set($var)
			->build($view);
	}
	
	

	/**
	 * List all articles
	 */
	public function index()
	{	
		echo 'category index';
	}
	
	
	public function add()
	{
		$hidden = $this->input->post('hidden_data');
		
		$data['name'] = ucwords($this->input->post('new_category'));
		
		//create slug
		$tmp = strtolower($this->input->post('new_category'));
		$data['slug'] = str_replace(' ', '-', $tmp);
		
		$this->articles_category_m->insert($data);
		
		redirect(base_url() . $hidden['curr_uri']);
	}
}
