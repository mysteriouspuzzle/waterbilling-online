<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumers extends CI_Model {

	public function getAllConsumers(){
    return $this->db->get('consumers')->result();
  }

  public function storeConsumer($data){
		$this->db->insert('consumers', $data);
		return null;
	}

	public function getConsumerDetails($id){
		return $this->db->get_where('consumers', array('id'=>$id))->row();
	}
}
