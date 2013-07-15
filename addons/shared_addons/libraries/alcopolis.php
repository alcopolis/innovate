<?php defined('BASEPATH') or exit('No direct script access allowed');

class Alcopolis
{
	public function array_from_post($fields, $post){
		$data = array();
		
		//var_dump($fields);
	
		foreach($fields as $field){
			if(isset($post[$field])){
				$data[$field] = $post[$field];
			}else{
				
			}
		}
	
		return $data;
	}
}