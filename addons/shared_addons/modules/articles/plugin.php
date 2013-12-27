<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Template Plugin
 *
 * Display theme templates
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Plugins
 */
class Plugin_Articles extends Plugin
{
	public $version = '1.0.0';
	
	public $name = array(
			'en'	=> 'Articles'
	);
	
	public $description = array(
			'en'	=> 'Articles Module Plugin'
	);
	
	public function _self_doc()
	{
		$info = array(	
				'get_related' => array(
						'description' => array(
								'en' => ''
						),
						'single' => true,
						'double' => false,
						'attributes' => array(
								'category' => array(
										'type' => 'text',
										'flags' => '',
										'default' => '',
										'required' => true,
								),
								'limit' => array(
										'type' => 'number',
										'flags' => '',
										'default' => '',
										'required' => true,
								),
						),
				),
				'get_category' => array(
						'description' => array(
								'en' => ''
						),
						'single' => true,
						'double' => false,
						'attributes' => array(
							'slug' => array(
									'type' => 'text',
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
		$this->load->model('articles_m');
		$this->load->model('articles_category_m');
	}	
	
	
	function get_related(){
		$cat = $this->attribute('category');
		$limit = $this->attribute('limit', NULL);
		
		$c = $this->articles_category_m->get_category_by(array('slug'=>$cat), NULL, TRUE);
		$cat_id = $c->id;
	
		$arts = $this->articles_m->limit($limit)->get_articles_by(array('category'=>$cat_id), NULL, FALSE);
		
		$data = '<ul>';
		foreach ($arts as $a){
			$data .= '<li style="list-style:disc;"><a href="articles/' . $a->art_slug . '">' . $a->title . '</a></li>';
		}
		$data .= '</ul>';
		
		return $data;
	}
	
	function get_category(){
		$cat_slug = $this->attribute('slug');
		
		$temp = $this->articles_category_m->get_category_by(array('slug'=>$cat_slug), NULL, TRUE);
		//var_dump($temp);
		return $temp->name;
	}
	
}