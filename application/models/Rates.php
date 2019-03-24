<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rates extends CI_Model {

	public function getRates(){
		return $this->db->get('rates')->result();
	}
	public function addRates($data){
		return $this->db->insert('sales', $data);
	}
	public function getRateByDiff($diff){
		return $this->db->get_where('rates', array('minimum <='=> $diff, 'maximum >=' => $diff))->row();
	}
	public function getMinRateMaxCubicMeter(){
		return $this->db->get_where('rates', array('minimum'=> 0))->row();
	}
}
