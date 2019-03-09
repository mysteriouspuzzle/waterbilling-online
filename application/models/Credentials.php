<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credentials extends CI_Model {

	public function checkCredential($u, $p){
    return $this->db->get_where('credentials', array('username'=>$u, 'password'=>$p, 'userLevel'=>'Administrator'))->row();
  }
	public function checkUserCredential($u, $p){
    return $this->db->get_where('credentials', array('username'=>$u, 'password'=>$p, 'userLevel!='=>'Administrator'))->row();
  }
	public function storeAccount($data){
		$this->db->insert('credentials', $data);
		return null;
	}
	public function updateAccount($data, $id){
		$this->db->where('id', $id)->update('credentials', $data);
		return null;
	}
	public function getAccounts(){
		return $this->db->get_where('credentials', array('userLevel!='=>'Administrator'))->result();
	}
	public function getDrivers(){
		return $this->db->get_where('credentials', array('userLevel'=>'Driver'))->result();
	}
}
