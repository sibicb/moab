<?php
include("../lib/init.php");
$api_token = $_GET['api_token'];
$key = $_GET['key'];
$value = $_GET['value'];
$getData = 'api_token='.$api_token.'&key='.$key.'&value='.$value;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $user_info.'?'.$getData);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch,CURLOPT_HTTPHEADER, array("Accept: application/json"));
$output = curl_exec($ch);
$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if($http_status == "200"){
  $result = json_decode($output, true);
  $message = array("isValid"=>$result['status'], "message"=>$result['msg']);
  $_SESSION["user_id"] = $result['user']['id'];
  echo json_encode($message);
} else if($http_status == "0") {
  $message = array("isValid"=>false,"message"=>"Backend Connection Failure. Please call for support.");
  echo json_encode($message);
} else if($http_status == "400") {
  $result = json_decode($output, true);
  $message = array("isValid"=>false,"message"=>$result["message"]);
  echo json_encode($message);
} else {
  $message = array("isValid"=>false,"registered"=>0,"message"=>"HTTP ERROR: $http_status. Please call for support.");
  echo json_encode($message);
}
?>