<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paypal extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('consumers');
		$this->load->model('reading');
		$this->load->model('rates');
		$this->load->model('smsapi');
		$this->load->model('bills');
		$this->load->view('layout/header');
		if(!isset($_SESSION['wboUserID'])){
			$this->logout();
		}
	}

	function logout(){
		session_destroy();
		redirect('./');
	}

	public function index(){
		$bill = base64_decode($this->input->get('bill'));
		$data['bill'] = $this->reading->getBillDetails($bill);
		$this->load->view('paypal/payment', $data);
	}
	public function receipt($id){
		$this->bills->paidBill($id);
		$billDetails = $this->bills->getBillDetails($id);
		$consumer = $this->consumers->getConsumerDetails($billDetails->consumer_id);
		$this->sendEmail($consumer, $billDetails);
		$this->load->view('paypal/receipt');
	}
	function sendEmail($consumer, $billDetails){
		$this->load->view('PHPMailerAutoload');
		$mail = new PHPMailer;

		// $mail->SMTPDebug = 4;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'ssl://smtp.gmail.com:465';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'iamstevenjamesb@gmail.com';                 // SMTP username
		$mail->Password = 'March181999';                           // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		// $mail->Port = 465;                                    // TCP port to connect to

		$mail->setFrom($consumer->email, 'Water Billing System');
		$mail->addAddress($consumer->email, $consumer->firstname . ' ' . $consumer->lastname);     // Add a recipient
		$mail->addReplyTo('iamstevenjamesb@gmail.com', 'Information');

		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Water Billing System Receipt';
		$data['prev_date'] = $billDetails->previous_date;
		$data['curr_date'] = $billDetails->present_date;
		$data['current_meter'] = $billDetails->present_meter;
		$data['prev_meter'] = $billDetails->previous_meter;
		$data['bill'] = $billDetails->bill;
		$msg = $this->load->view('paypal/receipt-email',$data,true);
		$mail->Body    = $msg;
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
				echo "<script>alert('Please check your internet connection.')</script>";
				// redirect('reader/readmeter/'.$consumer->id);
		}
	}
}
