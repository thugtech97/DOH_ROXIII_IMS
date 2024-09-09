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

    <title>INVENTORY MS | Dashboard</title>

</head>
<body>
    <div id="wrapper">
        <?php include("assets/navbar.php"); ?>

        <div id="page-wrapper" class="gray-bg dashbard-1" style="color: black;">
        <div class="row border-bottom">
            <?php require "assets/topmenu.php"; ?> 
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                   <div class="row">
                        <div class="col-lg-3 animated bounceIn">
                            <div class="ibox" onclick="load_list('PO');">
                                <div class="ibox-title">
                                    <span class="label label-info float-right">PO</span>
                                    <h5><i class="fa fa-list-alt"></i> Purchase Orders</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins" id="po_num"><i class="fa fa-spinner fa-spin"></i></h1>
                                    <small>Total Purchase Orders</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 animated bounceIn">
                            <div class="ibox" onclick="document.location = 'reference_tables/item.php';">
                                <div class="ibox-title">
                                    <span class="label label-primary float-right">IT</span>
                                    <h5><i class="fa fa-object-group"></i> Items</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins" id="it_num"><i class="fa fa-spinner fa-spin"></i></h1>
                                    <small>Total Number of Items Registered</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 animated bounceIn">
                            <div class="ibox" onclick="load_list('IS');">
                                <div class="ibox-title">
                                    <span class="label label-danger float-right">IS</span>
                                    <h5><i class="fa fa-shopping-cart"></i> Issuances</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins" id="is_num"><i class="fa fa-spinner fa-spin"></i></h1>
                                    <small>Total Number of Issuances</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 animated bounceIn">
                            <div class="ibox" onclick="load_list('UL');">
                                <div class="ibox-title">
                                    <span class="label label-warning float-right">UL</span>
                                    <h5><i class="fa fa-history"></i> User Logs</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins" id="ul_num"><i class="fa fa-spinner fa-spin"></i></h1>
                                    <small>Total Number of User Logs</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" id="PO" style="display: none;">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4><i class="fa fa-list-alt"></i> Purchase Orders</h4>
                                </div>
                                <div class="panel-body">
                                    <table id="tbl_PO" class="table table-bordered table-hover dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>PO Number</th>
                                                <th>Mode of Procurement</th>
                                                <th>End User</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" id="IS" style="display: none;">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4><i class="fa fa-shopping-cart"></i> Issuances</h4>
                                </div>
                                <div class="panel-body">
                                    <center>
                                        <div id="pie" style="height: 450px; width: 100%;">
                                                    
                                        </div>
                                    </center>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" id="UL" style="display: none;">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h4><i class="fa fa-history"></i> User Logs</h4>
                                </div>
                                <div class="panel-body">
                                    <table id="tbl_UL" class="table table-bordered table-hover dataTables-example">
                                        <thead>
                                            <tr>
                                                <th class="first_col">Log ID</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                                <th>Time</th>
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
            </div>
        </div>
        <div class="footer">
            <div>
                <strong>Copyright</strong> <?php echo $_SESSION["company_title"]; ?> &copy; <?php echo date("Y"); ?>
            </div>
        </div>
        
        <?php
            require "assets/small_chat.php";
        ?>
    </div>

    <?php
        require "assets/scripts_assets.php";
    ?>
    
    <script>
        $(document).ready(function() {
            var is_data = [];
            var is_num = "";
            get_data();
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Inventory Management System', 'Welcome to <?php echo $_SESSION["entity_name"]; ?>');
            }, 1300);
        });

        function get_data(){
            $.ajax({
                url: "php/php_db.php",
                type: "POST",
                data: {call_func: "load_card"},
                dataType: "JSON",
                success: function(data){
                    $("#po_num").html(data["po_rows"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $("#it_num").html(data["it_rows"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $("#is_num").html(data["is_rows"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $("#ul_num").html(data["ul_rows"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    is_data = data["is_data"];
                    is_num = data["is_rows"];
                    load_all();
                }
            });
        }

        function load_all(){
            $.ajax({
                url: "php/php_db.php",
                type: "POST",
                data: {call_func: "load_all"},
                dataType: "JSON",
                success: function(data){
                    $("table#tbl_PO tbody").html(data["po_data"]);
                    $("table#tbl_UL tbody").html(data["ul_data"]);
                    create_datatable();
                }
            });   
        }

        function load_list(name){
            $("#pie").html("");
            for(id of ["PO", "IT", "IS", "UL"]){
                if(id==name){
                    $("#"+id).slideDown("slow", ()=>{
                        if(name=="IS"){
                            draw_chart(is_data);
                        }
                    });
                }else{
                    $("#"+id).hide();
                }
            }
        }

        function create_datatable(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: '_'},
                    {extend: 'pdf', title: '_'},

                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');
                            $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                        }
                    }
                ]
            });
            $(".first_col").click();
        }

        function draw_chart(data) {
            var tot = parseInt(is_num.toString());
            var chart = new CanvasJS.Chart("pie", {
                exportEnabled: true,
                animationEnabled: true,
                title:{
                    text: "Overall Issuances"
                },
                legend:{
                    cursor: "pointer",
                    itemclick: explodePie
                },
                data: [{
                    type: "pie",
                    showInLegend: true,
                    toolTipContent: "{name}: <strong>{y}%</strong>",
                    indexLabel: "{name} - {y}%",
                    dataPoints: [
                        { y: ((data[0] / tot) * 100).toFixed(2), name: "ICS ("+data[0]+")", exploded: true },
                        { y: ((data[1] / tot) * 100).toFixed(2), name: "PAR ("+data[1]+")" },
                        { y: ((data[2] / tot) * 100).toFixed(2), name: "PTR ("+data[2]+")" },
                        { y: ((data[3] / tot) * 100).toFixed(2), name: "RIS ("+data[3]+")" }
                    ]
                }]
            });
            chart.render();
        }

        function explodePie (e) {
            if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
                e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
            } else {
                e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
            }
            e.chart.render();
        }
    </script>
</body>
</html>