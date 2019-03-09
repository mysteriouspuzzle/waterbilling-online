<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Codes extends CI_Model {

	public function addCode($data){
    return $this->db->insert('codes', $data);
  }
}
