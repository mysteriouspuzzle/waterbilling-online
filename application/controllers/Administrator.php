<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('credentials');
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
	public function accounts(){
		$data['accounts'] = $this->credentials->getAccounts();
		$data['userlevel'] = $this->db->query("select * from user_levels")->result();
		$this->load->view('administrator/accounts', $data);
	}
	public function logout(){
		session_destroy();
		redirect('admin/');
	}
	public function sales(){
		$data['sales'] = $this->sales->getSales();
		$this->load->view('administrator/sales', $data);
	}
	public function sms(){
		$date = $this->input->get('date');
		$time = $this->input->get('time');
		$data['numbers'] = $this->booking->getCanceledTripsContactNumber($date, $time);
		$this->load->view('administrator/sms', $data);
	}
}
