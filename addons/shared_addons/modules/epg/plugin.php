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
		$this->load->model('epg_ch_m');
		$this->load->model('epg_sh_m');
	}	
	
	
	function featured(){
		$data = '';
		
		$mainswitch = false;
		
		$raw = $this->epg_sh_m->order_by('cid', 'RANDOM')->limit(7)->get_featured_show();
		shuffle($raw);
		
		$data .= '<style type="text/css">.featured-show{float:left; background:#09F; position:relative; cursor:pointer; overflow:hidden;}
				  .featured-show .poster{width:100%; height:100%;}
	              .featured-show .info{margin:0 auto; padding:0 1%; display:block; position:absolute; background:rgba(255,255,255,1); left:0; width:98%; opacity:0}
				  .featured-show .info h4 {font-size:14px;}
	              .featured-show .info h4, .featured-show .info p, .featured-show .info .show-detail{margin:5px 0;}
	              .featured-show .info p {font-size:12px; line-height:12px;}
				  
				  #main.featured-show .info h4 {font-size:18px;} 
				  </style>';
		
		foreach($raw as $featured){
			$ch = $this->epg_ch_m->get_channel($featured->channelid);
			
			if(!$mainswitch){
				$data .= '<div id="main" class="featured-show">';
					$data .= '<div class="poster"></div>';
					$data .= '<div class="info">';
					$data .= '<h4><a href="epg/show/' .  $featured->showid . '">' . $featured->title . '</a></h4>';
					$data .= '<p class="subinfo">' . $ch->name . ' | ' . $ch->num . '</p>';
					$data .= '<p class="syn-id">' .  $featured->ina . '</p>';
					$data .= '<p class="syn-en">' .  $featured->eng . '</p>';
					$data .= '<a class="show-detail" href="#">Detail Acara</a>';
				$data .= '</div></div>';
				
				$mainswitch = TRUE;
			}else{
				$data .= '<div class="featured-show">';
					$data .= '<div class="poster"></div>';
					$data .= '<div class="info">';
					$data .= '<h4><a href="epg/show/' .  $featured->showid . '">' . $featured->title . '</a></h4>';
					$data .= '<p class="subinfo">' . $ch->name . ' | ' . $ch->num . '</p>';
					$data .= '<a class="show-detail" href="#">Detail Acara</a>';
				$data .= '</div></div>';
			}		
		}

		$data .= '<script type="text/javascript">
					$(document).ready(function(){
						show_layout();
					});
				
				
					$(window).resize(function(e){
						show_layout();
					});
					
					function show_layout(){
						$feats = $(".featured-show");
						$containerW = $(".scroll-content").width();
						
						$feats.each(function() {
							$(this).css("margin", $containerW * 0.002);
							$(this).width($containerW * 0.196).height($containerW * 0.196);
		
				            $infobox = $(this).children(".info");
							$infobox.css("bottom", -$infobox.height());
							
							$(this).mouseenter(function(e){
								$(this).children(".info").animate({bottom:0, opacity:1}, 600);
							});
							
							$(this).mouseleave(function(e){
								$offset = -$(this).children(".info").height();
								$(this).children(".info").animate({bottom:$offset, opacity:0}, 400);
							})
			        	});
					
						$("#main").width($containerW * 0.396).height($containerW * 0.396);
					}
				</script>';
		
		return $data;
	}
	
}