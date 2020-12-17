<div class="modal inmodal" id="edit_ptr" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-pencil-square-o"></i> Edit PTR</h5>
            </div>
            <div class="modal-body">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> Property Transfer Report Information
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">PTR Number:</label>
                                    <div class="col-lg-9">
                                        <input id="eptr_no" type="text" class="form-control" placeholder="XXXX-XX-XXXX">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">From:</label>
                                    <div class="col-lg-9">
                                        <input id="efrom" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Entity Name:</label>
                                    <div class="col-lg-9">
                                        <input id="eentity_name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Approved By:</label>
                                    <div class="col-lg-9">
                                        <input id="eapproved_by" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Designation:</label>
                                    <div class="col-lg-9">
                                        <input id="eabd" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Date Released:</label>
                                    <div class="col-lg-9">
                                        <input id="edate" type="text" onfocus="(this.type='date');" onblur="(this.type='text')" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Transfer Type:</label>
                                    <div class="col-lg-9">
                                        <select id="etransfer_type" class="form-control select2_demo_1">
                                            <option disabled selected></option>
                                            <option>Donation</option>
                                            <option>Relocate</option>
                                            <option>Reassignment</option>
                                            <option>Others</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">PO Number:</label>
                                    <div class="col-lg-9">
                                        <input id="ereference_no" type="text" class="form-control" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">To:</label>
                                    <div class="col-lg-9">
                                        <input id="eto" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Fund Cluster:</label>
                                    <div class="col-lg-9">
                                        <input id="efund_cluster" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Received From:</label>
                                    <div class="col-lg-9">
                                        <input id="ereceived_from" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Designation:</label>
                                    <div class="col-lg-9">
                                        <input id="erfd" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Area:</label>
                                    <div class="col-lg-9">
                                        <select id="earea" class="form-control select2_demo_1">
                                            <option disabled selected></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Transfer Reason:</label>
                                    <div class="col-lg-9">
                                        <input id="ereason" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-list"></i> Item Lists
                    </div>
                    <div class="panel-body" style="height: 220px; overflow: auto;">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <table id="eptr_items" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Description</th>
                                            <th>SN/LN</th>
                                            <th>Expiry Date</th>
                                            <th>Category</th>
                                            <th>Property No</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                            <th>Cost</th>
                                            <th>Total</th>
                                            <th>Condition</th>
                                            <th>Remarks</th>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="update();">Save changes</button>
            </div>
        </div>
    </div>
</div>