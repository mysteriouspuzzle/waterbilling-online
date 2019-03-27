<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paypal extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('consumers');
		$this->load->model('reading');
		$this->load->model('rates');
		$this->load->model('smsapi');
		$this->load->view('layout/header');
		if(isset($_SESSION['wbUserID'])){
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
}
