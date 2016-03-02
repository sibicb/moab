<?php
include("../lib/init.php");
if(isset($_POST['cid']) && !empty($_POST['cid']) && isset($_POST['bname']) && !empty($_POST['bname'])){
  $cid = trim($_POST['cid']);
  $bname = trim($_POST['bname']);
  $postData = array("municipality" => array("id"=>$cid),
          "name"=>$bname);
  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL, $barangay_insert);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($postData));
  curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch,CURLOPT_HTTPHEADER, array("Accept: application/json", "Content-type: application/json"));
  $output = curl_exec($ch);
  $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  if($http_status == "200"){
    $result = json_decode($output, true);
    $message = array("isValid"=>$result['status'], "message"=>$result['message'], "result"=>$result['result']);
    echo json_encode($message);
  } else if($http_status == "0") {
    $message = array("isValid"=>false,"message"=>"Backend Connection Failure. Please call for support.");
    echo json_encode($message);
  } else if($http_status == "400") {
    $result = json_decode($output, true);
    $message = array("isValid"=>false,"message"=>$result["message"]);
    echo json_encode($message);
  } else {
    $message = array("isValid"=>false,"message"=>"HTTP ERROR: $http_status. Please call for support.");
    echo json_encode($message);
  }
} else {
  $message = array("isValid"=>false,"message"=>"Invalid parameter");
  echo json_encode($message);
}

?>