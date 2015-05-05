<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Plugin_Subscribe extends Plugin
{
	
	public $version = '1.0.0';
	
	public $name = array(
			'en'	=> 'Subscribe'
	);
	
	public $description = array(
			'en'	=> 'Subscribe plugin'
	);
	
	public function _self_doc()
	{
		$info = array(
			'select_pack' => array(
						'description' => array(// a single sentence to explain the purpose of this method
								'en' => 'Return Packages List',
						),
						'single' => true,// will it work as a single tag?
						'double' => false,// how about as a double tag?
						'variables' => '',// list all variables available inside the double tag. Separate them|like|this
						'attributes' => array(
								'product-slug' => array(
										'type' => 'text',// Can be: slug, number, flag, text, array, any.
										'flags' => '',
										'default' => '',
										'required' => true,
								),
								'packages-group' => array(
										'type' => 'text',// Can be: slug, number, flag, text, array, any.
										'flags' => '',
										'default' => '',
										'required' => true,
								),
						),
				),
		);
		
		return $info;
	}
	
	
	public function __construct()
	{	
		$this->load->model('products/products_m');
		$this->load->model('products/packages_m');
	}
	
	
	function select_pack()
	{
		//print_r($this->attribute('product-slug'));
		$product = $this->products_m->get_product_by('', array('slug'=>$this->attribute('product-slug')), TRUE);
		
		//$packages_group = $this->packages_m->group_by('group_id')->get_packages_by('group_id', array('prod_id'=>$product->id));
		//$packages_group = explode("|", $this->attribute('packages-group'));
		$packages_group = $this->db->where('prod_id', $product->id)->get('inn_products_packages_group')->result();
		
		$prod_select_group = array();
		
		foreach($packages_group as $pack){
			//$pg_data = $this->db->where('id', $pg->group_id)->get('inn_products_packages_group')->result();
			$pack_data = $this->packages_m->get_packages_by(NULL, array('group_id'=>$pack->id), FALSE);
			
			foreach($pack_data as $pd){
				if($pd->cat == 'basic'){
					$prod_select_group['basic'][] = $pd;
				}else{
					$prod_select_group[$pd->cat][] = $pd;
				}
			}
		}
		
		$ret_str = '';
		if (array_key_exists('basic', $prod_select_group)) {
			$basic_pack = $prod_select_group['basic'];
			unset($prod_select_group['basic']);
			
			$ret_str .= '<select id="basic" class="packs" name="pack-basic" style="margin-right:20px; width:160px;">';
			$ret_str .= '<option value="">- Paket Duo -</option>';
			foreach($basic_pack as $bp){
				$ret_str .= '<option value="' . $bp->name . '">' . $bp->name . '</option>';
			}
			$ret_str .= '</select>';
			
			foreach($prod_select_group as $key=>$op){
				$ret_str .= '<select id="' . $key . '" class="packs" name="pack-additional" disabled="disabled" style="margin-right:20px; width:160px;">';
				$ret_str .= '<option value="">- Paket Tambahan -</option>';
				foreach($op as $p){
					$ret_str .= '<option value="' . $p->name . '">' . $p->name . '</option>';
				}
				$ret_str .= '</select>';
			}
		}else{
			foreach($prod_select_group as $key=>$op){
				$ret_str .= '<select id="' . $key . '" class="packs" name="pack-additional">';
				
				foreach($op as $p){
					$ret_str .= '<option value="' . $p->name . '">' . $p->name . '</option>';
				}
				$ret_str .= '</select>';
			}
		}
		
		
		
		return $ret_str;
	}
}

/* End of file plugin.php */