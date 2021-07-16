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
                    <div class="ibox-content" style="height: 450px; overflow: auto; color: black;">
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
                <hr>
                <div class="ibox">
                    <div class="ibox-content" style="height: 450px; overflow: auto; color: black;">
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
                <button type="button" class="btn btn-success" onclick=""><i class="fa fa-print"></i> Print</button>
                <button type="button" class="btn btn-primary" onclick=""><i class="fa fa-file-excel-o"></i> Save as Excel</button>
            </div>
        </div>
    </div>
</div>