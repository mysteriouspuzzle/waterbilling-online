<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Online_verification extends CI_Model {

  public function storeVerificationCode($data){
		$data1 = array(
			'status'=>'expired'
		);
		$this->db->where('consumer_id', $data['consumer_id'])->update('online_verification', $data1);
		$this->db->insert('online_verification', $data);
		return null;
	}
	public function checkValidCode($code){
		return $this->db->get_where('online_verification', array('code'=>$code, 'status'=>'unverified'))->num_rows();
	}
	public function updateCodeStatus($code){
		$data1 = array(
			'status'=>'verified'
		);
		$this->db->where('code', $code)->where('status', 'unverified')->update('online_verification', $data1);
		$consumer = $this->db->get_where('online_verification', array('code'=>$code, 'status'=>'verified'))->row();
		return $consumer;
	}
}
