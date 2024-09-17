<div class="modal inmodal" id="modal_nod" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-truck"></i> Notice of Delivery</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Delivery Date:</label>
                            <div class="col-lg-8">
                                <input id="nod_dd" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text'); $('#dd_nod').html($(this).val()); $('#nod_d').html($(this).val());"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <button type="button" class="btn btn-success btn-lg" onclick="generate_rep('report_nod', 'NOD');"><i class="fa fa-print"></i> Print</button>
                    </div>
                </div>
                <hr>
                <div class="ibox">
                    <div class="ibox-content" style="height: 100vh; overflow: auto; color: black;">
                        <center>
                            <?php
                                require "reports/report_nod.php";
                            ?>
                        </center>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="modal_dv" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-credit-card"></i> Disbursement Voucher</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Purpose:</label>
                            <div class="col-lg-10">
                                <input id="text" class="form-control" onkeyup="$('#dv_purpose').html($(this).val()); localStorage.setItem('dvpurpose', this.value);">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <button type="button" class="btn btn-success btn-lg" onclick="generate_rep('report_dv', 'DV');"><i class="fa fa-print"></i> Print</button>
                    </div>
                </div>
                <hr>
                <div class="ibox">
                    <div class="ibox-content" style="height: 100vh; overflow: auto; color: black;">
                        <center>
                            <?php
                                require "reports/report_dv.php";
                            ?>
                        </center>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="modal_pe" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-tasks"></i> Performance Evaluation of Supplier</h5>
            </div>
            <div class="modal-body">
                <div class="pull-right">
                    <button type="button" class="btn btn-success btn-lg" onclick="generate_rep('report_pe', 'PES');"><i class="fa fa-print"></i> Print</button>
                </div>
                <div class="ibox">
                    <br>
                    <div class="ibox-content" style="height: 100vh; overflow: auto; color: black;">
                        <center>
                            <?php
                                require "reports/report_pes.php";
                            ?>
                        </center>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

function generate_rep(rep_name, type) {
    var divContents = $('#' + rep_name).html(); 
    var a = window.open("", "_blank", "");
    
    a.document.write(`
        <html>
            <head>
                <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&family=Lora:wght@400;700&display=swap" rel="stylesheet">
                <style>
                    @media print {
                        thead {display: table-header-group;} 
                        tfoot {display: table-footer-group;}
                        button {display: none;}
                        body {
                            margin: 0;
                            font-family: 'Lora', serif;
                        }
                    }
                </style>
            </head>
            <body>
                <center>
                    <table>
                        <tr>
                            <td>` + divContents + `</td>
                        </tr>
                    </table>
                </center>
            </body>
        </html>
    `);
    a.document.close();
    a.onload = function() {
        a.print();
    };
}

</script>