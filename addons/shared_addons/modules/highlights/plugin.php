<?php defined('BASEPATH') or exit('No direct script access allowed');


class Plugin_Highlights extends Plugin
{
	public $version = '1.0.0';
	
	public $name = array(
			'en'	=> 'Highlights'
	);
	
	public function _self_doc()
	{
		$info = array(
				'featured' => array(
						'description' => array(
								'en' => ''
						),
						'single' => false,
						'double' => true,
						'variables' => 'title|sinopsis|show_time|name|num|logo|path', // list all variables available inside the double tag. Separate them|like|this
						'attributes' => array(
								'cat' => array(
										'type' => 'text',
										'flags' => '',
										'default' => null,
										'required' => false,
								),
						),
				),
		);
		
		return $info;
	}
	
	
	public function __construct()
	{
		$this->load->model('hl_programs_m');
		$this->load->library('files/files');
		$this->load->library('mobile_detect');
	}
	
	
	function featured(){
		$detect = $this->mobile_detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
		//var_dump($deviceType); die();
		
		
		//Cek inactive hl and activate if the date is due
		$now = date('U');
		
		$foractive = $this->hl_programs_m->get_highlights_by(array('status'=>'inactive'));
		foreach($foractive as $row){
			$start = strtotime($row->start_date);
			$end = strtotime($row->end_date);
			
			if($now > $start && $now < $end){
				$this->hl_programs_m->update($row->id, array('status'=>'active'));
			}elseif($now > $end){
				$this->hl_programs_m->update($row->id, array('status'=>'inactive'));
			}
		}
		
		$featured = $this->hl_programs_m->compile_highlights(array('status'=>'active'), $this->attribute('cat'));
		
		
		//Limit panjang text sinopsis
		$syn_limit = 280;
		foreach($featured as $f){
			if(strlen($f->sinopsis) > $syn_limit){
				$f->sinopsis_short = substr($f->sinopsis, 0, $syn_limit) . '..';
			}else{
				$f->sinopsis_short = substr($f->sinopsis, 0, $syn_limit);
			}
		}
		
		return $featured;
	}
}