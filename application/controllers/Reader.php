<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reader extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('consumers');
		$this->load->model('reading');
		$this->load->model('rates');
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
		if($count_prev_meter == 0) {
			$data['prev_meter'] = "0000";
		}else{
			$result = $this->reading->getPreviousMeterReading($consumer_id);
			$data['prev_meter'] = $result->previous_meter;
			echo  $result->previous_meter;
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
	public function sendreceipt() {
		$id = 1;
		$this->session->set_flashdata('success','SMS and email successfully sent to consumer.');
		redirect('reader/readmeter?id='.$id);
	}
}
