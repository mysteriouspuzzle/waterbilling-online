<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('credentials');
		$this->load->view('layout/header');
		if(isset($_SESSION['wbUserID'])){
			if($_SESSION['wbUserLevel']=='Administrator'){
				redirect('administrator/');
			}
		}
	}
	public function index(){
		$this->load->view('adminlogin');
	}
	public function login(){
		$u = $this->input->post('username');
		$p = $this->input->post('password');
		$p = md5($p);
		echo $p;
		$user = $this->credentials->checkCredential($u, $p);
		$count = count($user);
		if($count==0){
			$this->session->set_flashdata('error','Invalid Credentials.');
			redirect('admin/');
		}else{
			$_SESSION['wbUserID'] =$user->id;
			$_SESSION['wbUserLevel'] =$user->userLevel;
			$_SESSION['wbUser'] =$user->fullname;
			$_SESSION['wbUserLocation'] =$user->Location;
			redirect('administrator/');
		}
	}
}
