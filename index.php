<?php
include("lib/init.php");
include("login-callback.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
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
        <a class="bottle" href=""><img src="assets/images/bottle_with_text.png"></a>
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
        <div class="arrowUp">&#11014;</div>
        <div class="col-xs-8 col-sm-6">
          <img class="home_message" src="assets/images/message_home.png">
        </div>
        <div class="col-xs-8 col-sm-11">
          <img class="promo_items" src="assets/images/promo_items.png">
        </div>
      </div>
      <div>
    </div>
  </div>

  <div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       <h3 style="color: #fff;">Registration</h4>
      </div>
      <div class="modal-body">
        <form class="horizontal" id="registration" method="post">
          <div class="form-group">
            <input type="hidden" name="api_token" value="qNoRXbEoEwxzKisReAkZ2pa7f8poTeq9">
            <input type="hidden" name="facebook_user_id" value="<?php echo $_SESSION['facebook_user_id'];?>">
            <label for="first_name">First Name</label>
            <input type="text" name="fname" class="form-control" id="fname" value= "<?php echo $_SESSION['first_name'];?>" required>
          </div>
          <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="lname" class="form-control" id="lname" value= "<?php echo $_SESSION['last_name'];?>" required>
          </div>

          <div class="form-group row">
            <label class="col-sm-6">Gender</label>
            <label class="col-sm-6">Date of Birth(YYYY-MM-DD)</label>
            <div class="col-sm-6">
              <select name ="gender" id="gender" class="form-control" required>
                <option id="male" value="Male">Male</option>
                <option id="female" value="Female">Female</option>
              </select>
            </div>
            <div class="col-sm-2">
              <select name="bday_year" id="bday_year" class="form-control"></select>
            </div>
            <div class="col-xs-2" style="margin-left:-22px;">
              <select name="bday_month" id="bday_month" class="form-control"></select>
            </div>
            <div class="col-xs-2" style="margin-left: -22px">
              <select name="bday_day" id="bday_day" class="form-control"></select>
            </div>
            <input type="hidden" name="birthdate" id="birthday">
          </div>
          <div class="form-group row">
            <label class="col-sm-6">City</label>
            <label class="col-sm-6">Province</label>
            <div class="col-sm-6">
              <input type="text" name="city" id="city" class="form-control" required>
            </div>
            <div class="col-sm-6">
              <input type="text" name="province" id="province" class="form-control" required>
            </div>
          </div>

          <div class="form-group">
            <label for="contact_number">Contact Number</label>
            <input type="text" class="form-control" name="contact_number" id="contact_number" size="11" required>
          </div>
          <div class="form-group">

            <label for="email">Email Address</label>
            <input type="email" name="email" class="form-control" id="email" value="<?php echo $_SESSION['email'];?>" required>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox" name="is_subscribe"> Subscribe to Email Updates
            </label>
            <button type="submit" class="btn btn-default btn-lg" id="reg_submit">Submit</button>
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<form class="session" id="session" method="get">
<input type="hidden" id='api_token' name="api_token" value="qNoRXbEoEwxzKisReAkZ2pa7f8poTeq9">
<input type="hidden" id="key" name="key" value="facebook_user_id">
<input type="hidden" id="fb_id" name="fb_id" value="<?php echo $_SESSION['facebook_user_id'];?>">
</form>
<h3></h3>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/modal.js"></script>
  <script src="assets/js/date.js"></script>
  <script src="assets/js/facebook.js"></script>
  <script type="text/javascript">
  var api_token = $("#api_token").val()
  var key = $("#key").val()
  var fb_id = $("#fb_id").val()
  $(function(){
    var info = {
        init: function(){
          $.ajax({
            type: "GET",
            url: 'func/info.php',
            cache: false,
            data: {api_token:api_token, key: key, value:fb_id},
         }).done(function(data){
            var json = JSON.parse(data);
            if(json.isValid == false){
              console.log(json);
              $('#myModal').modal({backdrop: 'static', keyboard: false },"show")
                      
            } else {
              console.log(json); 
            }
          });
        }
      };
      
      info.init();

      $("#registration").submit(function(event){
          var formData = $("#registration").serializeArray();
          var url = "moab.highlysucceed.com/api/auth/register.json";
          $.ajax({
            type: "POST",
            cache:false,
            url: url,
            data: formData
          }).done(function(data){
              var json = JSON.parse(data);
              if(json.isValid){
                $('#myModal').modal("hide");
                alert(json.msg);
                window.location= "index.php"
              } else {
               alert(json.msg);
              }
          });
      event.preventDefault();
      });
  });
 

  </script> 











  








  </body>
</html>