<?php
    $base_url = "https://" . $_SERVER['HTTP_HOST'] . "/DOH_ROXIII_IMS";
    $uri = end(explode("/", $_SERVER['REQUEST_URI']));
?>

<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        <ul class="nav navbar-top-links navbar-left">
            <li style="padding: 20px;" id="page-title">
            </li>
        </ul>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <?php if($uri == "po.php") { ?>
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
        <?php } ?>

        <?php if($uri == "stockcard.php") { ?>
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
        <?php } ?>

        <li>
            <a href="<?php echo $base_url; ?>/php/php_logout.php">
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

<script>
    document.getElementById("page-title").textContent = document.title;
</script>