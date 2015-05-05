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
								edwin@innovate-indonesia.com,
								erwin.kusumo@innovate-indonesia.com,
								selvy@innovate-indonesia.com,
								juju.juhata@innovate-indonesia.com';
	protected $TICKET_PREFIX = '10';
	
	protected $subscriber;
	protected $rules = array();
	
	public function __construct()
	{
		parent::__construct();
		
		$this->ADMIN_PATH = base_url() . 'admin';
		
		$this->load->model('subscribe_m');
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('alcopolis');
		
		// Set our validation rules
		$this->rules = $this->subscribe_m->_rules;
		$this->form_validation->set_rules($this->rules);
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		$this->form_validation->set_message('required','Mohon lengkapi');
		$this->form_validation->set_message('is_unique','Email sudah terdaftar');
		$this->form_validation->set_message('valid_email','Email tidak valid');
		$this->form_validation->set_message('numeric','Mohon masukkan angka');
	}
		
	
	function render($view, $var = NULL){
		$this->template
		->title($this->module_details['name'])
		->append_css('module::subscribe.css')
		->append_js('module::subscribe.js')
		->set('subscriber', $this->subscriber)
		->set($var)
		->build($view);
	}
		
	
	public function index(){
		
		if($this->form_validation->run()){			
			$db_fields = array('first_name', 'last_name', 'email', 'address', 'city', 'area_code', 'phone', 'mobile');
			$data = $this->alcopolis->array_from_post($db_fields, $this->input->post());
			
			$data['date'] = date('Y-m-d');
			
			
			if($this->subscribe_m->insert($data)){
				//var_dump($data); die();
				
				$id = intval($this->subscribe_m->get_id());
				
				//Ticket ID config
				$ticketid = $this->TICKET_PREFIX;
				
				if($id < 10){
					$ticketid .= '0' . $id;
				}else{
					$ticketid .= $id;
				}
				
				//send notification email to sales team
				$msg = '<style type="text/css">p{padding-bottom:15px} table{margin:10px 0;} </style>';
				$msg .= '<p style="padding-bottom:15px;"><strong>' . $data['first_name'] . ' ' . $data['last_name'] . '</strong> telah mengajukan permohonan berlangganan Innovate. Mohon segera di follow up calon pelanggan ini dengan data berikut:</p>';
				$msg .= '<table cellpadding="1"><tr><td>Nama</td><td>: ' . $data['first_name'] . ' ' . $data['last_name'] . '</td></tr>';
				$msg .= '<tr><td>Alamat</td><td>: ' . $data['address'] . '</td></tr>';
				$msg .= '<tr><td>Telepon</td><td>: ' . $data['area_code'] . ' ' . $data['phone'] . '</td></tr>';
				$msg .= '<tr><td>Ponsel</td><td>: ' . $data['mobile'] . '</td></tr>';
				$msg .= '<p>Silahkan masuk ke <a href="' . $this->ADMIN_PATH . '">Admin Panel</a> untuk memproses permohonan ini.<br/><br/><br/><br/>Terima kasih.</p>';
				
				$this->load->library('email');
					
				$this->email->from('webmaster@innovate-indonesia.com', 'Innovate Subscription');
				//$this->email->to($this->SALES_EMAIL);
				$this->email->to('adriant.rivano@cepat.net.id');
				//$this->email->cc('');
				//$this->email->bcc('');
					
				$this->email->subject('[ #' . $ticketid . ' ] Permohonan Berlangganan Innovate');
				$this->email->message($msg);
					
				if($this->email->send()){
					redirect('subscribe/success');
				}else{
					echo 'Error SMTP server config'; die();
					
					$s = new stdClass();
					
					foreach($data as $k=>$val){
						$s->$k = $val;	
					}
					$this->subscriber = $s;
				}
			}
		}else{
			$this->subscriber = $this->subscribe_m->get_new();
		}

		$this->render('subscribe-form');
	}
	
	
	public function success(){
		$this->render('success');
	}
}