<?php
include("../lib/init.php");
echo $_POST['api_token'];
 function getExtension($str)
 {
   $i = strrpos($str,".");
   if (!$i) { return ""; }
   $l = strlen($str) - $i;
   $ext = substr($str,$i+1,$l);
   return $ext;
 }
 $errors=0;
 
 if(isset($_POST['submit'])) 
 {
  $image=$_FILES['fileToUpload']['name'];
  if ($image) 
  {
    $filename = stripslashes($_FILES['fileToUpload']['name']);
    $extension = getExtension($filename);
    $extension = strtolower($extension);
    if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
    {
    //print error message
        $message = array("isValid"=>false, "message"=>"Unknown file extension!");
        echo json_encode($message);
        $errors=1;
    }
    else
    {

      $size=filesize($_FILES['fileToUpload']['tmp_name']);


      if ($size > 10000000)
      {
          $message = array("isValid"=>false, "message"=>"You have exceeded the size limit!");
          echo json_encode($message);
          $errors=1;
      }

      $image_name=time().'.'.$extension;
      $newname="../images/galleries/".$image_name;
      $copied = copy($_FILES['fileToUpload']['tmp_name'], $newname);
      if (!$copied) 
      {
          $message = array("isValid"=>false, "message"=>"Copy Failed!");
          echo json_encode($message);
          $errors=1;
      }
    }
  }
}

 if(isset($_POST['submit']) && !$errors && $_FILES['fileToUpload']['name'] != NULL) 
 {
    $message = array("isValid"=>true, "message"=>"Your MOAB has been sent for approval. Check out some of the other MOABs in the gallery!");
    echo json_encode($message);
 }

elseif(isset($_POST['submit']) && $_FILES['fileToUpload']['name'] == NULL)
 {
    $message = array("isValid"=>false, "message"=>"Please select image!");
    echo json_encode($message);
    $errors=1;
 }
 ?>
