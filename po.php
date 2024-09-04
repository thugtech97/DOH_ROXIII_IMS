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
    <title>INVENTORY MS | Purchase Orders</title>

</head>
<body>
    <div id="wrapper">
        <?php include("assets/navbar.php"); ?>
        <div id="page-wrapper" class="gray-bg dashbard-1" style="color: black;">
            <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                <ul class="nav navbar-top-links navbar-left">
                    <li style="padding: 20px;">Purchase Orders</li>
                </ul>
            </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                            <i class="fa fa-users"></i><span class="label label-danger" id="count_supp"><i class="fa fa-refresh fa-spin"></i> </span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts" id="nestable" style="height: 460px; overflow: auto;">
                            <li>
                                <a class="dropdown-item">
                                    <div>
                                        <span class="text-muted medium"><center>No NOTC to generate.</center></span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
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
            <br>
            <div class="row">
                <div class="col-lg-12 animated bounceInDown">
                    <div class="row wrapper border-bottom white-bg page-heading">
                        <div class="col-lg-10">
                            <h2>Purchase Orders</h2>
                            <?php
                            if($_SESSION["role"] == "SUPPLY" || $_SESSION["role"] == "SUPPLY_SU"){ ?>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <button type="button" class="btn btn-default dim" data-toggle="modal" data-target="#add_po">
                                            <i class="fa fa-plus"></i> New Purchase Order
                                        </button>
                                    </li>
                                    <!--<li class="breadcrumb-item">
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#add_ntc">
                                            <i class="fa fa-plus"></i> Add NTC Form
                                        </button>
                                    </li>!-->
                                    <li class="breadcrumb-item">
                                        <button type="button" class="btn btn-default dim" data-toggle="modal" data-target="#bal_fwd">
                                            <i class="fa fa-plus"></i> New Balance Forward
                                        </button>
                                    </li>
                                </ol>
                            <?php 
                                }
                            ?>
                        </div>
                        <div class="col-lg-2">
                            <h2 style="visibility: hidden;">hehehe</h2>
                            <button type="button" class="btn btn-default pull-right dim" data-toggle="modal" data-target="#search_item">
                                <i class="fa fa-search"></i> Search Item
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12 animated bounceInDown">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3><i class="fa fa-clipboard"></i> Purchase Orders</h3>
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

             <?php
                require "modals/modal_search_item.php";
                require "modals/modal_add_po.php";
                require "modals/modal_add_ntc.php";
                require "modals/modal_edit_po_various.php";
                require "modals/modal_fill_pax.php";
                require "modals/modal_view_po.php";
                require "modals/modal_add_bf.php";
                require "modals/modal_view_conso.php";
                require "modals/modal_dl.php";
                require "modals/modal_billing_history.php";
                //require "reports/report_dl.php";
                require "reports/report_notc.php";
            ?>

            <div class="footer">
                <div>
                    <strong>Copyright</strong> <?php echo $_SESSION["company_title"]; ?> &copy; <?php echo date("Y"); ?>
                </div>
            </div>
        </div>
        <?php
            require "assets/small_chat.php";
        ?>
    </div>

<!--end of wrapper !-->

    <?php
        require "assets/scripts_assets.php";
    ?>

    <script src="js/js_po.js"></script>
    <script src="js/js_ntc.js"></script>
    <script src="js/js_bf.js"></script>
    <script type="text/javascript">
        set_url("php/php_po.php");
    </script>

</body>
</html>