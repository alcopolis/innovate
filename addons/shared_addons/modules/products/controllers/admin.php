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
		
// 		$this->data->product_data = array();
// 		$this->data->package_data = array();
		
		// Set our validation rules
		$rules = array_merge($this->product_rules, $this->package_rules);
		//$rules = $this->product_rules;
		$this->form_validation->set_rules($rules);
		
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

	
	public function create(){
		
		
		$post = new stdClass;
		$post->type = 'wysiwyg-advanced';
		
		$this->data->form_action = 'create';
		$this->data->page_title = 'New Product';
		
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
		
		if ($this->form_validation->run()){
			//$this->products_m->insert($this->data->product_data);
			redirect('products/admin');
		}else{
			//Somethings wrong, reload form
			$this->template
				->title($this->data->page_title)
				->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
				->append_js('module::product_form.js')
				->set('data', $this->data)
				->set('post', $post)
				->build('admin/product_form');
		}
	}
	
	
	public function edit($slug)
	{
		
		$this->data->form_action = 'edit';
		$this->data->page_title = 'Edit Product';
		
		$post = new stdClass;
		$post->type = 'wysiwyg-advanced';
		
		$post->product = $this->products_m->get($slug);
		//filter input post sesuai dengan data yg ingin di compare untuk melihat apakah ada perubahan data
		$temp;
		$filter = array('product_id', 'product_name', 'product_section', 'product_slug', 'product_tags', 'product_body', 'product_css', 'product_js');
			
		for ($i=0; $i<count($filter); $i++){
			$key = 'product_'.$filter[$i];
			$temp[$key] = $post->product->attribute[$key];
		}
		
		if ($this->form_validation->run()){			
			if($this->is_changed($temp, $this->input->post(), $filter)){				
				foreach($this->input->post() as $key=>$field){
					if(strpos($key,'product') !== FALSE){
						$this->data->product_data[$key] = $field;
					}else if(strpos($key,'package') !== FALSE){
						$this->data->package_data[$key] = $field;
					}
				}
			}
		}else{
// 			foreach($post->product as $key=>$field){
// 				if(strpos($key,'product') !== FALSE){
// 					$this->data->product_data[$key] = $field;
// 				}else if(strpos($key,'package') !== FALSE){
// 					$this->data->package_data[$key] = $field;
// 				}
// 			}
			
			$this->data->product = $post->product;
			//var_dump($this->data->product_data);
	
			$this->template
				->title($this->data->page_title)
				->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
				->append_js('module::product_form.js')
				->set('data', $this->data)
				->set('post', $post)
				->build('admin/product_form');
		}
	}
	
	
	function is_changed($array1 = NULL, $array2 = NULL, $filter){
		if($array1 != NULL && $array2 != NULL){
			
// 			$result = array_diff($array1, $array2);
			
// 			var_dump($array1);
// 			echo '<br/>';
// 			var_dump($array2);
			
			if(count($result) > 0){
				var_dump($result);
				echo 'asdfasdf';
				return TRUE;
			}else{
				var_dump($result);
				echo 'lkjlkjlkjlk';
				return FALSE;
			}
		}
	}
	

}
