<div class="modal inmodal" id="ris_preview" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg" style="width: 90%;">
        <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-print"></i> RIS Preview</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <button type="button" class="btn btn-info dim" onclick="add_ris_rows();"><i class="fa fa-plus"></i> Add rows</button>
                        <button type="button" class="btn btn-danger dim" onclick="print_ris_dm($('#dprint_risno').html());"><i class="fa fa-refresh"></i> Reset</button>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-primary dim pull-right" onclick="print_all('#report_ris_dm','1500','800')"><i class="fa fa-print"></i> Print</button>
                    </div>
                </div>
                <hr>
                    <center>
                        <div style="font-size: 5px;">
                            <?php require "reports/report_ris_dm.php"; ?>
                        </div>
                    </center>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>