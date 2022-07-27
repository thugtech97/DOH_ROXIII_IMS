<div class="modal inmodal" id="sai_items" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-clipboard"></i> PR Code: <span id="modal_pr_code"></span></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label"><b>SAI No:</b></label>
                            <div class="col-lg-8">
                                <input id="sai_no" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-body" style="height: 300px; overflow: auto;">
                        <table id="for_sai_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>WFP Code</th>
                                    <th>WFP Act</th>
                                    <th>Item Description</th>
                                    <th>Unit Cost</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th><center><i><p style="color: green;">Check only if available</p></i></center></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label"><b>PR Purpose:</b></label>
                            <label id="pr_purpose" class="col-lg-10 col-form-label"></label>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label"><b>Prepared by:</b></label>
                            <label id="prep_by" class="col-lg-10 col-form-label"></label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="create_sai();">Create SAI</button>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal" id="sai_reports" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-clipboard"></i> SAI Reports</h5>
            </div>
            <div class="modal-body">
                <div class="panel panel-primary">
                    <div class="panel-body" style="height: 300px; overflow: auto;">
                        <table id="sai_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SAI No</th>
                                    <th>Items</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>