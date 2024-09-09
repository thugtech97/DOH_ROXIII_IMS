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
    <title>INVENTORY MS | For SAI</title>
</head>
<body>
    <div id="wrapper">
        <?php include("assets/navbar.php"); ?>
        <div id="page-wrapper" class="gray-bg dashbard-1" style="color: black;">
        <div class="row border-bottom">
            <?php require "assets/topmenu.php"; ?> 
        </div>

<?php

if(isset($_SESSION["username"])) {

?>
        <br>
        <div class="row">
            <div class="col-lg-12 animated bounceInDown">
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>Supplies Availability Inquiry (SAI)</h2>
                        <?php
                        if($_SESSION["role"] == "SUPPLY" || $_SESSION["role"] == "SUPPLY_SU"){ ?>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <button type="button" class="btn btn-default dim" onclick="">
                                        <i class="fa fa-get-pocket"></i> Fetch Purchase Requests for SAI
                                    </button>
                                </li>
                                <li class="breadcrumb-item">
                                    <button type="button" class="btn btn-default dim" data-toggle="modal" data-target="#sai_reports">
                                        <span class="label label-danger" style="border-radius: 10px;" id="count_sai">0</span>&nbsp;View SAI Reports
                                    </button>
                                </li>
                            </ol>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-lg-12 animated bounceInDown">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3><i class="fa fa-clipboard"></i> Purchase Requests - Retrieved from E-Planning System</h3>
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

<?php } ?>
        <?php
            require "reports/report_sai.php";
            require "modals/modal_sai_items.php";
        ?>
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
    <!-- SAI scripts  -->
    <script src="js/js_sai.js"></script>
    <script type="text/javascript">
        set_url("php/php_sai.php");
    </script>
    
</body>
</html>