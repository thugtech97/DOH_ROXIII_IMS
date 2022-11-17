<?php

session_start();

if(isset($_SESSION["uname"])){
    echo "<script>document.location='main.php'; </script>";
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>IMS | Property Custodian</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

    <link rel="shortcut icon" type="image/x-icon" href="../imgsys/img_avatar2.png">

    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

</head>

<body class="gray-bg" style="color: black;">
    <div class="middle-box text-center loginscreen animated bounceIn" style="border-width: 2px; border-color: black; border-style: solid; border-radius: 20px; padding: 40px; margin-top: 5%; background-color: white">
        <div>
            <div>
                <img src="../imgsys/img_avatar2.png" style="width: 75%; border-radius: 50%;"><br><br>
            </div>
            <h3>Property Custodian Authentication</h3>
            <form class="m-t" role="form">
                <div class="form-group">
                    <input type="text" class="form-control" id="username" placeholder="Username" required="" autofocus="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>

    <script src="js/pptctd_js.js"></script>
    <script type="text/javascript">
        $('form').on('submit', function(event){
            $.ajax({
                type:"POST",
                data:"call_func=login&username="+$("#username").val()+"&password="+$("#password").val(),
                url:"php/pptctd_php.php",
            }).done(function(data){
                if(data=="1"){
                    window.location = "main.php";
                }else{
                    alert("login failed");
                }
            });
            event.preventDefault();
        });
    </script>

</body>

</html>