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
						'attributes' => array(
								'limit' => array(
									'type' => 'number',// Can be: slug, number, flag, text, array, any.
									'flags' => '',
									'default' => 11,
									'required' => false,
								),	
								'category' => array(
									'type' => 'slug',
									'flags' => '',
									'default' => 'uncategorized',
									'required' => false,
								),	
						),
				),
				
				'related' => array(
						'description' => array(// a single sentence to explain the purpose of this method
								'en' => ''
						),
						'single' => true,// will it work as a single tag?
						'double' => false,// how about as a double tag?
						'attributes' => array(
							'limit' => array(
									'type' => 'number',// Can be: slug, number, flag, text, array, any.
									'flags' => '',
									'default' => 5,
									'required' => false,
							),
							'id' => array(
									'type' => 'number',// Can be: slug, number, flag, text, array, any.
									'flags' => '',
									'default' => '',
									'required' => false,
							),
							'channel' => array(
										'type' => 'number',// Can be: slug, number, flag, text, array, any.
										'flags' => '',
										'default' => '',
										'required' => false,
							),
						),
				),
				
				'poster' => array(
						'description' => array(// a single sentence to explain the purpose of this method
								'en' => ''
						),
						'single' => true,// will it work as a single tag?
						'double' => false,// how about as a double tag?
						'attributes' => array(
							'filename' => array(
									'type' => 'text',// Can be: slug, number, flag, text, array, any.
									'flags' => '',
									'default' => '',
									'required' => true,
							),
							'size' => array(
										'type' => 'text',// Can be: slug, number, flag, text, array, any.
										'flags' => '',
										'default' => 'medium',
										'required' => false,
							),
						),
				),
				
				'ch_lineup' => array(
						'description' => array(// a single sentence to explain the purpose of this method
								'en' => ''
						),
						'single' => true,// will it work as a single tag?
						'double' => false,// how about as a double tag?
						'attributes' => array(
							'category' => array(
									'type' => 'text',// Can be: slug, number, flag, text, array, any.
									'flags' => '',
									'default' => 'Uncategorized',
									'required' => false,
							),
						),
				),
				
				'metadata' => array(
						'description' => array(// a single sentence to explain the purpose of this method
								'en' => ''
						),
						'single' => true,// will it work as a single tag?
						'double' => false,// how about as a double tag?
						'attributes' => array(
						
						),
				),
		);
	
		return $info;
	}
	
	public function __construct()
	{	
		$this->load->model('epg_ch_m');
		$this->load->model('epg_sh_m');
		$this->load->model('epg_sh_cat_m');
	}	
	

	function metadata(){
		$meta = '<style type="text/css">
					  .featured-show{float:left; background:#09F; position:relative; cursor:pointer; overflow:hidden;}
					  .featured-show .poster{
							width:100%; height:100%; outline:3px solid #FFF;
							background-repeat:no-repeat;
							background-size:auto 100%;
							background-position:center center;
						}
					  .featured-show .poster img{width:100%; height:auto;}
		              .featured-show .info{font-family: "Arial", Helvetica, Tahoma, sans-serif; margin:0 auto; padding:0; display:block; position:absolute; background:rgba(0,120,180,.95); left:0; width:100%; opacity:0;}
					  .featured-show .info h4 {font-size:14px; font-weight:600; line-height:14px; text-align:center; margin:15px 10px}
				
					  .featured-show .info p.subinfo{font-weight:normal; margin:5px 10px; background:#FFF; font-size:12px; color:#111; padding:10px; border-radius:5px;}
					  .featured-show .info p.subinfo{text-align:center;}
				      .main.featured-show p.subinfo {text-align:left;}
					  
					  .featured-show .info p, .featured-show .info .sh-detail-link, .main.featured-show hr, .main.featured-show .sh-detail-link{margin:5px 20px;}
				
		              .featured-show .info p {font-size:12px; line-height:13px; width:auto; color:#FFF; padding:0px;}
					  .featured-show .info a {text-shadow:none; color:#FFF; font-weight:800;}
					  .featured-show .info a:hover {color:#9CF;}
				
					  .main{}
					  .main.featured-show .info h4 {font-size:18px; margin:20px 10px; text-align:left;}
					  .main.featured-show .sh-detail-link {font-size:14px; padding:5px 5px 5px 0;}
					  .main.featured-show .sh-detail-link a{color:#FFF;font-weight:800;} 
					  .main.featured-show .sh-detail-link a:hover {color:#9CF;}
					  .main.featured-show hr{border-style:dashed; border-color:#CCC;}
				  </style>
	
				  <script type="text/javascript">
					$(document).ready(function(){
						show_layout();
					});
	
					$(window).resize(function(e){
						show_layout();
					});
			
					function show_layout(){
						$feats = $(".featured-show");
						$containerW = $(".featured").width();
	
						$feats.each(function() {
							//$(this).css("margin", Math.floor($containerW * 0.002));
							//$(this).width(Math.floor($containerW * 0.196)).height(Math.floor($containerW * 0.196));
							
							featW = Math.floor($containerW * 0.128);
							featH = Math.floor($containerW * 0.128);
				
							$(this).css("margin", Math.floor($containerW * 0.004));

							$(this).width(featW).height(featH);
				
							$(this).mouseenter(function(e){
								$(this).children(".info").animate({bottom:0, opacity:1}, 600);
							});
				
							$(this).mouseleave(function(e){
								$offset = -$(this).children(".info").height();
								$(this).children(".info").animate({bottom:$offset, opacity:0}, 400);
							})
			        	});
			
						$(".main").width(Math.floor($containerW * 0.316)).height(Math.floor($containerW * 0.262));
						
						$infobox = $(".featured-show .info");
						$infobox.each(function(){
							$(this).height($(this).parent().innerHeight());
							$(this).css("bottom", -$(this).height());
						});
					}
				  </script>';
	
		return $meta;
	}
	
	function ch_lineup(){
//		Channel Category
// 		0	Uncategorized
// 		1	National FTA
// 		2	International FTA
// 		3	Movies
// 		4	Entertainment
// 		5	Knowledge
// 		6	Life Style
// 		7	Sports
// 		8	Kids And Toddler
// 		9	News
		
		$cat = $this->epg_ch_m->get_category_by(array('cat' => $this->attribute('category')), TRUE);
		$raw = $this->epg_ch_m->get_channel_by(array('cat' => $cat->id), '');
		
		
		$data = '';
		
		foreach($raw as $ch){
			$data .= $ch->name . '<br/>';	
		}
		
		return $data;
	}
	
	
	
	
	
	function featured(){
		
//		Show Category
// 		0	Uncategorized
// 		1	National FTA
// 		2	International FTA
// 		3	Movies
// 		4	Entertainment
// 		5	Knowledge
// 		6	Life Style
// 		7	Sports
// 		8	Kids And Toddler
// 		9	News
// 		10	Movie Premiere
// 		11	Movie Series
// 		12	Variety
// 		13	Music
// 		14	Live Show

		
		$result = new stdClass();
		
		if($this->attribute('category') != 'Uncategorized'){
			$result = $this->epg_sh_cat_m->get_category_by(array('cat' => $this->attribute('category')), TRUE);
		}
		
		
		$data = '';
		
		if(isset($result)){
			$raw = $this->epg_sh_m->order_by('cid', 'RANDOM')->limit($this->attribute('limit'))->get_featured_show($result->id);
		}else{
			$raw = $this->epg_sh_m->order_by('cid', 'RANDOM')->limit($this->attribute('limit'))->get_featured_show();
		}
		
		shuffle($raw);
		

		$mainswitch = false;
		
		foreach($raw as $featured){
			$ch = $this->epg_ch_m->get_channel($featured->channelid);
						
			$poster_path = $this->module_details['path'] . '/upload/shows' . $featured->poster;
			
			if(!$mainswitch){
				$data .= '<div class="main featured-show">';
				  	$data .= '<div class="poster" style="background-image:url(addons/shared_addons/modules/epg/upload/shows/' . $featured->poster . ')"></div>';
					//$data .= $featured->trailer;
					$data .= '<div class="info">';
					$data .= '<h4><a href="epg/show/' .  $featured->showid . '">' . $featured->title . '</a></h4>';
					$data .= '<p class="subinfo">' . $ch->name . ' | Ch. ' . $ch->num . '</p>';
					$data .= '<p class="syn-id">' .  $featured->ina . '</p><hr/>';
					$data .= '<p class="syn-en">' .  $featured->eng . '</p>';
					$data .= '<p class="sh-detail-link"><a href="epg/show/' .  $featured->showid . '">Detail Acara &raquo</a></p>';
				$data .= '</div></div>';
				
				$mainswitch = TRUE;
			}else{
				$data .= '<div class="featured-show">';
					$data .= '<div class="poster" style="background-image:url(addons/shared_addons/modules/epg/upload/shows/' . $featured->poster . ')"></div>';
					$data .= '<div class="info">';
					$data .= '<h4><a href="epg/show/' .  $featured->showid . '">' . substr($featured->title, 0, 20);
					if(strlen($featured->title) < 20){
						$data .=  '</a></h4>';
					}else{
						$data .=  '...' . '</a></h4>';
					}
 					$data .= '<p class="subinfo">' . substr($ch->name, 0, 10) . ' | Ch. ' . $ch->num . '<br/><br/>' . date('d M y', strtotime($featured->tanggal)) . '<br/>' . date('H:i a', strtotime($featured->jam)) . '</p>';
 					$data .= '<p class="sh-detail-link" style="text-align:center;"><a href="epg/show/' .  $featured->showid . '">Detail Acara</a></p>';
				$data .= '</div></div>';
			}		
		}
		
		return $data;
	}
	
	
	function related(){
		$data = '';
		
		$cid = $this->attribute('channel');
		$id = $this->attribute('id');
	
		$raw = $this->epg_sh_m->limit($this->attribute('limit'))->get_show_by(NULL, array('is_featured'=>'1', 'cid'=>$cid, 'id!='=>$id), false);
		shuffle($raw);
		
		foreach($raw as $related){
			$data .= '<div class="related-show">';
			$data .= '<div class="poster" style="background-image:url(addons/shared_addons/modules/epg/upload/shows/' . $related->poster . ')"></div>';
			$data .= '<p><a href="epg/show/' .  $related->id . '">' . $related->title . '</a></p>';
			$data .= '</div>';
		}
	
		return $data;
	}

	
	
	
	function poster(){
		$realpath = '';
		
		switch ($this->attribute('size')){
			case 'big' :
				$realpath = $this->module_details['path'] . '/upload/shows/';
				break;
			case 'square' :
				$realpath = $this->module_details['path'] . '/upload/shows/square/';
				break;
			case 'medium' :
				$realpath = $this->module_details['path'] . '/upload/shows/medium/';
				break;
			case 'small' :
				$realpath = $this->module_details['path'] . '/upload/shows/small/';
				break;
			default :
				$realpath = $this->module_details['path'] . '/upload/shows/';
		}
		
		$realpath .= $this->attribute('filename');
		
		$image = '<img src="' . $realpath . ' " style="width:100%;" />';
		
		return $image;
	}
	
}