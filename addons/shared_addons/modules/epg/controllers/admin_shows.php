<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Subscriber Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */

class Admin_Shows extends Admin_Controller
{
	protected $section = 'items';

	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('epg_sh_m');
		$this->load->library('form_validation');
		$this->lang->load('epg');
	}

	/**
	 * List all items
	 */
	public function index()
	{
		// here we use MY_Model's get_all() method to fetch everything
//		$sh = $this->epg_sh_m->get_all();

		// Build the view with sample/views/admin/items.php
/*
		$this->template
			->title($this->module_details['name'])
			->set('sh', $sh)
			->set_partial('filters', 'admin/partials/show_filters')
			->build('admin/shows');
*/
		$this->today_show();
	}
	
	public function today_show()
	{
		$this->load->library('table');
		$uri_segment = 3;
		$offset = $this->uri->segment($uri_segment);

		$today_shows = $this->epg_sh_m->get_today_show();
		//$today_shows = $this->epg_sh_m->get_featured_show();
	
		$tmpl = array( 'table_open'    => '<table id="tbl-view" class="dynamic" border="0" cellpadding="0" cellspacing="10">',
						  'row_alt_start'  => '<tr class="zebra">',
							'row_alt_end'    => '</tr>'
						  );
						  			  
		$this->table->set_template($tmpl);
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Channel ID','Show Title','Start Date', 'Start Time', 'Ind Sinopsys','Eng Sinopsys');
			
		$i = 0 + $offset;
		
		if (is_array($today_shows))
		{
			foreach ($today_shows as $shownow)
				{	
					//
					$this->table->add_row($shownow->channelid,$shownow->title, $shownow->tanggal,$shownow->jam,$shownow->ina,$shownow->eng);
				}
		}
		$data['table'] = $this->table->generate();
		
		//$this->template->build('admin/channels', $data);
		$this->template
			->title($this->module_details['name'])
			->set('table', $data['table'])
			->set_partial('filters', 'admin/partials/channel_filters')
			->build('admin/shows');
	}
	
	public function filter_by($filter = NULL){echo $filter;}
	
	public function update($id = 0){echo $id;}
	
	public function delete($id = 0){echo $id;}
}
