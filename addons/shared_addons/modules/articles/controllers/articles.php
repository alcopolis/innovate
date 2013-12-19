<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The public controller for the Products module.
 *
 * @author		PyroCMS Dev Team
 * @package		PyroCMS\Core\Modules\Products\Controllers
 */
class Articles extends Public_Controller
{
	protected $page_data;
	protected $articles;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('articles_m');
		$this->load->model('articles_category_m');
		
		$this->page_data = new stdClass();
		$this->articles = new stdClass();
	}

	
	private function render($view, $page_title = 'Articles', $var = NULL){
		$this->template
		->title($page_title)
// 		->append_js('module::main.js')
		->append_css('module::style_front.css')
		->set('page', $this->page_data)
		->set($var)
		->build($view);
	}
	
// 	public function index($slug = NULL){
// 		if(isset($slug) && $slug != 'category' && preg_match("/(\A[0-9]+?\z)/", $slug) == FALSE){
// 			$this->articles = $this->articles_m->get_articles_by(array('slug'=>$slug), NULL, TRUE);
			
// 			$cat = $this->articles_category_m->get_category_by(array('id' => $this->articles->category), NULL, TRUE); 
// 			$this->page_data->section = '<a href="articles/category/' . $cat->slug . '">&laquo ' . $cat->name . '</a>';
			
// 			$this->render('article', $this->articles->title, array('art' => $this->articles, 'cat' => $cat));
// 		}else{
// 			$limit = 3;
// 			$pagination = create_pagination('articles', $this->db->count_all('inn_articles'), $limit,2);
			
// 			$this->articles = $this->articles_m->order_by('created_on','DESC')->limit($pagination['limit'], $pagination['offset'])->get_recent();
// 			$this->page_data->section = 'Berita Terbaru';
// 			$this->render('index', $this->page_data->section, array('arts' => $this->articles, 'pagination' => $pagination));
// 		}
// 	}

	
// 	public function index($slug = NULL){
// 		$limit = 2;
// 		$page = intval($this->input->get('page'));
// 		$paging = $this->paging('articles', $this->db->count_all('inn_articles'), $limit, $page);
					
// 		if(isset($slug) && $slug != 'category' && preg_match("/(\A[0-9]+?\z)/", $slug) == FALSE){
// 			$this->articles = $this->articles_m->get_articles_by(array('slug'=>$slug), NULL, TRUE);
// 			$cat = $this->articles_category_m->get_category_by(array('id' => $this->articles->category), NULL, TRUE);
// 			$this->page_data->section = '<a href="articles/category/' . $cat->slug . '">&laquo ' . $cat->name . '</a>';
	
// 			$this->render('article', $this->articles->title, array('art' => $this->articles, 'cat' => $cat));
// 		}else{
// 			$limit = 3;
// 			$this->articles = $this->articles_m->order_by('created_on','DESC')->limit($paging['limit'], $paging['offset'])->get_recent();
// 			$this->page_data->section = 'Berita Terbaru';
			
// 			$this->render('index', $this->page_data->section, array('arts' => $this->articles, 'pagination' => $paging));
// 		}
// 	}
	
	
// 	public function category($slug = NULL){

// 		$limit = 3;
		
// 		$page = $this->input->get('page');
		
// 		$paging = $this->paging('articles/category/' . $slug, $this->articles_m->count_articles_by_category($slug), $limit, $page);
	
// 		if($slug != NULL or $slug != ''){
// 			$category = $this->articles_category_m->get_category_by(array('slug'=>$slug), NULL, TRUE);
			
// 			$this->page_data->section = $category->name;
			
// 			$this->articles = $this->articles_m->order_by('created_on','DESC')->limit($paging['limit'], $paging['offset'])->get_articles_by(array('category'=>$category->id, 'status'=>'1'));
				
// 			$this->render('index', $this->page_data->section, array('arts' => $this->articles, 'pagination' => $paging));
// 		}
// 	}

	
	
	public function index($slug = NULL){
		//$page = intval($this->input->get('page'));
		
		$limit = 2;
		$paging = create_pagination('articles', $this->db->count_all('inn_articles'), $limit, 2);
			
		if(isset($slug) && $slug != 'category' && preg_match("/(\A[0-9]+?\z)/", $slug) == FALSE){
			$this->articles = $this->articles_m->get_articles_by(array('slug'=>$slug), NULL, TRUE);
			$cat = $this->articles_category_m->get_category_by(array('id' => $this->articles->category), NULL, TRUE);
			$this->page_data->section = '<a href="articles/category/' . $cat->slug . '">&laquo ' . $cat->name . '</a>';
	
			$this->render('article', $this->articles->title, array('art' => $this->articles, 'cat' => $cat));
		}else{
			$limit = 2;
			$this->articles = $this->articles_m->order_by('created_on','DESC')->limit($paging['limit'], $paging['offset'])->get_recent();
			$this->page_data->section = 'Berita Terbaru';
				
			$this->render('index', $this->page_data->section, array('arts' => $this->articles, 'pagination' => $paging));
			
			//$this->build_pagination_links($page, $limit, $this->db->count_all('inn_articles'), 5);
		}
	}

	
	

	public function category($slug = NULL){
		//$page = $this->input->get('page');
		
		$limit = 2;
		$paging = create_pagination('articles/category/' . $slug, $this->articles_m->count_articles_by_category($slug), $limit);
	
		if($slug != NULL or $slug != ''){
			$category = $this->articles_category_m->get_category_by(array('slug'=>$slug), NULL, TRUE);
				
			$this->page_data->section = $category->name;
				
			$this->articles = $this->articles_m->order_by('created_on','DESC')->limit($paging['limit'], $paging['offset'])->get_articles_by(array('category'=>$category->id, 'status'=>'1'));
	
			$this->render('index', $this->page_data->section, array('arts' => $this->articles, 'pagination' => $paging));
			
			//$this->build_pagination_links($page, $limit, $this->articles_m->count_articles_by_category($slug), 5);
		}
	}
	
	
	public function archived($month){
		echo 'Archived month : ' . $month;
	}

	
	public function tags($word){
		echo 'Tag : ' . $word;
	}
	
	
	
	private function build_pagination_links($current, $limit, $total, $view_range){
		$total_links = ceil($total/$limit);
		$active_page = $current;
		
		var_dump($total_links, $active_page);
	}

// 	private function paging($uris = '', $total, $limit, $page = 0){
// 		$data = array();
	
// 		$data['limit'] = $limit;
// 		$data['current'] = $page <= 1 ? 0 : $page-1;
// 		$data['offset'] = $data['current'] * $limit;
// 		$data['total_pages'] = ceil($total/$limit);
	
// 		if($limit >= $total){
// 			$data['links'] = '';
// 		}else{
// 			$data['links'] = '<ul>';
// 			for($i=1; $i<=$data['total_pages']; $i++){
// 				if($i == $page){
// 					$data['links'] .= '<li><strong><a href="' . $uris . '/?page=' . $i . '">'. $i . '</a></strong></li>';
// 				}else{
// 					$data['links'] .= '<li><a href="' . $uris . '/?page=' . $i . '">'. $i . '</a></li>';
// 				}	
// 			}
// 			$data['links'] .= '</ul>';
// 		}
		
// 		return $data;
// 	}
	
	
	
	
	
}