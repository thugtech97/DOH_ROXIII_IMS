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
        require "../assets/scripts_assets.php";
        require "../assets/styles_assets.php";
    ?>
    <link href="../css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <title>INVENTORY MS | Supply Records - Property Transfer Report</title>

</head>
<body style="color: black;">
    <div id="wrapper">
        <?php include("../assets/navbar.php"); ?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <?php include("../assets/topmenu.php"); ?>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12 animated bounceInDown">
                    <div class="row wrapper border-bottom white-bg page-heading">
                        <div class="col-lg-10">
                            <h2>Property Transfer Report</h2>
                            <?php
                            if($_SESSION["role"] == "SUPPLY" || $_SESSION["role"] == "SUPPLY_SU"){ ?>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <button type="button" class="btn btn-default dim" id="btn_add_ptr" data-toggle="modal" data-target="#add_ptr">
                                            <i class="fa fa-plus"></i> Add PTR
                                        </button>
                                        <button type="button" class="btn btn-default dim" data-toggle="modal" data-target="#ptr_alloc">
                                            <i class="fa fa-upload"></i> Upload Allocation List
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
                            <h3><i class="fa fa-clipboard"></i> Property Transfer Report</h3>
                        </div>
                        <div class="panel-body">
                            <div class="pull-right">
                                Search: <input type="text" name="search_box" id="search_box"/>
                            </div>
                            <div class="table-responsive" id="dynamic_content">
                                
                            </div>
                        </div>
                    </div>
                    <?php require "reports/report_ptr_gen.php"; ?>
                </div>
            </div>
            <div class="footer">
                <div>
                    <strong>Copyright</strong> <?php echo $_SESSION["company_title"]; ?> &copy; <?php echo date("Y"); ?>
                </div>
            </div>
        </div>

        <?php
            require "../modals/modal_add_ptr.php";
            require "../modals/modal_edit_ptr.php";
            require "../modals/modal_view_iss.php";
            require "../modals/modal_edit_dr.php";
            require "modals/modal_ptr_alloc.php";
            require "../modals/modal_add_item_issuances.php";
            require "modals/modal_ptr_preview.php";
        ?>

    </div>

    <!--end of wrapper !-->

    <?php
        require "../assets/small_chat.php";
    ?>
    <script src="../js/plugins/dataTables/datatables.min.js"></script>
    <script src="../js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

    <script src="../js/plugins/bs-custom-file/bs-custom-file-input.min.js"></script>
    <script src="js/js_general_functions.js"></script>

    <script src="js/js_ptr.js"></script>
    <script type="text/javascript">
        set_url("php/php_ptr.php");
    </script>
</body>
</html>