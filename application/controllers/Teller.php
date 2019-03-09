<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('consumers');
		$this->load->view('layout/header');
		if(!isset($_SESSION['wbUserID'])){
			redirect('./');
		}
	}
	public function index(){
		$this->load->view('teller/dashboard');
	}
	public function logout(){
		session_destroy();
		redirect('./');
	}
	public function addconsumer(){
		$this->load->view('teller/addconsumer');
	}
	public function storeconsumer(){
		$firstname = $this->input->post('firstname');
		$middlename = $this->input->post('middlename');
		$lastname = $this->input->post('lastname');
		$birthdate = $this->input->post('birthdate');
		$address = $this->input->post('address');
		$contact = $this->input->post('contact');
		$data = array(
			'firstname'=>ucwords($firstname),
			'middlename'=>ucwords($middlename),
			'lastname'=>ucwords($lastname),
			'birthdate'=>date('Y-m-d', strtotime($birthdate)),
			'address'=>ucwords($address),
			'contactNumber'=>$contact
		);
		$this->consumers->storeConsumer($data);
		$this->session->set_flashdata('success','Consumer succcessfully saved.');
		redirect('teller/addconsumer');
	}
	public function viewconsumers(){
		$data['consumers'] = $this->consumers->getAllConsumers();
		$this->load->view('teller/viewconsumers', $data);
	}
}
