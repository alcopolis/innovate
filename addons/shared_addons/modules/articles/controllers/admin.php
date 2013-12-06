<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Article Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Article Module
 */

class Admin extends Admin_Controller
{
	protected $section = 'items';

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('articles_m');
		
		$this->load->library('form_validation');
	}
	
	
	private function render($view, $var = NULL){
		$this->template
			->title($this->module_details['name'])
			->set($var)
			->build($view);
	}
	
	

	/**
	 * List all articles
	 */
	public function index()
	{	
		$limit = 10;
		
		$pagination = create_pagination('admin/articles/index', $this->db->count_all('inn_articles'), $limit,4);
		$arts = $this->articles_m->order_by('id','DESC')->limit($pagination['limit'], $pagination['offset'])->get_articles();
		
		$this->render('index', array('articles' => $arts, 'pagination' => $pagination));
	}
	
	public function create()
	{
		if($this->form_validation->run()){
			
		}else{
			
		}
	}
	
	public function edit($id)
	{
		if($this->form_validation->run()){
				
		}else{
				
		}
		
		$this->render('article_form', array('art' => $art, 'pagination' => $pagination));
	}
	
	public function delete($id)
	{
		$this->articles_m->delete($id);
	}
}
