<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teller extends CI_Controller {

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
		$this->load->view('teller/dashboard');
	}
	public function logout(){
		session_destroy();
		redirect('./');
	}
}
