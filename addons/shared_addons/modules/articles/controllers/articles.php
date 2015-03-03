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
		$limit = 8;
		$paging = create_pagination('articles', $this->db->count_all('inn_articles'), $limit, 2);
		//var_dump($paging); die();
		
		if(isset($slug) && $slug != 'category' && preg_match("/(\A[0-9]+?\z)/", $slug) == FALSE){
			$this->articles = $this->articles_m->get_articles_by(array('slug'=>$slug), NULL, TRUE);
			$cat = $this->articles_category_m->get_category_by(array('id' => $this->articles->category), NULL, TRUE);
			//$this->page_data->section = '<a href="articles/category/' . $cat->slug . '">&laquo ' . $cat->name . '</a>';
			$this->page_data->section = '<a href="./">&laquo Recent News</a>';
			
			$this->template->append_css('module::full_article.css');
			$this->render('article', $this->articles->title, array('art' => $this->articles, 'cat' => $cat));
		}else{
			$this->articles = $this->articles_m->order_by('art_id','DESC')->limit($paging['limit'], $paging['offset'])->get_recent();
			$this->page_data->section = 'Berita Terbaru';
						
			$arts = array();
			$i = 0;
			foreach($this->articles as $a){
				$arts[$i]['cover'] = $this->get_cover($a->body);
				$arts[$i]['content'] = $a;
				$i++;
			} 			
			
			$this->render('index', $this->page_data->section, array('arts' => $arts, 'pagination' => $paging));
		}
	}

	
	

	public function category($slug = NULL){
		
		$limit = 5;
		$paging = create_pagination('articles/category/' . $slug, $this->articles_m->count_articles_by_category($slug), $limit);
	
		if($slug != NULL or $slug != ''){
			$category = $this->articles_category_m->get_category_by(array('slug'=>$slug), NULL, TRUE);
				
			$this->page_data->section = 'Berita - ' . $category->name;
				
			$this->articles = $this->articles_m->order_by('created_on','DESC')->limit($paging['limit'], $paging['offset'])->get_articles_by(array('category'=>$category->id, 'status'=>'1'));
	
			$arts = array();
			$i = 0;
			foreach($this->articles as $a){
				$arts[$i]['cover'] = $this->get_cover($a->body);
				$arts[$i]['content'] = $a;
				$i++;
			} 
			
			$this->render('index', $this->page_data->section, array('arts' => $arts, 'pagination' => $paging));
		}
	}
	
	
	public function archived($month){
		echo 'Archived month : ' . $month;
	}

	
	public function tags($word){
		echo 'Tag : ' . $word;
	}
	
	
	
	
	// Tools Function
	
	private function get_cover($content){
		preg_match('/<img.+src=[\'"](?P<src>.+)[\'"].*>/i', $content, $image);
		
		if($image != NULL){
			return $image;
		}else{
			return FALSE;
		}
	}
	
}