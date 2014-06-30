<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Subscriber Module
 *
 * @author 		Adriant Rivano
 * @website		adriantrivano.com
 * @package 	PyroCMS
 * @subpackage 	Subscriber Module
 */
class Subscribe extends Public_Controller
{
	protected $ADMIN_PATH;
	protected $SALES_EMAIL = 'sales@innovate-indonesia.com,
								Syakieb.sungkar@innovate-indonesia.com,
								candra@cepat.net.id,
								Hendry.ramos@cepat.net.id,
								Devi.anton@cepat.net.id,
								Kris.ardianto@innovate-indonesia.com,
								Rani.kusumadewi@cepat.net.id,
								Hendrik.kurniawan@cepat.net.id,
								mukhlasudin@cepat.net.id,
								edwin@innovate-indonesia.com';
	protected $TICKET_PREFIX = '10';
	
	protected $subscriber;
	protected $packages = array();
	protected $rules = array();
	protected $packages_m;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->ADMIN_PATH = base_url() . 'admin';
		
		$this->load->model('subscribe_m');
		$this->packages_m = $this->load->model('products/packages_m');
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('alcopolis');
		
		// Set our validation rules
		$this->rules = $this->subscribe_m->_rules;
		$this->form_validation->set_rules($this->rules);
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		$this->form_validation->set_message('is_unique','You have been signed up with this %s');

		$this->packages = new stdClass();
		$this->packages->inet = $this->packages_result($this->packages_m->get_packages_by(NULL, array('group_id'=>'1'), FALSE), 'Internet Super Cepat');
		$this->packages->tv = $this->packages_result($this->packages_m->get_packages_by(NULL, array('group_id'=>'2'), FALSE), 'Televisi Starter');
	}
	
	private function packages_result($data, $info){
		$arr = array();
		
		$arr[0] = '- ' . $info . ' -';
		foreach($data as $d){
			$arr[$d->id] = $d->name;
		}
		
		//var_dump($arr);
		return $arr;
	}
	
	
	function render($view, $var = NULL){
		$this->template
		->title($this->module_details['name'])
		->append_css('module::subscribe.css')
		->append_js('module::subscribe.js')
		->set('subscriber', $this->subscriber)
		->set('packages', $this->packages)
		->set($var)
		->build($view);
	}
		
	
	public function index(){
		$pack_data = array(
				'basic'=>$this->input->post('pack-basic'),
				'additional'=>$this->input->post('pack-additional')
			);
		
		if($this->form_validation->run()){
			$pack_str = '';
			
			$db_fields = array('name', 'email', 'address', 'area_code', 'phone', 'mobile');
			$data = $this->alcopolis->array_from_post($db_fields, $this->input->post());
			
			if($pack_data['basic'] != ''){
				$pack_str .= $pack_data['basic'];
				
				if($pack_data['additional'] != ''){
					$pack_str .= ' + ';
					$pack_str .= $pack_data['additional'];
				}
			}
			
			$data['packages'] = $pack_str;
			
			$data['date'] = date('Y-m-d');
			
			
			if($this->subscribe_m->insert($data)){
				$id = intval($this->subscribe_m->get_id());
				
				//Ticket ID config
				$ticketid = $this->TICKET_PREFIX;
				
				if($id < 10){
					$ticketid .= '0' . $id;
				}else{
					$ticketid .= $id;
				}
				
				//send notification email to sales team
				$msg = '<p><strong>' . $data['name'] . '</strong> telah mengajukan permohonan berlangganan Innovate. Mohon segera di follow up calon pelanggan ini dengan data berikut:</p>';
				$msg .= '<table><tr><td>Nama</td><td>: ' . $data['name'] . '</td></tr>';
				$msg .= '<tr><td>Alamat</td><td>: ' . $data['address'] . '</td></tr>';
				$msg .= '<tr><td>Telepon</td><td>: ' . $data['area_code'] . ' ' . $data['phone'] . '</td></tr>';
				$msg .= '<tr><td>Ponsel</td><td>: ' . $data['mobile'] . '</td></tr>';
				$msg .= '<tr><td>Layanan</td><td>: ' . $data['packages'] . '</td></tr></table>';
				$msg .= '<p>Silahkan masuk ke <a href="' . $this->ADMIN_PATH . '">Admin Panel</a> untuk memproses permohonan ini.<br/><br/><br/><br/>Terima kasih.</p>';
				
				$this->load->library('email');
					
				$this->email->from('webmaster@innovate-indonesia.com', 'Innovate Subscription System');
				$this->email->to($this->SALES_EMAIL);
				$this->email->cc('adriant.rivano@cepat.net.id');
				//$this->email->cc('');
				//$this->email->bcc('');
					
				$this->email->subject('[ #' . $ticketid . ' ] Permohonan Berlangganan Innovate');
				$this->email->message($msg);
					
				if($this->email->send()){
					//Redirect
					redirect('subscribe/success');
				}else{
					$this->render('subscribe');
				}
			}
			
		}else{
			$this->subscriber = $this->subscribe_m->get_new();
			$this->render('subscribe');
		}
	}
	
	
	public function success(){
		$this->render('success');
	}
	
	
	public function bundle(){
		
		$pack_config = array();
		$packname = array();
		$packbody = array();
		
		foreach ($this->input->get() as $key=>$val){
			$pack_config[$key] = intval($val);
			$temp = $this->packages_m->get_packages_by(NULL, array('id'=>$val), TRUE);
			$packname[] = $temp->name;
			$packbody[] = $temp->body;
		}
		
		$var = array(
				'pack_config' => $pack_config,
				'pack_title' => '<span class="bundle">Bundle &raquo;</span> ' . $packname[0] . ' & ' . $packname[1],
				'pack_desc' => '<h1>Layanan Internet</h1> Paket bundle layanan ' . $packname[0] . ' ' . $packbody[0] . '<br/><br/><h1>Layanan TV Kabel</h1>' . $packbody[1],
				'pack_add' => '<small style="color:#C00"><strong>Diskon 10% selama masa promosi.</strong></small>'
		);
		
		$this->subscriber = $this->subscribe_m->get_new();
		$this->render('subscribe', $var);
	}
	
	
	public function pack_info(){
 		$net_id = $this->input->get('net');
 		$tv_id = $this->input->get('tv');
				
		//Send ajax respond
		$pack = array();

		if($net_id != '0' and $tv_id != '0'){
			
			$net = $this->packages_m->get_packages_by(NULL, array('id' => $net_id), TRUE);
			$tv = $this->packages_m->get_packages_by(NULL, array('id' => $tv_id), TRUE);
			
			$pack = array(
				'bundle' => true,
				'data' => array(
					'net' => $net,
					'tv' => $tv
				)	
			);
			
		}else{
			
			if($net_id != '0' && $tv_id == '0'){
				$net = $this->packages_m->get_packages_by(NULL, array('id' => $net_id), TRUE);
				$pack['data'] = $net;
			}elseif($tv_id != '0' && $net_id == '0'){
				$tv = $this->packages_m->get_packages_by(NULL, array('id' => $tv_id), TRUE);
				$pack['data'] = $tv;
			}
			
			$pack['bundle'] = false;
		}
		
		echo json_encode($pack);
	}	
}