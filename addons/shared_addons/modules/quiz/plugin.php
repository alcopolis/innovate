<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Template Plugin
 *
 * Display theme templates
 *
 * @author  PyroCMS Dev Team
 * @package PyroCMS\Core\Plugins
 */
class Plugin_Quiz extends Plugin
{
	public $version = '1.0.0';
	
	public $name = array(
			'en'	=> 'Quiz'
	);
	
	public $description = array(
			'en'	=> 'Quiz Module Plugin'
	);
	
	public function _self_doc()
	{
		$info = array(
				'get' => array(
						'description' => array(// a single sentence to explain the purpose of this method
								'en' => 'Display Quiz'
						),
						'single' => true,// will it work as a single tag?
						'double' => false,// how about as a double tag?
						'attributes' => array(
								'group' => array(
									'type' => 'text',// Can be: slug, number, flag, text, array, any.
									'flags' => '',
									'default' => '',
									'required' => false,
								),	
								'subject' => array(
									'type' => 'array',
									'flags' => '',
									'default' => '',
									'required' => false,
								),
								'display' => array( //How to present the faq? ---> full article or link
										'type' => 'text',
										'flags' => '',
										'default' => 'full',
										'required' => true,
								),
								'wrapper' => array(
										'type' => 'text',
										'flags' => '',
										'default' => '',
										'required' => false,
								),
						),
				),
		);
	
		return $info;
	}
	
	public function __construct()
	{	
		$this->load->model('quiz_user_activity_m');
	}	
	

	public function get(){
		$group = $this->attribute('group');
		$subject = $this->attribute('subject');
		$display = $this->attribute('display');
		$wrapper = $this->attribute('wrapper');
		
		$quiz;
		$quser;
		$qquser;
		$data = '';
		
		if($group != NULL){
			$cat = $this->faq_cat_m->get_category_by(array('category'=>$group), NULL, TRUE);
			
			if($subject != NULL){
				$string = explode(",", $subject);
					
				foreach($string as $str){
					$this->faq_m->or_like('title', $str);
				}
			}
						
			$faq = $this->faq_m->get_faq_by(array('category'=>$cat->id), NULL, FALSE);
		}else{
			if($subject != NULL){
				$string = explode(",", $subject);
					
				foreach($string as $str){
					$this->faq_m->or_like('title', $str);
				}
			}
								
			$faq = $this->faq_m->get_faq(NULL, FALSE);
		}
		
		
		if($display != NULL){
			if($wrapper != NULL){
				$data = $this->process_display($faq, $display, $wrapper);
			}else{
				$data = $this->process_display($faq, $display);
			}
		}
				
		return $data;
	}	
	
	
	private function process_display($data, $display = 'full', $wrapper = NULL){
		
		$faq = '';
		switch($display){
			case 'full':
				if($wrapper != NULL){
					$opening_tag = '<' . $wrapper . ' class="faq-item">';
					$closing_tag = '</' . $wrapper . '>';
					
					foreach($data as $f){
						$faq .= $opening_tag . '<div class="faq-subject">' . $f->title . '</div>';
						$faq .= '<div class="faq-q">' . $f->question . '</div>';
						$faq .= '<div class="faq-a">' . $f->answer . '</div>' . $closing_tag;
					}
				}else{
					foreach($data as $f){
						$faq .= '<div class="faq-item"><div class="faq-subject">' . $f->title . '</div>';
						$faq .= '<div class="faq-q">' . $f->question . '</div>';
						$faq .= '<div class="faq-a">' . $f->answer . '</div></div>';
					}
				}
				
				break;
				
			case 'link':
				foreach($data as $f){
					$faq .= '<a class="faq-item-link" href="faq/' . $f->id . '">' . $f->title . '</a>';
				}
				break;
		}
		return $faq;
	}
	
}