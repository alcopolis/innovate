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
// 						'variables' => '',// list all variables available inside the double tag. Separate them|like|this
// 							'section' => array(
// 								'type' => 'text',// Can be: slug, number, flag, text, array, any.
// 								'flags' => '',// flags are predefined values like asc|desc|random.
// 								'default' => '',// this attribute defaults to this if no value is given
// 								'required' => true,// is this attribute required?		
// 							),
				),
		);
	
		return $info;
	}
	
	public function __construct()
	{	
		$this->load->model('promotion_m');
	}	
	
	function featured(){
		$data = '';

		$this->load->library('asset');
		$this->asset->in_build();
		
		$today = new DateTime();
		$now = date('Y-m-d', $today->getTimestamp());
		$this->promotion_m->where('ended >' , $now);
		$this->promotion_m->where('cat' , '0');
		$raw = $this->promotion_m->order_by('id','DESC')->limit(5)->get_promo();
	
		foreach($raw as $featured){
			$poster = json_decode($featured->poster, true);

			$data .= '<div class="promo" style="background:#FFF url(' . $poster['path'] . ') no-repeat top center; cursor:pointer;">';
			$data .= '<div style="width:960px; margin:0 auto; position:relative;">';
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