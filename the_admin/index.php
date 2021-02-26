<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <?php
        require "../assets/styles_assets.php";
    ?>
    
    <title>INVENTORY MS | ADMINISTRATOR</title>

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
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <ul class="nav navbar-top-links navbar-left">
                            <li style="padding: 20px;">IMS | Administrator</span>
                        </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row wrapper border-bottom white-bg page-heading">
                        <div class="col-lg-10">
                            <h2>Administrator</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_user">
                                        <i class="fa fa-plus"></i> Add New User
                                    </button>
                                </li>
                            </ol>
                        </div>
                        <div class="col-lg-2">

                        </div>
                    </div> 
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5><i class="fa fa-users"></i> Active Users</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table id="tbl_users" class="table table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th>Fullname</th>
                                            <th>Role</th>
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
            <?php
                require "../modals/modal_add_user.php";
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
    ?>
    <script src="js/js_admin.js"></script>
</body>
</html>