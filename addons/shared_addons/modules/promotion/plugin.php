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
	
		$raw = $this->promotion_m->get_promo();

		foreach($raw as $featured){
			$poster = json_decode($featured->poster, true);

			$data .= '<div class="promo" style="background:#FFF url(' . $poster['path'] . ') no-repeat top center">';
			$data .= '<h3><a href="promotion/view/'  . $featured->slug . '">' . $featured->name . '</a></h3>';
			$data .= '<a href="promotion/view/' . $featured->slug . '">Learn more &raquo;</a>';
			$data .= '</div>';
		}
		
		$data .= '
					<script type="text/javascript">
					
					</script>
				
				';
		
		return $data;
	}
	
}