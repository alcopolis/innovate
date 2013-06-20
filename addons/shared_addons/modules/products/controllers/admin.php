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
					'rules' => 'trim|htmlspecialchars|required|max_length[200]'
			),
			'package_slug' => array(
					'field' => 'package_slug',
					'label' => 'Slug',
					'rules' => 'trim|required|alpha_dot_dash|max_length[200]'
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

	

	
	public function create()
	{

		// Set our validation rules
		$create_rules = array_merge($this->product_rules, $this->package_rules);
		$this->form_validation->set_rules($create_rules);
		
		//Input preset
		$post = new stdClass;
		foreach ($create_rules as $key => $field)
		{
			$post->$field['field'] = set_value($field['field']);
		}
		
		$post->type = 'wysiwyg-advanced';		
		
		
		// Insert a new product entry.		
		//Run validation
		if ($this->form_validation->run())
		{
			$new = array(
					'name' => $this->input->post('product_name'),
					'slug' => $this->input->post('product_slug')
			);
			
			$this->data->page_title = 'New Product';
			
			echo $new['name'];
		}else{
			
			$this->data->page_title = 'Add New Product';
		}

		$this->template
			->title('Add New Product')
			->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
			->append_js('module::product_form.js')
			->set('data', $this->data)
			->set('post', $post)
			->build('admin/product_form');
	}
	

}
