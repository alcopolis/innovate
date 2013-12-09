<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * The public controller for the Products module.
 *
 * @author		PyroCMS Dev Team
 * @package		PyroCMS\Core\Modules\Products\Controllers
 */
class Articles extends Public_Controller
{
	
	protected $articles;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('articles_m');
		
		$this->articles = new stdClass();
	}

	
	private function render($view, $var = NULL){
		$this->template
		->title($this->module_details['name'])
// 		->append_js('module::main.js')
// 		->append_css('module::style_front.css')
		->set($var)
		->build($view);
	}
	
	public function index($slug = NULL){
// 		$this->articles = $this->articles_m->get_articles();
// 		$this->render('index', array('arts' => $this->articles));
		
		if(isset($slug)){
			if(preg_match("/(\A[0-9]?\z)/", $slug)){
				$limit = 2;
				$pagination = create_pagination('articles/index', $this->db->count_all('inn_articles'), $limit,3);
				$this->articles = $this->articles_m->order_by('created_on','DESC')->limit($pagination['limit'], $pagination['offset'])->get_articles();
	
				$this->render('index', array('arts' => $this->articles, 'pagination' => $pagination));
			}else{
				$this->articles = $this->articles_m->get_articles_by(array('slug'=>$slug), NULL, TRUE);			
				$this->render('article', array('art' => $this->articles));
			}
		}else{
			$limit = 2;
			$pagination = create_pagination('articles/index', $this->db->count_all('inn_articles'), $limit,3);
			$this->articles = $this->articles_m->order_by('created_on','DESC')->limit($pagination['limit'], $pagination['offset'])->get_articles();
			
			$this->render('index', array('arts' => $this->articles, 'pagination' => $pagination));
		}
	}
	
	public function archived($month){
		echo 'Archived month : ' . $month;
	}
	
	public function category($word){
		echo 'Category : ' . $word;
	}
	
	public function tags($word){
		echo 'Tag : ' . $word;
	}
}