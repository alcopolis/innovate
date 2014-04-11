<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Subscriber Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */
class Faq extends Public_Controller
{
	
	protected $faq_data;
	protected $cat_tree;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('faq_m');
		$this->load->model('faq_cat_m');
		
		
		//Get category tree
		$this->cat_tree = $this->menu(0,$h="");
	}
	
	
	function render($view, $var){
		$this->template
		->title($this->module_details['name'])
		->append_css('module::faq.css')
		->append_js('module::faq.js')
		->set('cat_tree', $this->cat_tree)
		->set($var)
		->build($view);
	}
	
	
	public function index(){
		$limit = 3;
		
		$faq_cat = $this->faq_cat_m->order_by('id', 'DESC')->get_category(NULL, FALSE);
		$this->faq_data = $this->faq_m->order_by('count', 'DESC')->limit($limit)->get_faq(NULL, FALSE);

		$this->render('index', array('faqs' => $this->faq_data, 'cats' => $faq_cat, 'curr_group' => NULL));
	}
	
	
	private function menu($parent=0,$hasil){
 		$w = $this->db->query('SELECT * from default_inn_faq_category where parent_id="' . $parent . '"');

 		
		if(($w->num_rows())>0)
		{
			$hasil .= '<ul class="dropdown">';
		}
		foreach($w->result() as $h)
		{
			
			$c = $this->db->query('SELECT * from default_inn_faq_category where parent_id="' . $h->id . '"');
			
			if(($c->num_rows()) > 0){
				$hasil .= '<li class="has-children">' .$h->category;
				$hasil = $this->menu($h->id,$hasil);
			}else{
				$hasil .= '<li><a href="faq/group/' . $h->slug . '">' . $h->category . '</a></li>';
			}
			
			$hasil .= '</li>';
		}
		if(($w->num_rows)>0)
		{
			$hasil .= '</ul>';
		}
		return $hasil;
	}
	
	
	
	
	
	
	
	
// 	public function group($group = NULL){
// 		if($group != NULL){
// 			$faq_cat = $this->faq_cat_m->order_by('id', 'DESC')->get_category(NULL, FALSE);
// 			$selected_cat = $this->faq_cat_m->get_category_by(array('slug'=>$group), NULL, TRUE);
// 			$this->faq_data = $this->faq_m->order_by('id', 'ASC')->get_faq_by(array('category'=>$selected_cat->id), NULL, FALSE);
			
// 			$curr_group = $this->faq_cat_m->get_category_by(array('slug'=>$group), NULL, TRUE);
// 			$this->render('faq', array('faqs' => $this->faq_data, 'cats' => $faq_cat, 'curr_group'=>$curr_group));
// 		}else{
// 			redirect('faq');
// 		}
// 	}

	
	public function group($group = NULL){
		if($group != NULL){
			$curr_group = $this->faq_cat_m->get_category_by(array('slug'=>$group), NULL, TRUE);
			$grp_child = $this->faq_cat_m->get_category_by(array('parent_id'=>$curr_group->id), NULL, FALSE);
			
			$this->faq_data = $this->faq_m->order_by('id', 'ASC')->get_faq_by(array('category'=>$curr_group->id), NULL, FALSE);
			
			if(count($grp_child) > 0){
				foreach($grp_child as $child){
					$name = $child->id;
					//$this->faq_data->$name = $child;
					//var_dump($child);
				}
			}
			
			var_dump($grp_child);
		}else{
			redirect('faq');
		}
	}
	
	
	
	
	
	
	
	
	
	public function view($slug = NULL){
		if($slug != NULL){
			$faq_cat = $this->faq_cat_m->order_by('id', 'DESC')->get_category(NULL, FALSE);
			$this->faq_data = $this->faq_m->get_faq_by(array('slug'=>$slug), NULL, TRUE);
			
			$this->faq_m->add_count($this->faq_data->id);
			
			$curr_group = $this->faq_cat_m->get_category_by(array('id'=>$this->faq_data->category), NULL, TRUE);
			$all_faqs_by_group = $this->faq_m->get_faq_by(array('category'=>$curr_group->id), NULL, FALSE);
	
			$this->render('faq_view', array('faqs' => $this->faq_data, 'cats' => $faq_cat, 'curr_group'=>$curr_group, 'all_faqs'=>$all_faqs_by_group));
		}else{
			redirect('faq');
		}
	}
}