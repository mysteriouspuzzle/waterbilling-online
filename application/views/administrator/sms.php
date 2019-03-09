<?php
$this->load->view('administrator/smsGateway');
$smsGateway = new SmsGateway('salvaciongelo@gmail.com', 'salvacion');

// $deviceID = 77035;
$deviceID = 79493;
$number = array();
$message = array();
if($_SESSION['vanUserLocation']=='Ormoc'){
  $loc = 'Tacloban';
}else{
  $loc = 'Ormoc';
}
foreach($numbers as $num){
  $data[] = [
    'device' => $deviceID,
    'number' => $num->contactNumber,
    'message' => 'Hello '.$num->firstname.', this is VANTOURS! We are sorry to tell you that we are going to cancel the trip. Kindly wait for a text messages for an update. Thank you!'
  ];
}

$result = $smsGateway->sendManyMessages($data);
// echo json_encode($result);
echo "<quote>Please wait... Sending SMS!</quote>";
?>
<script type="text/javascript">setTimeout("window.close();", 1000);</script>
