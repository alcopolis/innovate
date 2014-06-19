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
	
	
	public function import_csv($input_field=NULL, $table=NULL, $fields = NULL){
		//Return Array - file info
		//echo 'import csv';
		
		return $this->upload_file($input_field, NULL, NULL, 'csv', TRUE, FALSE);
	}
	
	
	public function upload_file($input_field=NULL, $filename=NULL, $destination=NULL, $allowed_type=NULL, $is_temporary=FALSE, $encrypt_name=FALSE, $overwrite=TRUE){
		//Return Array - file info
		//echo 'file upload';
		
		$upload_config['file_name']	= $filename != NULL ? str_replace(' ', '-', strtolower($filename)) : md5(now());
		$upload_config['allowed_types'] = $allowed_type;
		$upload_config['overwrite'] = $overwrite;
		
		
		if($is_temporary){
			$upload_config['upload_path'] = UPLOAD_PATH . 'temp/';
			$upload_config['encrypt_name'] = TRUE;
		}else{
			$upload_config['upload_path'] = $destination != NULL ? $destination : exit('Please define destination path.');
			$upload_config['encrypt_name'] = $encrypt_name ? TRUE : FALSE;
		}
		
		//var_dump($upload_config);
		
		ci()->load->library('upload', $upload_config);
				
		if (ci()->upload->do_upload($input_field)){
			return ci()->upload->data();
		}else{
			return ci()->upload->display_errors();
		}
	}
}