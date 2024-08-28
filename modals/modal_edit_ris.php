<div class="modal inmodal" id="edit_ris" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-pencil-square-o"></i> Edit RIS</h5>
            </div>
            <div class="modal-body">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> Requisition and Issue Slip
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">RIS Number:</label>
                                    <div class="col-lg-9">
                                        <input type="text" id="eris_no" placeholder="XXXX-XX-XXXX" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Entity Name:</label>
                                    <div class="col-lg-9">
                                        <input id="eentity_name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Division:</label>
                                            <div class="col-lg-9">
                                                <input id="edivision" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Office:</label>
                                            <div class="col-lg-9">
                                                <input id="eoffice" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Date:</label>
                                            <div class="col-lg-9">
                                                <input id="edate" type="text" onfocus="(this.type='date');" onblur="(this.type='text')" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Fund Cluster:</label>
                                            <div class="col-lg-8">
                                                <input id="efund_cluster" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Responsibility Center Code:</label>
                                    <div class="col-lg-8">
                                        <input id="ercc" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Requested:</label>
                                    <div class="col-lg-5">
                                        <input id="erequested_by" type="text" class="form-control">
                                    </div>
                                    <div class="col-lg-5">
                                        <input id="erequested_by_designation" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Issued:</label>
                                    <div class="col-lg-5">
                                        <input id="eissued_by" type="text" class="form-control">
                                    </div>
                                    <div class="col-lg-5">
                                        <input id="eissued_by_designation" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Approved:</label>
                                    <div class="col-lg-5">
                                        <input id="eapproved_by" type="text" class="form-control">
                                    </div>
                                    <div class="col-lg-5">
                                        <input id="eapproved_by_designation" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-1 col-form-label">Purpose:</label>
                            <div class="col-lg-11">
                                <input id="epurpose" type="text" class="form-control">
                            </div>
                        </div>
                </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-list"></i> Item Lists <button class="btn btn-xs btn-info pull-right" onclick="show_add_item($('#eris_no').val());"><i class="fa fa-plus"></i> Add Item</button>
                    </div>
                    <div class="panel-body" style="height: 220px; overflow: auto;">
                        <table id="eris_items" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>PO#</th>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Cost</th>
                                    <th>Total</th>
                                    <th>Stocks</th>
                                    <th>Remarks</th>
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
                <button type="button" class="btn btn-primary" onclick="update();">Save changes</button>
            </div>
        </div>
    </div>
</div>