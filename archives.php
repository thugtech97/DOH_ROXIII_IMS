<?php

session_start();

if(!isset($_SESSION["username"])){
    echo "<script>document.location='login.php'; </script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php
        require "assets/styles_assets.php";
    ?>
    <title>INVENTORY MS | Archives</title>
</head>
<body style="color: black;">
<div id="wrapper">

<?php include("assets/navbar.php"); ?>
    <div id="page-wrapper" class="gray-bg">
    <div class="row border-bottom">
            <?php require "assets/topmenu.php"; ?> 
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
<?php
            require "assets/small_chat.php";
        ?>
</div>

    <?php
        require "assets/scripts_assets.php";
    ?>

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
