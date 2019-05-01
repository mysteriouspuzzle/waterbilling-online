<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumers extends CI_Model {

	public function getAllConsumers(){
    return $this->db->get('consumers')->result();
  }

  public function storeConsumer($data){
		$this->db->insert('consumers', $data);
		$insertId = $this->db->insert_id();
		return $insertId;
	}

	public function checkConsumerCredential($email, $pass){
    return $this->db->get_where('consumers', array('email'=>$email, 'password'=>$pass, 'online'=>1))->row();
  }

	public function getConsumerDetails($id){
		return $this->db->get_where('consumers', array('id'=>$id))->row();
	}

	public function checkAccount($accountno, $email){
		return $this->db->get_where('consumers', array('account_number'=>$accountno, 'email'=>$email, 'online'=>0))->num_rows();
	}

	public function getConsumerDetailsByAccountNo($accountno){
		return $this->db->get_where('consumers', array('account_number'=>$accountno))->row();
	}

	public function updateConsumer($id, $data){
		$this->db->where('id', $id)->update('consumers', $data);
		return null;
	}
}
