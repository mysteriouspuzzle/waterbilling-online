<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bills extends CI_Model {

  public function paidBill($bill_id){
    $data = array(
      'status' => 'Paid'
    );
    $this->db->where('bill_id', $bill_id)->update('bills', $data);
    return null;
  }
  public function getBillDetails($bill_id){
    return $this->db->get_where('bills',array('bill_id'=>$bill_id))->row();
  }
}
