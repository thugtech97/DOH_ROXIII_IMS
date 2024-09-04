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

    <title>INVENTORY MS | Stock Card</title>

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
                <li style="padding: 20px;">Stock Card
            </li>
            </ul>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <button class="btn btn-xs btn-default dim" onclick="$('#print_idr').modal();"><i class="fa fa-print"></i> Incoming Delivery Report</button>
                </li>&nbsp;&nbsp;
                <li>
                    <button class="btn btn-xs btn-default dim" onclick="$('#print_ppe').modal();"><i class="fa fa-print"></i> PPE (ICT/Various Supplies)</button>
                </li>&nbsp;&nbsp;
                <li>
                    <button class="btn btn-xs btn-default dim" onclick="$('#print_rsmi').modal();"><i class="fa fa-print"></i> RSMI (RIS-Consumables)</button>
                </li>&nbsp;&nbsp;
                <li>
                    <button class="btn btn-xs btn-default dim" onclick="generate_wi();"><i class="fa fa-print"></i> Warehouse Inventory</button>
                </li>&nbsp;&nbsp;
                <li>
                    <button class="btn btn-xs btn-default dim" onclick="get_rpci();"><i class="fa fa-print"></i> RPCI (All Categories)</button>
                </li>&nbsp;&nbsp;
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
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <br>
                <div class="row">
                    <div class="col-lg-5">
                        <!---
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label"><b>Select a category:</b></label>
                            <div class="col-lg-8">
                                <select id="category" class="select2_demo_1 form-control">
                                    <option value="" disabled selected></option>
                                </select>
                            </div>
                        </div>
                        !-->
                    </div>
                    <div class="col-lg-7">
                        <button type="button" class="btn btn-default pull-right dim" data-toggle="modal" data-target="#gen_ics_par">
                            <i class="fa fa-print"></i> ICS/PAR
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-4">
                <div class="ibox" style="border-style: solid; border-color: black; border-width: 1px;">
                    <div class="ibox-title">
                        <h5>Items&nbsp;&nbsp;<span id="num_items" class="label label-success" style="border-radius: 10px;">0</span></h5>
                        <input type="text" id="searchkw" class="pull-right" placeholder="Search...">
                    </div>
                    <div class="ibox-content" style="height: 100vh;overflow:auto;">
                        <div class="dd" id="nestable">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 animated bounceIn">
                <div class="ibox" style="border-style: solid; border-color: black; border-width: 1px;">
                    <div class="ibox-title">
                        <h5>Stockcard Preview&nbsp;&nbsp;&nbsp;<span id="loader" style="display: none;"><i class="fa fa-refresh fa-spin" style="color: black;"></i></span></h5>
                        <div class="pull-right">
                            <span><button class="btn btn-default btn-xs dim" onclick="load_sc_spec('1');" title="Show Released">✔️</button></span>
                            <span><button class="btn btn-default btn-xs dim" onclick="load_sc_spec('0');" title="Show Unreleased">❌</button></span>
                            <span><button class="btn btn-default btn-xs dim" onclick="print_sc();"><i class="fa fa-print"></i> Print</button></span>
                        </div>
                    </div>
                    <div class="ibox-content" style="color: black;">
                        Reference Number:
                        <select id="sc_refn" style="border-radius: 5px;">

                        </select>
                        <?php require "reports/report_sc.php"; ?>
                    </div>
                </div>
            </div>
            <?php require "modals/modal_ppe.php"; ?>
            <?php require "modals/modal_rsmi.php"; ?>
            <?php require "modals/modal_rpci.php"; ?>
            <?php require "modals/modal_gen_ics_par.php"; ?>
        </div>
        <br>
        <br>
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

    <?php
        require "assets/scripts_assets.php";
    ?>

    <script src="js/js_sc.js"></script>
    <script type="text/javascript">
    </script>
</body>
</html>