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
	
	protected $page_data;
	protected $form_data = array();

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('articles_m');
		$this->load->library('alcopolis');
		$this->load->library('form_validation');
		
		// Set our validation rules
		$this->form_validation->set_rules($this->articles_m->_rules);
		
		//Init var
		$this->page_data = new stdClass();
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
		$limit = 10;
		
		$pagination = create_pagination('admin/articles/index', $this->db->count_all('inn_articles'), $limit,4);
		$arts = $this->articles_m->order_by('id','DESC')->limit($pagination['limit'], $pagination['offset'])->get_articles();
		
		$this->render('index', array('articles' => $arts, 'pagination' => $pagination));
	}
	
	
	public function create()
	{
		$this->page_data->action = 'create';
		$this->page_data->title = 'Add New Article';
		
		if($this->form_validation->run()){			
			$this->form_data = $this->alcopolis->array_from_post(array('id', 'title', 'teaser', 'body'), $this->input->post());
			
			//create slug
			$tmp = strtolower($this->input->post('title'));
			$this->form_data['slug'] = str_replace(' ', '-', $tmp);
			
			//Date modified
			$d = new DateTime();
			$date = $d->getTimestamp();
			$this->form_data['created_on'] = $date;
			$this->form_data['modified_on'] = $date;
			
			
			//insert data
			$new_id = $this->articles_m->insert_art($this->form_data);
			
			if($this->input->post('btnAction') == 'save'){
				redirect('admin/articles/edit/' . $new_id);
			}elseif($this->input->post('btnAction') == 'save_exit'){
				redirect('admin/articles');
			}
		}
		
		$art = $this->articles_m->add_new();
		
		$var = array(
				'page' => $this->page_data,
				'art' => $art,
		);
		
		$this->render('article_form', $var);
	}
	
	public function edit($id)
	{
		$this->page_data->action = 'edit';
		$this->page_data->title = 'Edit Article';
		
		
		if($this->form_validation->run()){			
			$this->form_data = $this->alcopolis->array_from_post(array('id', 'title', 'teaser', 'body'), $this->input->post());
			
			//create slug
			$tmp = strtolower($this->input->post('title'));
			$this->form_data['slug'] = str_replace(' ', '-', $tmp);
			
			//Date modified
			$d = new DateTime();
			$this->form_data['modified_on'] = $d->getTimestamp();
			
			
			//update data
			$this->articles_m->update($id, $this->form_data);
			
			if($this->input->post('btnAction') == 'save_exit'){
				redirect('admin/articles');
			}
		}
		
		
		
		$art = $this->articles_m->get_articles_by(array('id'=>$id), NULL, TRUE);
		
		$var = array(
				'page' => $this->page_data,
				'art' => $art, 
			);
		
		$this->render('article_form', $var);
		
	}
	
	public function delete($id)
	{
		$this->articles_m->delete($id);
	}
}
