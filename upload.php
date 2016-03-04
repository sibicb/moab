<?php
include("lib/init.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>MOAB</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/home.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<div class="container">
  <div class="row">
    <div class="col-xs-8 col-sm-3">
      <a class="bottle" href=""><img  src="assets/images/bottle_with_click.png"></a>
    </div>
    <div class="col-xs-4 col-sm-9">
      <div class="col-xs-8 col-sm-12">
        <div id="nav">
          <ul>
            <li><a href="upload.php"><img src="assets/images/moab_btn2.png"></a></li>
            <li><a href="gallery.php"><img src="assets/images/my_gallery_btn1.png"></a></li>
            <li><a href="moab_gallery.php"><img src="assets/images/moab_gallery_btn1.png"></a></li>
            <li><a href="mechanics.php"><img src="assets/images/mechanics_btn1.png"></a></li> 
          </ul> 
        </div>
      </div>
  </div>

  <div class="col-xs-9 col-sm-9">
    <div class="uploadForm">
        <form class="horizontal" id="upload" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <input type="hidden" name="api_token" value="qNoRXbEoEwxzKisReAkZ2pa7f8poTeq9">
            <input type="hidden" name="user_id" id="user_id" value ="<?php echo $_SESSION['user_id'];?>">
            <div class="uploadDiv">
              <div class="fileUpload btn btn-default btn-lg">
                  <span>Browse Photo</span>
                  <input id="fileToUpload" type="file" name="fileToUpload" class="upload" onchange="CopyMe(this, 'txtFileName');" />
              </div>
              <input id="txtFileName" type="text" readonly="readonly" class="form-control"/>
                <h3> What's your message? </h3>
            </div>
          <div class="form-group">
            <div class="col-xs-4 col-sm-10">
              <input type="text" name="caption" id="caption" class="form-control" placeholder="Let your past make you better not bitter." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Let your past make you better not bitter.'" />>
            </div>
          </div>
            <div class="previewDiv">
              <input type="submit" value="Preview" name="submit" id="preview" class="btn btn-default btn-lg">
            </div>
            
          
        </form>
      </div>
  </div>
</div>
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" style="background: white">
      <h3 id="msg"></h3>
      <div class="alert hidden" role="alert" id="modalAlert"></div>
        <div id ="error"></div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    function CopyMe(oFileInput, sTargetID) {
      var arrTemp = oFileInput.value.split('\\');
    document.getElementById(sTargetID).value = arrTemp[arrTemp.length - 1];
    }
    $(document).ready(function (e) {
      $("#upload").on('submit',(function(e) {
        e.preventDefault();
        $.ajax({
          url: "func/upload.php",
          type: "POST",
          data:  new FormData(this),
          contentType: false,
              cache: false,
          processData:false,        
         }).done(function(data){
            var json = JSON.parse(data);
            if(json.isValid){
              $('#uploadModal').find('#msg').html(json.message).show;
              $('#uploadModal').modal("show");
                       
            } else {
              $('#uploadModal').find('#msg').html(json.message).show;
              $('#uploadModal').modal("show");
            }
          });
      return false;
      }));
    });
  </script>

  
  </body>
</html>