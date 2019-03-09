<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Model {

	public function getSales(){
		return $this->db->get('sales')->result();
	}
	public function addSales($data){
		return $this->db->insert('sales', $data);
	}
	public  function getDriverSales($date, $time){
		return $this->db->query("select sum(amount) as total from sales where date='$date' and schedule='$time' and pos='Driver'")->row();
	}
}
