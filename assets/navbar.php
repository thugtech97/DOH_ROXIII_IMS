<?php
    $base_url = "http://" . $_SERVER['HTTP_HOST'] . "/DOH_ROXIII_IMS";
    $uri = end(explode("/", $_SERVER['REQUEST_URI']));
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <center><img alt="image" class="rounded-circle" src="<?php echo "http://" . $_SERVER['HTTP_HOST'] ?>/archives/img/<?php echo $_SESSION["company_logo"]; ?>" height="50" width="50"/>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="block m-t-xs font-bold"><?php echo $_SESSION["username"]; ?></span>
                            <span class="text-muted text-xs block"><?php echo $_SESSION["role"]; ?><b class="caret"></b></span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a class="dropdown-item" href="">Profile</a></li>
                            <li><a class="dropdown-item" href="">Contacts</a></li>
                            <li><a class="dropdown-item" href="">Mailbox</a></li>
                            <li class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo $base_url; ?>/php/php_logout.php">Logout</a></li>
                        </ul>
                    </center>
                </div>
                <div class="logo-element">
                    IMS+
                </div>
            </li>
            <li class="<?php echo $uri == 'index.php' ? 'active' : ''; ?>">
                <a href="<?php echo $base_url; ?>/index.php"><i class="fa fa-th-large"></i> <span class="nav-label"><?php echo $_SESSION["link0"]; ?></span></a>
            </li>
            <li class="<?php echo $uri == 'po.php' ? 'active' : ''; ?>">
                <a href="<?php echo $base_url; ?>/po.php"><i class="fa fa-list-alt"></i> <span class="nav-label">Purchase Orders</span></a>
            </li>
            <li class="<?php echo $uri == 'iar.php' || $uri == 'ics.php' || $uri == 'par.php' || $uri == 'ris.php' || $uri == 'ptr.php' || $uri == 'rfi.php' ? 'active' : ''; ?>">
                <a href=""><i class="fa fa-clipboard"></i> <span class="nav-label"><?php echo $_SESSION["link1"]; ?></span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?php echo $uri == 'rfi.php' ? 'active' : ''; ?>"><a href="<?php echo $base_url; ?>/supply_records/rfi.php"><i class="fa fa-clipboard"></i> Request for Inspection (RFI)</a></li>
                    <li class="<?php echo $uri == 'iar.php' ? 'active' : ''; ?>"><a href="<?php echo $base_url; ?>/supply_records/iar.php"><i class="fa fa-clipboard"></i> Inspection and Acceptance Report (IAR)</a></li>
                    <li class="<?php echo $uri == 'ics.php' ? 'active' : ''; ?>"><a href="<?php echo $base_url; ?>/supply_records/ics.php"><i class="fa fa-clipboard"></i> Inventory Custodian Slip (ICS)</a></li>
                    <li class="<?php echo $uri == 'par.php' ? 'active' : ''; ?>"><a href="<?php echo $base_url; ?>/supply_records/par.php"><i class="fa fa-clipboard"></i> Property Acknowledgement Receipt (PAR)</a></li>
                    <li class="<?php echo $uri == 'ris.php' ? 'active' : ''; ?>"><a href="<?php echo $base_url; ?>/supply_records/ris.php"><i class="fa fa-clipboard"></i> Requisition and Issue Slip (RIS)</a></li>
                    <li class="<?php echo $uri == 'ptr.php' ? 'active' : ''; ?>"><a href="<?php echo $base_url; ?>/supply_records/ptr.php"><i class="fa fa-clipboard"></i> Property Transfer Report (PTR)</a></li>
                </ul>
            </li>
            <li class="<?php echo $uri == 'area.php' || $uri == 'rcc.php' || $uri == 'category.php' || $uri == 'item.php' || $uri == 'unit.php' || $uri == 'supplier.php' ? 'active' : ''; ?>">
                <a href=""><i class="fa fa-table"></i> <span class="nav-label"><?php echo $_SESSION["link2"]; ?></span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="<?php echo $uri == 'area.php' ? 'active' : ''; ?>"><a href="<?php echo $base_url; ?>/reference_tables/area.php"><i class="fa fa-area-chart"></i> Area</a></li>
                    <li class="<?php echo $uri == 'rcc.php' ? 'active' : ''; ?>"><a href="<?php echo $base_url; ?>/reference_tables/rcc.php"><i class="fa fa-code-fork"></i> RCC</a></li>
                    <li class="<?php echo $uri == 'category.php' ? 'active' : ''; ?>"><a href="<?php echo $base_url; ?>/reference_tables/category.php"><i class="fa fa-tag"></i> Category</a></li>
                    <li class="<?php echo $uri == 'item.php' ? 'active' : ''; ?>"><a href="<?php echo $base_url; ?>/reference_tables/item.php"><i class="fa fa-object-group"></i> Item</a></li>
                    <li class="<?php echo $uri == 'unit.php' ? 'active' : ''; ?>"><a href="<?php echo $base_url; ?>/reference_tables/unit.php"><i class="fa fa-balance-scale"></i> Unit</a></li>
                    <li class="<?php echo $uri == 'supplier.php' ? 'active' : ''; ?>"><a href="<?php echo $base_url; ?>/reference_tables/supplier.php"><i class="fa fa-users"></i> Supplier</a></li>
                </ul>
            </li>
            <li class="<?php echo $uri == 'stockcard.php' ? 'active' : ''; ?>">
                <a href="<?php echo $base_url; ?>/stockcard.php"><i class="fa fa-bars"></i> <span class="nav-label">Stock Card</span></a>
            </li>
            <li class="<?php echo $uri == 'inspectors.php' ? 'active' : ''; ?>">
                <a href="<?php echo $base_url; ?>/inspectors.php"><i class="fa fa-user-secret"></i> <span class="nav-label">Inspectorate Groups</span></a>
            </li>
            <li class="<?php echo $uri == 'sai.php' ? 'active' : ''; ?>">
                <a href="<?php echo $base_url; ?>/sai.php"><i class="fa fa-search"></i> <span class="nav-label">For SAI</span></a>
            </li>
            <li class="<?php echo $uri == 'archives.php' ? 'active' : ''; ?>">
                <a href="<?php echo $base_url; ?>/archives.php"><i class="fa fa-archive"></i> <span class="nav-label">Archive</span></a>
            </li>
            <li>
                <a href="https://drive.google.com/file/d/1H6DzrxhfjMdY0wh9NiCpfuq5_hdbgc5H/view?usp=sharing" target="_blank"><i class="fa fa-book"></i> <span class="nav-label">User Manual</span></a>
            </li>
            <li>
                <a href="<?php echo $base_url; ?>/php/php_logout.php"><i class="fa fa-power-off"></i> <span class="nav-label">Logout</span></a>
            </li>
        </ul>

    </div>
</nav>