<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	//	$customers = $this->Login_model->get_data_pelanggan($custcode)->row();
		$emailbody ='';
	// code untuk mengirimkan email aktivasi kepada pelanggan 
	
	$config = Array(
	    'protocol' => 'smtp',
	    'smtp_host' => 'mail.innovate-indonesia.com',
	    'smtp_port' => 25,
	    'smtp_user' => 'webmaster@innovate-indonesia.com',
	    'smtp_pass' => 'webmaster',
	    'mailtype'  => 'html', 
	    'charset'   => 'iso-8859-1'
	);
	$this->load->library('email', $config);
/*		
		$this->load->library('email');
		$config['protocol']  = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = 'thez.inchan@gmail.com';//'qorianku@gmail.com';
		$config['smtp_pass'] = 'R@chm4tP@ssw0rd';//'1234567890';
		$config['priority']  = 1;
		$config['newline']   = '\r\n'; 
		$config['mailtype']  = 'html';
		$config['charset']   = 'utf-8';
		$config['wordwrap']  = TRUE;
*/
		$this->email->initialize($config);
		$this->email->from('webmaster@innovate-indonesia.com', 'Innovate Webmaster');
		$this->email->to('rachmat.web@cepat.net.id');
		$this->email->cc('tama.dummy@gmail.com');
		//$this->email->bcc('them@their-example.com');
		$this->email->subject('Test'); 
		
		$emailbody = $emailbody . "Terima kasih atas kepercayaan anda dalam menggunakan jasa dan layanan CEPATNet.<br /><br />"; 
		$emailbody = $emailbody . "Terimakasih,<br /> CEPATNet <br />"; 
		
		$this->email->message($emailbody);
		$this->email->send();
	// end of send mail
//		$data['default']['custmail'] = $customers->EMAIL;		
//		$data['default']['customercode']=$custcode;
		$data['default']['debuger'] = $this->email->print_debugger();
		
		$this->load->view('welcome_message',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */