<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Template Plugin
 *
 * Display theme templates
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Plugins
 */
class Plugin_Epg extends Plugin
{
	public $version = '1.0.0';
	
	public $name = array(
			'en'	=> 'EPG'
	);
	
	public $description = array(
			'en'	=> 'EPG Module Plugin'
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
				),
		);
	
		return $info;
	}
	
	public function __construct()
	{	
		$this->load->model('epg_sh_m');
	}	
	
	
	function featured(){
		$data = '';
		
		$raw = $this->epg_sh_m->get_featured_show();
		
		
		foreach($raw as $featured){			
			$data .= '<div class="show-featured" style="margin:40px 20px; width:300px; float:left;">';
			$data .= '<h5><a href="tv_guide/show/' .  $featured->showid . '">' . $featured->title . '</a></h5>';
			$data .= '<p style="width:160px; height:160px; margin:0 auto; background:#FF0; text-align:center">Poster<p>';
			$data .= substr($featured->ina, 0, 150) . '<br/><hr>' . substr($featured->eng, 0, 150) . '</hr>';
			$data .= '</div>';
		}
		
		return $data;
	}
	
}