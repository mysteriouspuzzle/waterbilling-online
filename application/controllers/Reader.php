<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reader extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('consumers');
		$this->load->model('reading');
		$this->load->model('rates');
		$this->load->model('smsapi');
		$this->load->view('layout/header');
		if(!isset($_SESSION['wbUserID'])){
			redirect('./');
		}
	}
	public function index(){
		$this->load->view('reader/dashboard');
	}
	public function logout(){
		session_destroy();
		redirect('./');
	}
	public function viewconsumers(){
		$data['consumers'] = $this->consumers->getAllConsumers();
		$this->load->view('reader/viewconsumers', $data);
	}
	public function readmeter($consumer_id){
		$data['id'] = $consumer_id;
		$data['current_meter'] = $this->input->post('current_meter');
		$count_prev_meter = $this->reading->countPreviousMeterReading($consumer_id);
		if($count_prev_meter == 1) {
			$data['prev_meter'] = "0000";
		}else{
			$result = $this->reading->getPreviousMeterReading($consumer_id);
			$data['prev_meter'] = $result->previous_read;
		}	
		$data['consumer'] = $this->consumers->getConsumerDetails($consumer_id);
		$diff = $data['current_meter'] - $data['prev_meter'];
		$rate = $this->rates->getRateByDiff($diff);
		if($rate->minimum ==0){	
			$data['bill'] = $rate->rate;
		}else{
			$rates = $this->rates->getRates();
			foreach($rates as $rate){
				if($rate->minimum == 0){
					$newDiff = $rate->rate;
					$tmpMaxCubicMeter = $rate->maximum;
				}elseif($rate->minimum != 0){
					if($diff > $rate->maximum){
						$newDiff = ($rate->rate * ($rate->maximum - $tmpMaxCubicMeter)) + $newDiff;
						$tmpMaxCubicMeter = $rate->maximum;
					}elseif($rate->minimum <= $diff and $rate->maximum >= $diff){
						$newDiff = ($rate->rate * ($diff - $tmpMaxCubicMeter)) + $newDiff;
					}
				}
			}
			$data['bill'] = $newDiff;
		}
		$this->load->view('reader/readmeter', $data);
	}
	public function sendbill($id) {
		$consumer = $this->consumers->getConsumerDetails($id);
		$details = $this->reading->getPreviousMeterReading($id);
		$bill = array(
			'current_date'=>date('Y-m-d'),
			'prev_meter'=>$this->input->post('prev_meter'),
			'current_meter'=>$this->input->post('current_meter'),
			'bill'=>$this->input->post('bill'),
			'consumption'=>$this->input->post('consumption')
		);
		$this->sendEmail($consumer, $details, $bill);
		$this->sendSms($consumer, $details, $bill);
		$this->session->set_flashdata('success','SMS and email successfully sent to consumer.');
		redirect('reader/readmeter/'.$id);
	}
	function sendEmail($consumer, $details, $bill){
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
		$data['prev_date'] = $details->date;
		$data['curr_date'] = $bill['current_date'];
		$data['bill'] = $bill['bill'];
		$msg = $this->load->view('reader/email',$data,true);
		$mail->Body    = $msg;
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
				echo "<script>alert('Please check your internet connection.')</script>";
				redirect('reader/readmeter/'.$consumer->id);
		}
	}
	function sendSms($consumer, $details, $bill){
		$api = $this->smsapi->getEndpoint();
		$msg = "Your bill for $details->date to " .$bill['current_date']. " is " .$bill['bill']. ".";
		$check = $this->smsapi->sendSms($api->endpoint, $consumer->contactNumber, $msg);
		if($check == true){
			$this->session->set_flashdata('success','SMS and Email succcessfully sent!');
		}else{
			$this->session->set_flashdata('error','Update your SMS API endpoint or check your connection.');
		}
	}
	public function email(){
		$this->load->view('reader/email');
	}
}
