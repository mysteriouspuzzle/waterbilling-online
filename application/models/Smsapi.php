<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smsapi extends CI_Model {

	public function getEndpoint(){
		return $this->db->get('sms_api')->row();
	}
	public function testSms($endpoint, $mobile){	
		if( $this->url_test($endpoint)) {
			$msg = rawurlencode("This is a test message.");
			file_get_contents($endpoint.'v1/sms/send/?phone='.$mobile.'&message='.$msg);
			return true;
		}else {
			return false;
		}
	}
	public function updateEndpoint($data){	
		$this->db->where('id', 1)->update('sms_api', $data);
		return null;
	}
	function url_test( $url ) {
		$timeout = 5;
		$ch = curl_init();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
		$http_respond = curl_exec($ch);
		$http_respond = trim( strip_tags( $http_respond ) );
		$http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
		if ( ( $http_code == "200" ) || ( $http_code == "302" ) ) {
			return true;
		} else {
			// return $http_code;, possible too
			return false;
		}
		curl_close( $ch );
	}
}
