<?php

session_start();

if(isset($_SESSION["username"])){
    echo "<script>document.location='index.php'; </script>";
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INVENTORY MS | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link rel="shortcut icon" type="image/x-icon" href="imgsys/DOH-logo.png">
    <link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-md-6" style="background-color:  #7FFF00;">
                <center>
                    <img src="imgsys/DOH-logo.png" height="330" width="340">
                </center>
            </div>
            <div class="col-md-6" style="width: 100%;">
                <div class="ibox-content">
                    <form class="m-t" role="form">
                        <div class="form-group">
                            <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="" autofocus="">
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                        <br>
                        <p class="text-muted text-center">
                            <small>Do not have an account?</small>
                        </p>
                    </form>
                    <button class="btn btn-sm btn-white btn-block">Create an account</button>
                    <p class="m-t">
                        <small>DOH-CHD CARAGA &copy; <?php echo date("Y"); ?></small>
                    </p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                INVENTORY MANAGEMENT SYSTEM
            </div>
            <div class="col-md-6 text-right">
               <small>All Rights Reserved &copy; <?php echo date("Y"); ?></small>
            </div>
        </div>
    </div>
    <script src="sweetalert-master/dist/sweetalert.min.js"></script>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          $('form').on('submit', function(event) {
            $.ajax({
              type:"POST",
              data:"username="+$("#username").val()+"&password="+$("#password").val(),
              url:"php/php_login.php",
              }).done(function(data){
                if(data=="1"){
                  window.location = "index.php";
                }else{
                  swal("Login failed!", "Account not found.", "error");
                }
              });
              event.preventDefault();
          });
        });
    </script>
</body>
</html>