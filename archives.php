<?php

session_start();

if(!isset($_SESSION["username"])){
    echo "<script>document.location='login.php'; </script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTORY MS | Archives</title>
    <link rel="shortcut icon" type="image/x-icon" href="../archives/img/<?php echo $_SESSION["company_logo"]; ?>">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<style>
    div.gallery {
      border: 1px solid #ccc;
    }
    div.gallery:hover {
      border: 1px solid #777;
    }
    div.gallery img {
      width: 100%;
      height: auto;
    }
    div.desc {
      padding: 15px;
      text-align: center;
      color: black;
      border-top: 1px solid #ccc;
    }
    * {
      box-sizing: border-box;
    }
    .responsive {
      padding: 0 6px;
      float: left;
      width: 24.99999%;
    }
    @media only screen and (max-width: 700px) {
      .responsive {
        width: 49.99999%;
        margin: 6px 0;
      }
    }
    @media only screen and (max-width: 500px) {
      .responsive {
        width: 100%;
      }
    }
    .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }
</style>

<body style="color: black;">

<div id="wrapper">

<?php include("assets/navbar.php"); ?>
    <div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                <ul class="nav navbar-top-links navbar-left">
                    <li style="padding: 20px;">Archives
                </li>
                </ul>
            </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="php/php_logout.php">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                    <li>
                        <a class="right-sidebar-toggle">
                            <i class="fa fa-tasks"></i>
                        </a>
                    </li>
                </ul>

            </nav>
        </div>
<div class="wrapper wrapper-content animated fadeInRight">
    <!--  
    <div class="responsive">
      <div class="gallery">
        <a target="_blank" href="imgsys/po_pdf.png">
          <img src="imgsys/po_pdf.png" alt="Cinque Terre" width="600" height="400">
        </a>
        <div class="desc">Add a description of the image here</div>
      </div>
    </div>
    <div class="responsive">
      <div class="gallery">
        <a target="_blank" href="imgsys/po_pdf.png">
          <img src="imgsys/po_pdf.png" alt="Cinque Terre" width="600" height="400">
        </a>
        <div class="desc">Add a description of the image here</div>
      </div>
    </div>
    <div class="responsive">
      <div class="gallery">
        <a target="_blank" href="imgsys/po_pdf.png">
          <img src="imgsys/po_pdf.png" alt="Cinque Terre" width="600" height="400">
        </a>
        <div class="desc">Add a description of the image here</div>
      </div>
    </div>
    !-->
    <embed id="img_po" src="php/filemanager.php" height="1000" width="100%"/>
</div>
<div class="footer">
    <div>
        <strong>Copyright</strong> <?php echo $_SESSION["company_title"]; ?> &copy; <?php echo date("Y"); ?>
    </div>
</div>

</div>
</div>

<!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

<script>

    $(document).ready(function () {

        // Add slimscroll to element
        $('.scroll_content').slimscroll({
            height: '200px'
        })
    });

</script>

</body>
</html>
