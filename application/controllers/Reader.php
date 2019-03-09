<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reader extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('consumers');
		$this->load->model('reading');
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
	public function readmeter(){
		$consumer_id = $this->input->get('id');
		$count_prev_meter = $this->reading->countPreviousMeterReading($consumer_id);
		if($count_prev_meter == 0) {
			$data['prev_meter'] = "00000000";
		}else{
			$result = $this->reading->getPreviousMeterReading($consumer_id);
			$data['prev_meter'] = $result->previous_meter;
		}
		$this->load->view('reader/readmeter', $data);
	}
}
