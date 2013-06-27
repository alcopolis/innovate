<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The public controller for the Products module.
 *
 * @author		PyroCMS Dev Team
 * @package		PyroCMS\Core\Modules\Products\Controllers
 */
class Products extends Public_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	
		$this->load->model('products_m');
	}
	
	public function view($slug=NULL){
		//$this->product = $this->products_m->get($slug);

// 		if($this->product != NULL){
// 			$this->template
// 			->title($this->module_details['name'])
// 			->append_css('module::style_front.css')
// 			->set('product', $this->product)
// 			->build('products');
// 		}else{
// 			//Redirect to Missing Page
// 		}

		$this->product = $this->construct_data($slug);
	}
	
	private function construct_data($slug){
		$return = new stdClass();
		$product = new stdClass();
		$id; 
		$packages; 
		$package_group = new stdClass(); 
		$package_field = new stdClass();
		
		$product = $this->products_m->inn_get('product', $slug, 'slug', true); //return object
		
		//Setting requested ID then query all packages based on it
		$id = intval($product->product_id);
		$packages = $this->products_m->inn_get_by('package', array('package_prod_id'=>$id)); //return array
		
		//Get existing group from packages
		$groups = array();
		foreach($packages as $p){
			if(!in_array($p->package_group, $groups) && $p->package_group != NULL){
				$groups[] = $p->package_group;
			}
		}
		
		//Arrange package based on group
		foreach($groups as $group){
			$break = explode(' ', $group);
			$namespace = strtolower (implode('_', $break));
			$package_group->$namespace = $this->products_m->inn_get_by('package', array('package_group'=>$group)); //return array of package based on group
		} 
		
		
		//Arrange package based on group
		foreach($package_group as $key=>$value){
			//echo $key . '<br/>';
			//var_dump($package_group->$key);
			//var_dump($value);
			//echo '<br/><br/>';
			foreach($value as $v){
				$v->field = $this->products_m->inn_get_by('field', array('package_id'=>$v->package_id)); //return array of field for each package
				//var_dump($v);
				echo '<br/>';
			}
			echo '<br/><br/>';
		}
		
		
		$return->product = $product;
		
		foreach($package_group as $key=>$value){

			$return->packages = new stdClass();
			
			$return->packages->$key = $value;
			
// 			foreach($return->packages->$key as $v){
// 				$v->field = new stdClass();
// 				$temps = $this->products_m->inn_get_by('field', array('package_id'=>$v->package_id));
				
// 				foreach($temps as $field=>$data){
// 					$v->field->$field = $data;
// 				}
// 			}		
			var_dump($key);
			var_dump($return->packages->$key);
			echo '<br/><br/>';
		}
		
		
		echo '//---------------------------------------------------------------------------//<br/><br/>';
		var_dump($return);
		
		
		
// 		echo 'Product query:<br/>';
// 		var_dump($product);
// 		echo '<br/><br/>';
		
// 		echo 'Product ID:<br/>';
// 		var_dump($id); 
// 		echo '<br/><br/>';
		
// 		echo 'Packages query:<br/>';
// 		var_dump($packages);
// 		echo '<br/><br/>';
		
// 		echo 'Group list:<br/>';
// 		var_dump($group);
// 		echo '<br/><br/>';
		
// 		echo 'Package by Group:<br/>';
// 		foreach($package_group as $key=>$value){
// 			echo $key . '<br/>';
// 			//var_dump($package_group->$key);
// 			//var_dump($value);
// 			//echo '<br/><br/>';
// 			foreach($value as $v){
// 				$v->field = $this->products_m->inn_get_by('field', array('package_id'=>$v->package_id)); //return array of field for each package
// 				var_dump($v);
// 				echo '<br/>';
// 			}
// 			echo '<br/><br/>';
// 		}
	} 
	
	function tes(){
		$this->result = $this->products_m->inn_get_by('field', array('field_name'=>'Saluran Premium'), TRUE);
		var_dump($this->result);
	}
}