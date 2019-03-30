<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reading extends CI_Model {

  public function countPreviousMeterReading($consumer_id){
    return $this->db->get_where('reading', array('consumer_id'=>$consumer_id))->num_rows();
  }
	public function getPreviousMeterReading($consumer_id){
    return $this->db->order_by('id', 'desc')->get_where('reading', array('consumer_id'=>$consumer_id))->result();
  }
  public function saveTransaction($data){
    $this->db->insert('reading', $data);
    $insertId = $this->db->insert_id();
    return $insertId;
  }
  public function getBillDetails($id){
    return $this->db->get_where('bills', array('bill_id'=>$id))->row();
  }
}
