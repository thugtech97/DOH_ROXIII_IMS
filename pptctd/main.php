<?php

session_start();

if(!isset($_SESSION["uname"])){
    echo "<script>document.location='index.php'; </script>";
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INVENTORY MS | Property Custodian</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">

    <script src="../js/jquery-3.1.1.min.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="../imgsys/img_avatar2.png">

    <link href="../css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="../css/plugins/select2/select2-bootstrap4.min.css" rel="stylesheet">

    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <script type="text/javascript" src="js/shim.min.js"></script>
    <script type="text/javascript" src="js/xlsx.full.min.js"></script>

    <script type="text/javascript" src="js/Blob.js"></script>
    <script type="text/javascript" src="js/FileSaver.js"></script>

    <script>
        function doit(type, fn, dl) {
            var elt = document.getElementById('item_eu');
            var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
            return dl ?
                XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
                XLSX.writeFile(wb, fn || ('SheetJSTableExport.' + (type || 'xlsx')));
        }
    </script>

</head>

<body style="color: #C0C0C0;">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <center>
                                <img alt="image" class="rounded-circle animated bounceIn" src="../imgsys/img_avatar2.png" height="50" width="50">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="block m-t-xs font-bold">Eleanor D. Lakag, MSBA</span>
                                    <span class="text-muted text-xs block">Property Custodian</span>
                                </a>
                            </center>
                        </div>
                        <div class="logo-element">
                            PC+
                        </div>
                    </li>
                    <li class="warehouse_link" data-name="Doongan">
                        <a><i style='font-size:12px' class='fas'>&#xf494;</i> Doongan</a>
                    </li>
                    <li class="warehouse_link" data-name="Villa Kananga">
                        <a><i style='font-size:12px' class='fas'>&#xf494;</i> Villa Kananga</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg" style="color: black;">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2><i class="fa fa-user"></i> Property Custodian Page</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a>Warehouse</a>
                        </li>
                        <li class="breadcrumb-item">
                            <strong><span id="warehouse_name"><i>(Select Warehouse)</i></span></strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">
                    <h4 class="pull-right"><a href="php/logout.php"><i class="fa fa-power-off"></i> Logout</a></h4>
                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRightBig">
            <div class="row">
                <div class="col-lg-12">
                    <button id="btn_show_end_users" disabled class="pull-right btn btn-md btn-default" data-toggle="modal" data-target="#show_end_users"><i class="fa fa-users"></i> End-Users</button>
                </div>
            </div>
            <div class="row m-t-lg">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li><a class="nav-link active" data-toggle="tab" href="#po" onclick="set_state(1); get_records(1, 1);"><i class="fa fa-list-alt"></i>Purchase Orders</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#iar" onclick="set_state(2); get_records(2, 1);"><i class="fa fa-list-alt"></i>IAR</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#ics" onclick="set_state(3); get_records(3, 1);"><i class="fa fa-clipboard"></i>ICS</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#par" onclick="set_state(4); get_records(4, 1);"><i class="fa fa-clipboard"></i>PAR</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#ptr" onclick="set_state(5); get_records(5, 1);"><i class="fa fa-clipboard"></i>PTR</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#ris" onclick="set_state(6); get_records(6, 1);"><i class="fa fa-clipboard"></i>RIS</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#rsmi_ppe"><i class="fa fa-book"></i>RSMI (PPE)</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#rsmi_ris"><i class="fa fa-book"></i>RSMI (RIS)</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#inv"><i style='font-size:12px' class='fas'>&#xf494;</i>Warehouse Inventory</a></li>
                        </ul>
                        <div class="tab-content">
                            <script type="text/javascript">
                                var ids = ["po","iar","ics","par","ptr","ris"];
                                for(var i = 0; i < ids.length; i++){
                                    document.write("<div id=\""+ids[i]+"\" class=\"tab-pane "+(i == 0 ? "active" : "")+"\"><div class=\"panel-body\"><div class=\"pull-right\">Search: <input type=\"text\" name=\"search_box\" class=\"search_box\"/></div><br><div class=\"table-responsive\"><h5 style=\"text-align: center;\">No data.</h5></div></div></div>");
                                }
                            </script>
                            <div id="rsmi_ppe" class="tab-pane">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Month:</label>
                                                        <div class="col-lg-10">
                                                            <select id="ppe_month" class="select2_demo_1 form-control">
                                                                <option value="00" selected disabled></option>
                                                                <option value="01">January</option>
                                                                <option value="02">February</option>
                                                                <option value="03">March</option>
                                                                <option value="04">April</option>
                                                                <option value="05">May</option>
                                                                <option value="06">June</option>
                                                                <option value="07">July</option>
                                                                <option value="08">August</option>
                                                                <option value="09">September</option>
                                                                <option value="10">October</option>
                                                                <option value="11">November</option>
                                                                <option value="12">December</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Year:</label>
                                                        <div class="col-lg-10">
                                                            <select id="ppe_year" class="select2_demo_1 form-control">
                                                                <option value="2000" selected disabled></option>
                                                                <script>
                                                                    for(var i = 2010; i <= 2040; i++){
                                                                        document.write("<option value=\""+i+"\">"+i+"</option>");
                                                                    }
                                                                </script>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <button type="button" class="btn btn-success btn-lg" onclick="print_ppe();"><i class="fa fa-print"></i> Print</button>
                                            <button type="button" class="btn btn-primary btn-lg" onclick="excel_ppe();"><i class="fa fa-file-excel-o"></i> Save As Excel</button>
                                        </div>
                                    </div>
                                    <div class="ibox-content" style="height: 400px; overflow: auto; color: black;">
                                        <input type="text" id="lookup" placeholder="Search...">
                                        <center>
                                            <div id="ppe_head">
                                                <table>
                                                    <tr>
                                                        <td colspan="13" style="text-align: center;font-size: 12px;">Department of Health</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="13" style="text-align: center;font-size: 12px;"><b>REPORT OF SUPPLIES AND MATERIALS ISSUED</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="13" style="text-align: center;font-size: 12px;">As of <span id="lbl_month">MONTH</span>&nbsp;<span id="lbl_year">YEAR</span></td>
                                                    </tr>
                                                </table>
                                                <br>
                                            </div>
                                        </center>
                                        <div id="ppe_report">
                                            <table id='tbl_ppe' width='100%' border='1' cellspacing='0' cellpadding='0' style='border-collapse:collapse; text-align: center;'>
                                                <thead>
                                                    <tr style="background-color: #F0F0F0; font-size: 12px;">
                                                        <th style="padding: 5px;">Date</th>
                                                        <th style="padding: 5px;">Particular</th>
                                                        <th style="padding: 5px;">PAR/PTR/ICS Reference</th>
                                                        <th style="padding: 5px;">QTY</th>
                                                        <th style="padding: 5px;">Unit</th>
                                                        <th style="padding: 5px;">Unit Cost</th>
                                                        <th style="padding: 5px;">Total Cost</th>
                                                        <th style="padding: 5px;">Account Code</th>
                                                        <th style="padding: 5px;">PTR</th>
                                                        <th style="padding: 5px;">PAR</th>
                                                        <th style="padding: 5px;">ICS</th>
                                                        <th style="padding: 5px;">Recipients</td>
                                                        <th style="padding: 5px;">REMARKS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="font-size: 12px;">
                                                        <td colspan="13" style="text-align: center;">No records found.</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="rsmi_ris" class="tab-pane">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Month:</label>
                                                        <div class="col-lg-10">
                                                            <select id="rsmi_month" class="select2_demo_1 form-control">
                                                                <option value="00" selected disabled></option>
                                                                <option value="01">January</option>
                                                                <option value="02">February</option>
                                                                <option value="03">March</option>
                                                                <option value="04">April</option>
                                                                <option value="05">May</option>
                                                                <option value="06">June</option>
                                                                <option value="07">July</option>
                                                                <option value="08">August</option>
                                                                <option value="09">September</option>
                                                                <option value="10">October</option>
                                                                <option value="11">November</option>
                                                                <option value="12">December</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group row">
                                                        <label class="col-lg-2 col-form-label">Year:</label>
                                                        <div class="col-lg-10">
                                                            <select id="rsmi_year" class="select2_demo_1 form-control">
                                                                <option value="2000" selected disabled></option>
                                                                <script>
                                                                    for(var i = 2010; i <= 2040; i++){
                                                                        document.write("<option value=\""+i+"\">"+i+"</option>");
                                                                    }
                                                                </script>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <button type="button" class="btn btn-success btn-lg" onclick="print_rsmi();"><i class="fa fa-print"></i> Print</button>
                                            <button type="button" class="btn btn-primary btn-lg" onclick="excel_rsmi();"><i class="fa fa-file-excel-o"></i> Save as Excel</button>
                                        </div>
                                    </div>
                                    <div class="ibox">
                                        <div class="ibox-content" style="height: 400px; overflow: auto; color: black;">
                                            <input type="text" id="rsmi_lookup" placeholder="Search...">
                                            <center>
                                                <?php
                                                    require "../reports/report_rsmi.php";
                                                ?>
                                            </center>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            require "modals/modal_show_end_users.php";
        ?>
        <div class="footer">
            <div>
                <strong>Copyright</strong> DEPARTMENT OF HEALTH - CHD - CARAGA &copy; <?php echo date("Y"); ?>
            </div>
        </div>

        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="../js/inspinia.js"></script>
    <script src="../js/plugins/pace/pace.min.js"></script>
    <script src="js/pptctd_js.js"></script>
    <script src="../js/plugins/select2/select2.full.min.js"></script>

    <script type="text/javascript">
        function tableau(pid, iid, fmt, ofile) {
            if(typeof Downloadify !== 'undefined') Downloadify.create(pid,{
                    swf: 'downloadify.swf',
                    downloadImage: 'download.png',
                    width: 100,
                    height: 30,
                    filename: ofile, data: function() { return doit(fmt, ofile, true); },
                    transparent: false,
                    append: false,
                    dataType: 'base64',
                    onComplete: function(){ alert('Your File Has Been Saved!'); },
                    onCancel: function(){ alert('You have cancelled the saving of this file.'); },
                    onError: function(){ alert('You must put something in the File Contents or there will be nothing to save!'); }
            }); else document.getElementById(pid).innerHTML = "";
        }
        tableau('biff8btn', 'xportbiff8', 'biff8', 'SheetJSTableExport.xls');
        tableau('odsbtn',   'xportods',   'ods',   'SheetJSTableExport.ods');
        tableau('fodsbtn',  'xportfods',  'fods',  'SheetJSTableExport.fods');
        tableau('xlmlbtn',  'xportxlml',  'xlml',  'SheetJSTableExport.xml');
        tableau('xlsbbtn',  'xportxlsb',  'xlsb',  'SheetJSTableExport.xlsb');
        tableau('xlsxbtn',  'xportxlsx',  'xlsx',  'SheetJSTableExport.xlsx');
    </script>
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36810333-1']);
        _gaq.push(['_setDomainName', 'sheetjs.com']);
        _gaq.push(['_setAllowLinker', true]);
        _gaq.push(['_trackPageview']);\

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>

</body>
</html>