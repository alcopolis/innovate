<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Pages controller
 *
 * @author 		PyroCMS Dev Team
 * @package 	PyroCMS\Core\Modules\Products\Controllers
 */
class Admin extends Admin_Controller {

	/**
	 * The current active section
	 *
	 * @var string
	 */
	protected $section = 'products';
	protected $data;
	
	
	/** @var array The validation rules */
	protected $product_rules = array(
			'product_name' => array(
					'field' => 'product_name',
					'label' => 'Name',
					'rules' => 'trim|htmlspecialchars|required|max_length[200]'
				),
			'product_slug' => array(
					'field' => 'product_slug',
					'label' => 'Slug',
					'rules' => 'trim|required|alpha_dot_dash|max_length[200]'
				)
	);
	
	protected $package_rules = array(
			'package_name' => array(
					'field' => 'package_name',
					'label' => 'Name',
					'rules' => 'trim|htmlspecialchars|max_length[200]'
			),
			'package_slug' => array(
					'field' => 'package_slug',
					'label' => 'Slug',
					'rules' => 'trim|alpha_dot_dash|max_length[200]'
			)
	);
	

	/**
	 * Constructor method
	 *
	 * Loads the form_validation library, the pages, pages layout
	 * and navigation models along with the language for the pages
	 * module.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->data = new stdClass();
		$this->data->section = $this->section;
		
		$this->load->model('products_m');
	}

	
	/**
	 * Index methods, lists all products
	 */
	public function index()
	{
		$this->data->query = $this->products_m->get_all();		
		
		$this->template
			->title($this->module_details['name'])
			->set('data', $this->data)
			->build('admin/index');
	}

	

	
	public function create($id = NULL)
	{
		
		$post = new stdClass;
		
		// Set our validation rules
		$rules = array_merge($this->product_rules, $this->package_rules);
		$this->form_validation->set_rules($rules);
		
		//Input preset
		foreach ($rules as $key => $field)
		{
			$post->$field['field'] = set_value($field['field']);
		}
		
		$post->type = 'wysiwyg-advanced';
		
		
		
		
		//Switch action insert or method		

		$this->data->product_data = array(
				'product_name' => $this->input->post('product_name'),
				'product_slug' => $this->input->post('product_slug'),
				'product_body' => $this->input->post('product_body'),
				'product_section' => $this->input->post('product_section'),
				'product_css' => $this->input->post('product_css'),
				'product_js' => $this->input->post('product_js'),
				'product_is_featured' => $this->input->post('product_is_featured'),
				'product_poster' => $this->input->post('product_poster'),
				'product_tags' => $this->input->post('product_tags')
		);
		
		if ($this->form_validation->run())
		{
			if($id){
				//update method
				//$this->data->action_result = $this->products_m->insert(3, $this->data->product_data, FALSE);
			}else{
				//insert method
				//$this->data->action_result = $this->products_m->insert(NULL, $this->data->product_data, FALSE);
			}	
			
			//redirect('admin/products');
		}else{
			if($id){
				$this->data->page_title = 'Edit Product';
			}else{
				$this->data->page_title = 'New Product';
			}
			
			$this->template
			->title($this->data->page_title)
			->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
			->append_js('module::product_form.js')
			->set('data', $this->data)
			->set('post', $post)
			->build('admin/product_form');
		}

		
		
		
		
		
		
		
		// Insert a new product entry.		
		//Run validation
// 		if ($this->form_validation->run())
// 		{
// 			$this->data->product_data = array(
// 					'product_name' => $this->input->post('product_name'),
// 					'product_slug' => $this->input->post('product_slug'),
// 					'product_body' => $this->input->post('product_body'),
// 					'product_section' => $this->input->post('product_section'),
// 					'product_css' => $this->input->post('product_css'),
// 					'product_js' => $this->input->post('product_js'),
// 					'product_is_featured' => $this->input->post('product_is_featured'),
// 					'product_poster' => $this->input->post('product_poster'),
// 					'product_tags' => $this->input->post('product_tags')
// 			);
						
// 			$this->data->page_title = 'New Product';
			
// 			$this->data->action_result = $this->products_m->insert(3,NULL,NULL);
			
			
// 		}else{
// 			$this->data->product_data = array(
// 					'product_name' => '',
// 					'product_slug' => '',
// 					'product_body' => '',
// 					'product_section' => '',
// 					'product_css' => '',
// 					'product_js' => '',
// 					'product_is_featured' => '',
// 					'product_poster' => '',
// 					'product_tags' => ''
// 			);
			
// 			$this->data->page_title = 'Add New Product';
// 		}
	
	}
	

}
