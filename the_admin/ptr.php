<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <?php
        require "../assets/scripts_assets.php";
        require "../assets/styles_assets.php";
    ?>
    <title>INVENTORY MS | Supply Records - PTR</title>

</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                                <center><img alt="image" class="rounded-circle" src="../../archives/img/<?php echo $_SESSION["company_logo"]; ?>" height="50" width="50"/>
                                <a href="index.php">
                                    <span class="block m-t-xs font-bold">The Admin</span>
                                    <span class="text-muted text-xs block">User <b class="caret"></b></span>
                                </a>
                            </center>
                        </div>
                        <div class="logo-element">
                            IMS+
                        </div>
                    </li>
                    <li><a href="../login.php"><i class="fa fa-sign-in"></i> <span class="nav-label">Login Page</span></a></li>
                    <li><a href="ics.php"><i class="fa fa-clipboard"></i> <span class="nav-label">ICS</span></a></li>
                    <li><a href="par.php"><i class="fa fa-clipboard"></i> <span class="nav-label">PAR</span></a></li>
                    <li class="active"><a href="ptr.php"><i class="fa fa-clipboard"></i> <span class="nav-label">PTR</span></a></li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1" style="color: black;">
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
                            <h5><i class="fa fa-houzz"></i> PTR</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table id="test_table" class="table table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>PTR No.</th>
                                            <th>Recipient</th>
                                            <th>Item</th>
                                            <th>Description</th>
                                            <th>Serial No</th>
                                            <th>Property No</th>
                                            <th>Unit</th>
                                            <th>Cost</th>
                                            <th>Quantity</th>
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
                    <strong>Copyright</strong> <?php echo $_SESSION["company_title"]; ?> &copy; <?php echo date("Y"); ?>
                </div>
            </div>
        </div>
    </div>

<!--end of wrapper !-->

    <?php
        require "../assets/small_chat.php";
    ?>
    <script src="js/testscript.js"></script>
    <script type="text/javascript">
        get_ptr();
    </script>
</body>
</html>