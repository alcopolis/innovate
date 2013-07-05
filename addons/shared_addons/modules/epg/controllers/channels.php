<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Subscriber Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */

class Channels extends Admin_Controller
{
	protected $section = 'items';

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('epg_ch_m');
		$this->load->library('form_validation');
		$this->lang->load('epg');
	}

	/**
	 * List all items
	 */
	public function index()
	{
		// here we use MY_Model's get_all() method to fetch everything
		// $ch = $this->epg_ch_m->get_all();
		// Build the view with sample/views/admin/items.php
		$this->display_all_channel();
	}
	
	public function display_all_channel()
	{
		$this->load->library('table');
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);
		
		$all_channels = $this->epg_ch_m->get_all_channel();
		$tmpl = array( 'table_open'    => '<table id="tbl-view" class="dynamic" border="0" cellpadding="0" cellspacing="10">',
						  'row_alt_start'  => '<tr class="zebra">',
							'row_alt_end'    => '</tr>'
						  );
						  			  
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Channel ID','Channel Name','Channel Number', 'Action');
			
		$i = 0 + $offset;
		foreach ($all_channels as $channel)
			{	
				$strchnum = '000';
				if(strlen($channel->num)==1){ 
					$strchnum = '00' . strval($channel->num) ;
				}elseif(strlen($channel->num)==2){
					$strchnum = '0' . strval($channel->num);
				}else{
					$strchnum = strval($channel->num);
				}
				$this->table->add_row($channel->id,$channel->name, $strchnum,'Edit');
			}
			
		$data['table'] = $this->table->generate();
		
		//$this->template->build('admin/channels', $data);
		$this->template
			->title($this->module_details['name'])
			->set('table', $data['table'])
			->set_partial('filters', 'admin/partials/channel_filters')
			->build('admin/channels');		
	}	
	
}
