<div class="modal inmodal" id="print_rpci" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-print"></i> Generate RPCI</h5>
            </div>
            <div class="modal-body">
                <input type="text" id="inv_rpci" class="form-control" placeholder="Inventory of ........"><br>
                <input type="text" id="ao_rpci" class="form-control" placeholder="As of .......">
                <hr>
                <div class="ibox">
                    <div class="ibox-content" style="height: 100vh; overflow: auto; color: black;">
                        <center>
                            <?php
                                require "reports/report_rpci.php";
                            ?>
                        </center>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="print_rpci();"><i class="fa fa-print"></i> Print</button>
                <button type="button" class="btn btn-primary" onclick="excel_rpci();"><i class="fa fa-file-excel-o"></i> Save as Excel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="print_idr" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-print"></i> Generate IDR</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">From:</label>
                                    <div class="col-lg-9">
                                        <select id="from_idr" class="select2_demo_1 form-control">
                                            <option selected disabled></option>
                                            <script type="text/javascript">
                                                var month_idr = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                                                for(var i = 2020; i <= 2040; i++){
                                                    for(var j = 0; j < month_idr.length; j++){
                                                        document.write("<option value=\""+i+"-"+(j+1).toString().padStart(2, "0")+"\">"+month_idr[j]+" "+i+"</option>");
                                                    }
                                                }
                                            </script>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">To:</label>
                                    <div class="col-lg-10">
                                        <select id="to_idr" class="select2_demo_1 form-control">
                                            <option selected disabled></option>
                                            <script type="text/javascript">
                                                var month_idr = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                                                for(var i = 2020; i <= 2040; i++){
                                                    for(var j = 0; j < month_idr.length; j++){
                                                        document.write("<option value=\""+i+"-"+(j+1).toString().padStart(2, "0")+"\">"+month_idr[j]+" "+i+"</option>");
                                                    }
                                                }
                                            </script>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <button type="button" class="btn btn-success btn-lg" onclick="print_idr();"><i class="fa fa-print"></i> Print</button>
                        <button type="button" class="btn btn-primary btn-lg" onclick="excel_idr();"><i class="fa fa-file-excel-o"></i> Save as Excel</button>
                    </div>
                </div>
                <hr>
                <div class="ibox">
                    <div class="ibox-content" style="height: 100vh; overflow: auto; color: black;">
                        <center>
                            <?php
                                require "reports/report_idr.php";
                            ?>
                        </center>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="print_idr();"><i class="fa fa-print"></i> Print</button>
                <button type="button" class="btn btn-primary" onclick="excel_idr();"><i class="fa fa-file-excel-o"></i> Save as Excel</button>
            </div>
        </div>
    </div>
</div>