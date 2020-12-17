<!DOCTYPE html>
<html>

<head>
    <?php
        require "../assets/scripts_assets.php";
        require "../assets/styles_assets.php";
    ?>
    <title>INVENTORY MS | Supply Records - Property Acknowledgement Receipt</title>

</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="logo-element">
                            IMS+
                        </div>
                    </li>
                </ul>

            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <ul class="nav navbar-top-links navbar-left">
                            <li style="padding: 20px;">
                        </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5><i class="fa fa-houzz"></i> Inventory Custodian Slip</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table id="test_table" class="table table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Issued</th>
                                            <th>Area</th>
                                            <th>ICS No.</th>
                                            <th>PO No.</th>
                                            <th>Property No.</th>
                                            <th>Serial No.</th>
                                            <th>Category</th>
                                            <th>Date Released</th>
                                            <th>Received From</th>
                                            <th>Received By</th>
                                            <th>Supply Received Date</th>
                                            <th>Remarks</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div>
                    <strong>Copyright</strong> DOH-CHD-CARAGA &copy; <?php echo date("Y"); ?>
                </div>
            </div>
        </div>
    </div>

<!--end of wrapper !-->

    <?php
        require "../assets/small_chat.php";
    ?>
    <script src="testscript.js"></script>
    <script type="text/javascript">
        get_records("get_records1", "ICS");
    </script>
</body>
</html>