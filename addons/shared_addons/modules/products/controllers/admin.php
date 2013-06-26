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
	protected $post;
	
	
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
		
		
		$post = new stdClass();
		$post->type = 'wysiwyg-advanced';
		
		$this->data->form_action = 'create';
		$this->data->page_title = 'New Product';
		
// 		

		if($this->input->post() !== NULL){
			foreach($this->input->post() as $key=>$field){
				if(strpos($key,'product') !== FALSE){
					$this->data->product->attribute[$key] = $field;
				}else if(strpos($key,'package') !== FALSE){
					$this->data->product->packages = $field;
				}
			}
		}
		
		if ($this->form_validation->run()){
			//process form and redirect to products home
			if($this->products_m->insert($this->data->product)){
				redirect('admin/products');
			}else{
				echo 'Error db insert';
			}
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
		
		$post = new stdClass();
		$post->type = 'wysiwyg-advanced';
		
		$post->product = $this->products_m->get($slug);
		
		//Seting ID Produk
		$prod_id = $post->product->attribute->product_id;
		
		//filter input post sesuai dengan data yg ingin di compare untuk melihat apakah ada perubahan data
		$temp = new stdClass();
		$temp_post = new stdClass();;
		
		
		$filter = array('product_name', 'product_section', 'product_slug', 'product_tags', 'product_body', 'product_css', 'product_js');
			
		foreach ($filter as $key_value){
			//$key = $filter[$i];
			$temp->$key_value = $post->product->attribute->$key_value;
		}		
		
		//Validasi Data Form
		if ($this->form_validation->run()){		


			foreach ($this->input->post() as $key=>$key_value){
				//$key = $filter[$i];
				$temp_post->$key = $key_value;
			}
			
			
			if($this->is_changed($temp, $temp_post, $filter)){				
				foreach($this->input->post() as $key=>$field){
					if(strpos($key,'product') !== FALSE){
						$this->data->product_data[$key] = $field;
					}else if(strpos($key,'package') !== FALSE){
						$this->data->package_data[$key] = $field;
					}
				}
				
				//Setting update info & variables
				//process form and redirect to products home
				
				if($this->products_m->update($prod_id, $this->data->product_data, FALSE)){
					redirect('admin/products');
				}else{
					echo 'Error db update';
				}
			}else{
				echo 'No changes';
			}
		}else{
			$this->data->product = $post->product;
			
			$this->template
				->title($this->data->page_title)
				->append_metadata($this->load->view('fragments/wysiwyg', array(), TRUE))
				->append_js('module::product_form.js')
				->set('data', $this->data)
				->set('post', $post)
				->build('admin/product_form');
		}
	}
	
	
	function is_changed($data1, $data2, $filter){
		
		$result = FALSE;
		$temp1; $temp2;
		

		if($data1 != NULL && $data2 != NULL){			
			for ($i=0; $i<count($filter); $i++){
				$key = $filter[$i];			
				$temp1[$filter[$i]] = $data1->$key;
				$temp2[$filter[$i]] = $data2->$key;
			}
			
			$result = array_diff($temp1, $temp2);
			
			if(count($result)>0){
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}
	

}
