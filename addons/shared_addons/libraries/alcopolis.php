<?php defined('BASEPATH') or exit('No direct script access allowed');

class Alcopolis
{
	//Filter post data into desired/specific input
	public function array_from_post($fields, $post){
		$data = array();

		foreach($fields as $field){
			if(isset($post[$field])){
				$data[$field] = $post[$field];
			}
		}
	
		return $data;
	}
	
}