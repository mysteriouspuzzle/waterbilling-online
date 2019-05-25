<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bills extends CI_Model {

  public function paidBill($bill_id){
    $data = array(
      'status' => 'Paid',
      'payment_type' => 'online'
    );
    $this->db->where('bill_id', $bill_id)->update('bills', $data);
    return null;
  }
  public function getBillDetails($bill_id){
    return $this->db->get_where('bills',array('bill_id'=>$bill_id))->row();
  }
  public function saveTransaction($data){
    $this->db->insert('bills', $data);
    $insertId = $this->db->insert_id();
    return $insertId;
  }
  public function countPreviousMeterReading($consumer_id){
    return $this->db->get_where('bills', array('consumer_id'=>$consumer_id))->num_rows();
  }
  public function getPreviousMeterReading($consumer_id){
    return $this->db->order_by('bill_id', 'desc')->get_where('bills', array('consumer_id'=>$consumer_id))->row();
  }

  public function getConsumerBills($consumer_id){
    return $this->db->order_by('bill_id', 'desc')->get_where('bills', array('consumer_id'=>$consumer_id))->result();
  }
}
