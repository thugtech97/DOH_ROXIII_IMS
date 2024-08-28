<div class="modal inmodal" id="print_notc_" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-users"></i> <span id="modal_dl_title"></span></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">PO Number:</label>
                            <div class="col-lg-9">
                                <select id="notc_po_number" class="form-control select2_demo_1">
                                    <option disabled></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-content modal_notc_content">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="print_prev_dl();"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="view_supp" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-print"></i> Generate Demand Letter</h5>
            </div>
            <div class="modal-body">
                <div class="ibox" style="border-style: solid; border-color: black; border-width: 1px;">
                    <div class="ibox-title">
                        <h5>Suppliers&nbsp;&nbsp;<span id="num_supp" class="label label-success" style="border-radius: 10px;">0</span></h5>
                    </div>
                    <div class="ibox-content" style="height: 400px;overflow:auto;">
                        <div class="dd" id="nestable">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>