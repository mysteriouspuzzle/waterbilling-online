<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('credentials');
		$this->load->model('codes');
		$this->load->view('layout/header');
		if(isset($_SESSION['wbUserID'])){
			if($_SESSION['wbUserLevel']=='Teller'){
				redirect('teller/');
			}elseif($_SESSION['wbUserLevel']=='Driver'){
				redirect('driver/');
			}elseif($_SESSION['wbUserLevel']=='Assistant Manager'){
				redirect('asstmanager/');
			}elseif($_SESSION['wbUserLevel']=='Dispatcher'){
				redirect('dispatcher/');
			}elseif($_SESSION['wbUserLevel']=='Passenger Barcode Personnel'){
				redirect('pbp/');
			}elseif($_SESSION['wbUserLevel']=='Cargo Barcode Personnel'){
				redirect('cbp/');
			}
		}
	}
	public function index(){
		$this->load->view('login');
	}
	public function login(){
		$u = $this->input->post('username');
		$p = $this->input->post('password');
		$p = md5($p);
		$user = $this->credentials->checkUserCredential($u, $p);
		$count = count($user);
		if($count==0){
			$this->session->set_flashdata('error','Invalid Credentials.');
			redirect('./');
		}else{
			$_SESSION['wbUserID'] =$user->id;
			$_SESSION['wbUserLevel'] =$user->userLevel;
			$_SESSION['wbUser'] =$user->fullname;
			if($_SESSION['wbUserLevel']=='Teller'){
				redirect('teller/');
			}elseif($_SESSION['wbUserLevel']=='Reader'){
				redirect('reader/');
			}
		}
	}
	public function email(){
		$this->load->view('email');
	}
	public function checkemail(){
		$email = $this->input->get('email');
		$check = $this->db->query("select * from credentials where email = '$email'")->num_rows();
		if($check == 1){
			$user = $this->db->query("select * from credentials where email = '$email'")->row();
			$id = $user->id;
			$this->db->query("update codes set status = 'Expired' where pass_id = '$id'");
			$code = sprintf("%06d", mt_rand(1, 999999));

			$user = $this->db->query("select * from credentials where email = '$email'")->row();
			$this->db->query("update codes set status = 'Expired' where pass_id = '$user->id'");
			$_SESSION['fp'] = $user->id;
			$data = array(
				'pass_id'=>$user->id,
				'code'=>$code,
				'status'=>'Pending'
			);
			$this->codes->addCode($data);
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

			$mail->setFrom($user->email, 'Water Billing System');
			$mail->addAddress($user->email, $user->fullName);     // Add a recipient
			$mail->addReplyTo('iamstevenjamesb@gmail.com', 'Information');

			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Your Password Recovery Code';
			$mail->Body    = 'Please input code '. $code .' for you to recover your password.';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			    echo "<script>alert('Please check your internet connection.')</script>";
					redirect('login/email');
			} else {
			    redirect('login/code');
			}
			redirect('login/code');
		}else{
			$this->session->set_flashdata('error', 'Invalid email address.');
			redirect('login/email');
		}
	}
	public function code(){
		$this->load->view('code');
	}
	public function checkcode(){
		$code = $this->input->get('code');
		$id = $_SESSION['fp'];
		$check = $this->db->query("select * from codes where code = '$code' and pass_id = '$id' and status = 'Pending'")->num_rows();
		if($check == 1){
			redirect('login/newpass');
		}else{
			$this->session->set_flashdata('error', 'Invalid code.');
			redirect('login/code');
		}
	}
	public function newpass(){
		$this->load->view('newpass');
	}
	public function createnewpass(){
		$pass = $this->input->get('pass');
		$cpass = $this->input->get('cpass');
		if($pass == $cpass){
			$pass = md5($pass);
			$id = $_SESSION['fp'];
			$this->db->query("update credentials set password = '$pass' where id = '$id'");
			unset($_SESSION['fp']); 
			redirect('login');
		}else{
			$this->session->set_flashdata('error', 'Password does not match.');
			redirect('login/newpass');
		}
	}
}
