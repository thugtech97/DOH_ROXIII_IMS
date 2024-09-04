<?php

session_start();

if(!isset($_SESSION["username"])){
    echo "<script>document.location='../login.php'; </script>";
}

?>

<!DOCTYPE html>
<html>

<head>
    <?php
        require "../assets/styles_assets.php";
    ?>
    
    <title>INVENTORY MS | Supply Records - Inspection and Acceptance Report</title>

</head>
<body style="color: black;">
    <div id="wrapper">
        <?php include("../assets/navbar.php"); ?>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <ul class="nav navbar-top-links navbar-left">
                            <li style="padding: 20px;"><?php echo $_SESSION["link1"]; ?> | Inspection and Acceptance Report
                        </li>
                        </ul>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="../php/php_logout.php">
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
            <br>
            <div class="row">
                <div class="col-lg-12 animated bounceInDown">
                    <div class="row wrapper border-bottom white-bg page-heading">
                        <div class="col-lg-10">
                            <h2>Inspection and Acceptance Report</h2>
                            <?php
                            if($_SESSION["role"] == "SUPPLY" || $_SESSION["role"] == "SUPPLY_SU"){ ?>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <button id="niar" type="button" class="btn btn-default dim" data-toggle="modal" data-target="#add_iar">
                                            <i class="fa fa-plus"></i> New IAR 
                                        </button>
                                    </li>
                                </ol>
                            <?php 
                                }
                            ?>
                        </div>
                        <div class="col-lg-2">

                        </div>
                    </div> 
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12 animated bounceInDown">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3><i class="fa fa-clipboard"></i> Inspection and Acceptance Report</h3>
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
                <?php
                    
                ?>
            </div>
            <?php
                //require "reports/report_pes.php";
                require "reports/report_iar_dm.php";
                require "reports/report_iar_gen.php";
                require "../modals/modal_add_iar.php";
                require "../modals/modal_edit_iar.php";
                require "../modals/modal_nod_dv.php";
            ?>
            <div class="footer">
                <div>
                    <strong>Copyright</strong> <?php echo $_SESSION["company_title"]; ?> &copy; <?php echo date("Y"); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
        require "../assets/small_chat.php";
        require "../assets/scripts_assets.php";
        require "../modals/modal_view_iss.php";
    ?>
    <script src="js/js_general_functions.js"></script>
    <script src="js/js_iar.js"></script>
    <script type="text/javascript">
        set_url("php/php_iar.php");
    </script>
</body>
</html>