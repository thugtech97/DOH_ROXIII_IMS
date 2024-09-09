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
        require "../assets/styles_assets.php";
    ?>
    <title>INVENTORY MS | Supply Records - Request for Inspection</title>
</head>
<body style="color: black;">
    <div id="wrapper">

        <?php include("../assets/navbar.php"); ?>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <?php include("../assets/topmenu.php"); ?>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12 animated bounceInDown">
                    <div class="row wrapper border-bottom white-bg page-heading">
                        <div class="col-lg-10">
                            <h2>Gatepass Creation</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <button type="button" class="btn btn-default dim" data-toggle="modal" data-target="#add_rfi">
                                        <i class="fa fa-plus"></i> Create Gatepass
                                    </button>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12 animated bounceInDown">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3><i class="fa fa-clipboard"></i> Gatepass Records</h3>
                        </div>
                        <div class="panel-body">
                            <div class="pull-right">
                                Search: <input type="text" name="search_box" id="search_box"/>
                            </div>
                            <div class="table-responsive" id="dynamic_content">

                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="footer">
                <div>
                    <strong>Copyright</strong> <?php echo $_SESSION["company_title"]; ?> &copy; <?php echo date("Y"); ?>
                </div>
            </div>
            <?php
                require "../assets/small_chat.php";
                
            ?>
        </div>
    </div>
    <?php
        require "../assets/scripts_assets.php";
    ?>

    <!-- RFI script -->
   
    <script type="text/javascript">
        
    </script>

</body>
</html>
