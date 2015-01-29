<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Template Plugin
 *
 * Display theme templates
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Plugins
 */
class Plugin_Promotion extends Plugin
{
	public $version = '1.0.0';
	
	public $name = array(
			'en'	=> 'Promotion'
	);
	
	public $description = array(
			'en'	=> 'Promotion module plugin'
	);
	
	public function _self_doc()
	{
		$info = array(
				'featured' => array(
						'description' => array(// a single sentence to explain the purpose of this method
								'en' => ''
						),
						'single' => true,// will it work as a single tag?
						'double' => false,// how about as a double tag?
						'variables' => '', // list all variables available inside the double tag. Separate them|like|this
						'attributes' => array(
							'cat' => array(// this is the name="World" attribute
										'type' => 'text',// Can be: slug, number, flag, text, array, any.
										'flags' => '',// flags are predefined values like asc|desc|random.
										'default' => '0',// this attribute defaults to this if no value is given
										'required' => false,// is this attribute required?
									),
							),
				),
		);
	
		return $info;
	}
	
	public function __construct()
	{	
		$this->load->model('promotion_m');
		$this->load->model('category_m');
	}
	
	
	
	
	function featured(){
		$data = '';
	
		$this->load->library('asset');
		$this->asset->in_build();
	
		$now = date('Y-m-d', time());
	
		$data_filter = array(
				'status' => 'published',
				'featured' => '1',
		//		'cat' => $this->attribute('category', 0),
				'ended >' => $now,
		);
		
		
		if($this->attribute('cat') != NULL || $this->attribute('cat') != ''){
			$cat = $this->category_m->get_category_by(array('cat' => $this->attribute('cat')), '', FALSE);
			$data_filter['cat'] = $cat->id;
			
			$this->promotion_m->where($data_filter);
		}else{
			$this->promotion_m->where($data_filter);
		}
		
	
		$raw = $this->promotion_m->order_by('id', 'random')->limit(5)->get_promo();
	
		foreach($raw as $featured){
			$poster = json_decode($featured->poster, true);
			
			$data .= '<div class="promo" style="background:#FFF url(' . $poster['path'] . ') no-repeat top center; cursor:pointer;">';
			$data .= '<div style="width:960px; margin:0 auto; position:relative;">';
			if($featured->featured_uri != NULL){
				$data .= '<a href="' . $featured->featured_uri . '" style="display:block; position:relative; left:0; top:0; width:100%; height:400px;"></a>';
			}
			$data .= $featured->featured_copy;
				
			$data .= '</div></div>';
		}
	
		$data .= '
		<script type="text/javascript">
			
		</script>
	
		';
	
		return $data;
	}
	
}