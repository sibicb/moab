<?php
include("../lib/init.php");
if(isset($_POST['api_token']) && !empty($_POST['api_token']) && isset($_POST['user_id']) && !empty($_POST['user_id']) && isset($_POST['caption']) && !empty($_POST['caption']) && isset($_POST['fileToUpload']) && !empty($_POST['fileToUpload']))
  {
  $api_token = trim($_POST['api_token']);
  $user_id = trim($_POST['user_id']);
  $caption = trim($_POST['caption']);
  $file = trim($_FILES['fileToUpload']['name']);
  //$postData = 'api_token='.$api_token.'&user_id='.$user_id.'&caption='.$caption.'&file='.$file;
  $postData = array("api_token"=>$api_token, "user_id"=>$user_id, "caption"=>$caption, "file"=>$file);

  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL, $moab_upload);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($postData));
  curl_setopt($ch,CURLOPT_HTTPHEADER, array("Accept: application/json"));
  $output = curl_exec($ch);
  $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  if($http_status == "200"){
    $result = json_decode($output, true);
    $message = array("isValid"=>true, "message"=>"Your MOAB has been sent for approval. Check out some of the other MOABs in the gallery!");
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
 }
 ?>