<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('credentials');
		$this->load->model('rates');
		$this->load->model('smsapi');
		$this->load->view('layout/header');
		if(!isset($_SESSION['wbUserID'])){
			redirect('admin/');
		}
	}
	public function index(){
		$this->load->view('administrator/dashboard');
	}
	public function addaccount(){
		$this->load->view('administrator/addaccount');
	}
	public function addrate(){
		$this->load->view('administrator/addrate');
	}
	public function storeaccount(){
		$accounttype = $this->input->post('accounttype');
		$fullname = ucwords($this->input->post('fullname'));
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$email = $this->input->post('email');
		$check = $this->db->query("select * from credentials where username = '$username'")->num_rows();
		if($check == 0){
			$data = array(
				'fullname'=>$fullname,
				'username'=>$username,
				'password'=>md5($password),
				'userLevel'=>$accounttype,
				'email'=>$email
			);
			$this->credentials->storeAccount($data);
			$this->session->set_flashdata('success', 'Account successfully added.');
		}else{
			$this->session->set_flashdata('error', 'Account username already taken.');
		}
		redirect('administrator/addaccount');
	}
	public function storerate(){
		$cubic_meter = $this->input->post('description');
		$minimum = $this->input->post('minimum');
		$maximum = $this->input->post('maximum');
		$rate = $this->input->post('rate');
		if($minimum == 0){
			$check = $this->db->query("select * from rates where minimum = '0'")->num_rows();
			if($check == 0){
				$this->storeRateFunc($cubic_meter, $minimum, $maximum, $rate);
				$this->session->set_flashdata('success', 'Rate successfully added.');
			}else{
				$this->session->set_flashdata('error', 'Minimum rate already added. Please just update the rate.');
			}
		}elseif($maximum == 0){
			$check = $this->db->query("select * from rates where maximum = '0'")->num_rows();
			if($check == 0){
				$this->storeRateFunc($cubic_meter, $minimum, $maximum, $rate);
				$this->session->set_flashdata('success', 'Rate successfully added.');
			}else{
				$this->session->set_flashdata('error', 'Maximum rate already added. Please just update the rate.');
			}
		}else{
			$this->storeRateFunc($cubic_meter, $minimum, $maximum, $rate);
			$this->session->set_flashdata('success', 'Rate successfully added.');
		}


		redirect('administrator/addaccount');
	}
	function storeRateFunc($cubic_meter, $minimum, $maximum, $rate){
		$data = array(
			'cubic_meter'=>$cubic_meter,
			'minimum'=>$minimum,
			'maximum'=>$maximum,
			'rate'=>$rate
		);
		$this->rate->storeRate($data);
	}
	public function updateaccount(){
		$id = $this->input->post('id');
		$accounttype = $this->input->post('accounttype');
		$fullname = ucwords($this->input->post('fullname'));
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$check = $this->db->query("select * from credentials where username = '$username' and id != '$id'")->num_rows();
		if($check == 0){
			$data = array(
				'fullname'=>$fullname,
				'username'=>$username,
				'userLevel'=>$accounttype,
				'email'=>$email
			);
			$this->credentials->updateAccount($data, $id);
			$this->session->set_flashdata('success', 'Account successfully updated.');
		}else{
			$this->session->set_flashdata('error', 'Account username already taken.');
		}
		redirect('administrator/accounts');
	}
	public function updateapi(){
		$api_endpoint = $this->input->post('api_endpoint');
		$data = array(
			'endpoint'=>$api_endpoint
		);
		$this->smsapi->updateEndpoint($data);
		$this->session->set_flashdata('success', 'SMS API successfully updated.');
		redirect('administrator/smsapi');
	}
	public function accounts(){
		$data['accounts'] = $this->credentials->getAccounts();
		$data['userlevel'] = $this->db->query("select * from user_levels")->result();
		$this->load->view('administrator/accounts', $data);
	}
	public function rates(){
		$data['rates'] = $this->rates->getRates();
		$this->load->view('administrator/rates', $data);
	}
	public function logout(){
		session_destroy();
		redirect('admin/');
	}
	public function sales(){
		$data['sales'] = $this->sales->getSales();
		$this->load->view('administrator/sales', $data);
	}
	public function smsapi(){
		$data['endpoint'] = $this->smsapi->getEndpoint();
		$this->load->view('administrator/smsapi', $data);
	}
	public function testsms(){
		$mobile = $this->input->post('mobile');
		$api = $this->smsapi->getEndpoint();
		$check = $this->smsapi->testSms($api->endpoint, $mobile);
		echo $check;
		if($check == true){
			$this->session->set_flashdata('success','SMS succcessfully sent!');
		}else{
			$this->session->set_flashdata('error','Update your SMS API endpoint or check your connection.');
		}
		redirect('administrator/smsapi');
	}
	public function sms(){
		$date = $this->input->get('date');
		$time = $this->input->get('time');
		$data['numbers'] = $this->booking->getCanceledTripsContactNumber($date, $time);
		$this->load->view('administrator/sms', $data);
	}
}
