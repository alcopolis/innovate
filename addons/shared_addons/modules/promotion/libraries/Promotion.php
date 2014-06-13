<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Promotion
{
	public 		static $data;
	
	public 		static $upload_path;
	public 		static $path;
	public		static $max_size_possible;
	public		static $max_size_allowed;
	public 		static $width;
	public 		static $height;
	public 		static $encrypt_name;
	public 		static $remove_whitespace;
	public 		static $filename;
	//For other modules with file upload functionality
	//public 		static $allowed_types;
	
	public function __construct()
	{
 		self::$path = UPLOAD_PATH.'modules/promotion/';
		//self::$path = 'http://innovate/uploads/default/modules/promotion/';
		self::$encrypt_name = TRUE;
		self::$remove_whitespace = TRUE;
		self::$filename = 'promotion-'.now();
		
		ci()->load->model('promotion/promotion_file_m');
		ci()->load->model('promotion/promotion_file_folders_m');
	}
	
	
	
	
	
	// ----------------------------- Temporary! sebelum migrasi ke table promotion files
	public static function get_file_path($id){
		ci()->load->model('files/file_m');
	
		if(ci()->file_m->exists($id)){
			return UPLOAD_PATH.'files/';
		}else{
			return UPLOAD_PATH.'modules/promotion/';
		}
	}
	
	public static function get_file_data($id){
		ci()->load->model('files/file_m');
		
		if(ci()->file_m->exists($id)){
			return ci()->db->where('id', $id)->get('files')->row();
		}else{
			return ci()->db->where('id', $id)->get('inn_promotion_files')->row();
		}
	}
	// ----------------------------- Temporary! sebelum migrasi ke table promotion files
	
	
	
	
	
	public static function upload($field = 'userfile', $name = NULL, $width = FALSE, $height = FALSE, $ratio = TRUE, $action)
	{
		//return self::$path;
		
		ci()->load->library('upload');
		
		
		
		$upload_config = array(
				'upload_path'	=> self::$path,
				//'encrypt_name'	=> $name != NULL ? TRUE : FALSE,
				'file_name'	=> isset($name) ? $name : md5(self::$filename),
				'allowed_types'   => "jpg|png",
		);
		

		ci()->upload->initialize($upload_config);
		
		
// 		if(ci()->upload->do_upload($field)){
// 			$file = ci()->upload->data();
// 		}else{
// 			$file = array('msg' => ci()->upload->display_errors());
// 		}
		
		
		
		//return $file;
		
		if (ci()->upload->do_upload($field))
		{
			$file = ci()->upload->data();
			
			self::$data = array(
					'name'			=> $name ? $name : $file['orig_name'],
					'full_path'		=> $file['full_path'],
					'filename'		=> $file['file_name'],
					'filesize'		=> $file['file_size'],
					'width'			=> (int) $file['image_width'],
					'height'		=> (int) $file['image_height'],
					'date_added'	=> now()
			);
			
			switch ($action){
				case 'resize' :
					if($width or $height){
						self::_resize(self::$data, $width, $height);
					}
					
					break;
				case 'crop' :
					//self::_resize(self::$data);
					if($width or $height){
						self::_crop(self::$data, $width, $height);
					}
					break;
					
				default :
					self::_resize(self::$data, $width, $height);
					self::_crop(self::$data, $width, $height);
					break;
			}
			
			return self::$data;
		}
	}

	
// 	private static function _parse_file_data($data){
// 		$result = array();
// 		$key = array('id', 'folder_id', 'name', 'path', 'filename');
	
// 		foreach($key as $k){
// 			$result[$k] = $data[$k];
// 		}
	
// 		return json_encode($result);
// 	}
	
	
	
	private static function _resize($img_data, $w = false, $h = false, $ratio = TRUE){
		self::$data['action'] = 'Resize';
		
		ci()->load->library('image_lib');
		
		$config['image_library']    = 'gd2';
		$config['source_image']     = $img_data['full_path'];
		$config['new_image']        = $img_data['full_path'];
		$config['maintain_ratio']   = (bool) $ratio;
		$config['width']            = $w ? $w : 0;
		$config['height']           = $h ? $h : 0;
		
		ci()->image_lib->initialize($config);
		ci()->image_lib->resize();
		ci()->image_lib->clear();
		
		self::$data['width'] = ci()->image_lib->width;
		self::$data['height'] = ci()->image_lib->height;
	}
	
	
	private static function _crop($img_data, $w, $h, $center = TRUE){
		self::$data['action'] = 'Crop';
		
		$config = array(
			'image_library' => 'gd2',
			'source_image' => $img_data['full_path'],
//			'new_image' => $img_data['full_path'] . 'med-' . $img_data['filename'],
			'maintain_ratio' => FALSE,
			'width' => $w,
			'height' => $h,
			'x_axis' => $center ? ($img_data['width']-$w)/2 : 0,
			'y_axis' => $center ? ($img_data['height']-$h)/2 : 0,
		);
	
		ci()->load->library('image_lib', $config);
		ci()->image_lib->crop();
		self::$data['err'] = ci()->image_lib->display_errors();
		
// 		if(!ci()->image_lib->crop()){
// 			self::$data['err'] = ci()->image_lib->display_errors();
// 			ci()->image_lib->clear();
// 		}
		
		self::$data['width'] = ci()->image_lib->width;
		self::$data['height'] = ci()->image_lib->height;
	}
	
	
	
	private static function _unlink_file($file)
	{
		
	}
}
