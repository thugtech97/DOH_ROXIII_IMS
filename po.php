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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/demand_letter.css">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link rel="shortcut icon" type="image/x-icon" href="../archives/img/<?php echo $_SESSION["company_logo"]; ?>">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="sweetalert-master/dist/sweetalert.css">

    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <script src="js/jquery-3.1.1.min.js"></script>
    
    <link href="css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="css/plugins/select2/select2-bootstrap4.min.css" rel="stylesheet">
    <script src="js/plugins/select2/select2.full.min.js"></script>
<!--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.1/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.1/select2.min.js"></script>

    <link href="js/select2.min.css" rel="stylesheet" />
    <script src="js/select2.min.js"></script>
!-->
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">

    <title>INVENTORY MS | Purchase Orders</title>

</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                                <center><img alt="image" class="rounded-circle" src="../archives/img/<?php echo $_SESSION["company_logo"]; ?>" height="50" width="50"/>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="block m-t-xs font-bold"><?php echo $_SESSION["username"]; ?></span>
                                    <span class="text-muted text-xs block"><?php echo $_SESSION["role"]; ?><b class="caret"></b></span>
                                </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="">Profile</a></li>
                                <li><a class="dropdown-item" href="">Contacts</a></li>
                                <li><a class="dropdown-item" href="">Mailbox</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="php/php_logout.php">Logout</a></li>
                            </ul>
                            </center>
                        </div>
                        <div class="logo-element">
                            IMS+
                        </div>
                    </li>
                    <li>
                        <a href="index.php"><i class="fa fa-th-large"></i> <span class="nav-label"><?php echo $_SESSION["link0"]; ?></span></a>
                    </li>
                    <li class="active">
                        <a href="po.php"><i class="fa fa-list-alt"></i> <span class="nav-label">Purchase Orders</span></a>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-clipboard"></i> <span class="nav-label"><?php echo $_SESSION["link1"]; ?></span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="supply_records/iar.php"><i class="fa fa-clipboard"></i> IAR</a></li>
                            <li><a href="supply_records/ics.php"><i class="fa fa-clipboard"></i> ICS</a></li>
                            <li><a href="supply_records/par.php"><i class="fa fa-clipboard"></i> PAR</a></li>
                            <li><a href="supply_records/ris.php"><i class="fa fa-clipboard"></i> RIS</a></li>
                            <li><a href="supply_records/ptr.php"><i class="fa fa-clipboard"></i> PTR</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-table"></i> <span class="nav-label"><?php echo $_SESSION["link2"]; ?></span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="reference_tables/area.php"><i class="fa fa-area-chart"></i> Area</a></li>
                            <li><a href="reference_tables/rcc.php"><i class="fa fa-code-fork"></i> RCC</a></li>
                            <li><a href="reference_tables/category.php"><i class="fa fa-tag"></i> Category</a></li>
                            <li><a href="reference_tables/item.php"><i class="fa fa-object-group"></i> Item</a></li>
                            <li><a href="reference_tables/unit.php"><i class="fa fa-balance-scale"></i> Unit</a></li>
                            <li><a href="reference_tables/supplier.php"><i class="fa fa-users"></i> Supplier</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="stockcard.php"><i class="fa fa-bars"></i> <span class="nav-label">Stock Card</span></a>
                    </li>
                    <li>
                        <a href="archives.php"><i class="fa fa-archive"></i> <span class="nav-label">Archive</span></a>
                    </li>
                    <li>
                        <a href="php/php_logout.php"><i class="fa fa-power-off"></i> <span class="nav-label">Logout</span></a>
                    </li>
                </ul>

            </div>
        </nav>
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
                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" onclick="//$('#view_supp').modal();">
                            <i class="fa fa-users"></i><span class="label label-danger" id="count_supp">0</span>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts" id="nestable" style="height: 500px; overflow: auto;">
                            
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
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_po">
                                            <i class="fa fa-plus"></i> New Purchase Order
                                        </button>
                                    </li>
                                    <!--<li class="breadcrumb-item">
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#add_ntc">
                                            <i class="fa fa-plus"></i> Add NTC Form
                                        </button>
                                    </li>!-->
                                    <li class="breadcrumb-item">
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#bal_fwd">
                                            <i class="fa fa-plus"></i> New Balance Forward
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
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3><i class="fa fa-list-alt"></i> Purchase Orders</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="tbl_po" class="table table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Date Received</th>
                                            <th>P.O Number</th>
                                            <th>Items</th>
                                            <th>Mode of Procurement</th>
                                            <th>Date Conformed</th>
                                            <th>Expected Delivery</th>
                                            <th>Date Delivered</th>
                                            <th>Supplier</th>
                                            <th>End User</th>
                                            <th>Status</th>
                                            <th>Inspected</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="12">
                                                <center>
                                                    <div class="spiner-example">
                                                        <script type="text/javascript">
                                                            var arr = ["<div class=\"sk-spinner sk-spinner-wave\"><div class=\"sk-rect1\"></div>&nbsp;<div class=\"sk-rect2\"></div>&nbsp;<div class=\"sk-rect3\"></div>&nbsp;<div class=\"sk-rect4\"></div>&nbsp;<div class=\"sk-rect5\"></div></div>", "<div class=\"sk-spinner sk-spinner-rotating-plane\"></div>", "<div class=\"sk-spinner sk-spinner-double-bounce\"><div class=\"sk-double-bounce1\"></div><div class=\"sk-double-bounce2\"></div></div>", "<div class=\"sk-spinner sk-spinner-wandering-cubes\"><div class=\"sk-cube1\"></div><div class=\"sk-cube2\"></div></div>", "<div class=\"sk-spinner sk-spinner-pulse\"></div>", "<div class=\"sk-spinner sk-spinner-chasing-dots\"><div class=\"sk-dot1\"></div><div class=\"sk-dot2\"></div></div>", "<div class=\"sk-spinner sk-spinner-three-bounce\"><div class=\"sk-bounce1\"></div><div class=\"sk-bounce2\"></div><div class=\"sk-bounce3\"></div></div>", "<div class=\"sk-spinner sk-spinner-circle\"><div class=\"sk-circle1 sk-circle\"></div><div class=\"sk-circle2 sk-circle\"></div><div class=\"sk-circle3 sk-circle\"></div><div class=\"sk-circle4 sk-circle\"></div><div class=\"sk-circle5 sk-circle\"></div><div class=\"sk-circle6 sk-circle\"></div><div class=\"sk-circle7 sk-circle\"></div><div class=\"sk-circle8 sk-circle\"></div><div class=\"sk-circle9 sk-circle\"></div><div class=\"sk-circle10 sk-circle\"></div><div class=\"sk-circle11 sk-circle\"></div><div class=\"sk-circle12 sk-circle\"></div></div>", "<div class=\"sk-spinner sk-spinner-cube-grid\"><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div></div>", "<div class=\"sk-spinner sk-spinner-fading-circle\"><div class=\"sk-circle1 sk-circle\"></div><div class=\"sk-circle2 sk-circle\"></div><div class=\"sk-circle3 sk-circle\"></div><div class=\"sk-circle4 sk-circle\"></div><div class=\"sk-circle5 sk-circle\"></div><div class=\"sk-circle6 sk-circle\"></div><div class=\"sk-circle7 sk-circle\"></div><div class=\"sk-circle8 sk-circle\"></div><div class=\"sk-circle9 sk-circle\"></div><div class=\"sk-circle10 sk-circle\"></div><div class=\"sk-circle11 sk-circle\"></div><div class=\"sk-circle12 sk-circle\"></div></div>"];
                                                            document.write(arr[Math.floor(Math.random() * arr.length)]);
                                                        </script>
                                                    </div>
                                                </center>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <?php
                require "modals/modal_add_po.php";
                require "modals/modal_add_ntc.php";
                require "modals/modal_edit_po_various.php";
                require "modals/modal_fill_pax.php";
                require "modals/modal_view_po.php";
                require "modals/modal_add_bf.php";
                require "modals/modal_view_conso.php";
                require "modals/modal_dl.php";
                require "reports/report_dl.php";
            ?>

            <div class="footer">
                <div>
                    <strong>Copyright</strong> <?php echo $_SESSION["company_title"]; ?> &copy; <?php echo date("Y"); ?>
                </div>
            </div>
        </div>
        <div class="small-chat-box fadeInRight animated">
            <div class="heading" draggable="true">
                <small class="chat-date float-right">
                    02.19.2015
                </small>
                Small chat
            </div>
            <div class="content">
            </div>
            <div class="form-chat">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control">
                    <span class="input-group-btn"> <button
                        class="btn btn-primary" type="button">Send
                </button> </span></div>
            </div>

        </div>
        <div id="small-chat">

            <?php //<span class="badge badge-warning float-right"></span> ?>
            <a class="open-small-chat" href="">
                <i class="fa fa-comments"></i>
            </a>
        </div>
        <div id="right-sidebar" class="animated">
            <div class="sidebar-container">

                <ul class="nav nav-tabs navs-3">
                    <li>
                        <a class="nav-link active" data-toggle="tab" href="#tab-1"> Notes </a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="tab" href="#tab-2"> Projects </a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="tab" href="#tab-3"> <i class="fa fa-gear"></i> </a>
                    </li>
                </ul>

                <div class="tab-content">

                </div>
            </div>
        </div>
    </div>

<!--end of wrapper !-->
    
    <!-- Mainly scripts -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <script src="js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="js/demo/sparkline-demo.js"></script>

    <!-- Toastr -->
    <script src="js/plugins/toastr/toastr.min.js"></script>

    <script src="sweetalert-master/dist/sweetalert.min.js"></script>

    <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

    <script src="js/js_po.js"></script>
    <script src="js/js_ntc.js"></script>
    <script src="js/js_bf.js"></script>

</body>
</html>