<div class="modal inmodal" id="edit_ics_par" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-pencil-square-o"></i> Edit (ICS/PAR)</h5>
            </div>
            <div class="modal-body">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> <span id="panel_heading"></span>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><span id="label_name"></span>:</label>
                                    <div class="col-lg-9">
                                        <input type="text" id="eics_no" placeholder="XXXX-XX-XXXX" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Entity Name:</label>
                                    <div class="col-lg-9">
                                        <input id="eentity_name" type="text" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Received from:</label>
                                    <div class="col-lg-9">
                                        <input id="ereceived_from" type="text" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Designation:</label>
                                    <div class="col-lg-9">
                                        <input id="ereceived_from_designation" type="text" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Date Released:</label>
                                    <div class="col-lg-9">
                                        <input id="edate" type="text" onfocus="(this.type='date');" onblur="(this.type='text')" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">PO Number:</label>
                                    <div class="col-lg-9">
                                        <input id="ereference_no" type="text" value="" class="form-control" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Fund Cluster:</label>
                                    <div class="col-lg-9">
                                        <input id="efund_cluster" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Received By:</label>
                                    <div class="col-lg-9">
                                        <input id="ereceived_by" type="text" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Designation:</label>
                                    <div class="col-lg-9">
                                        <input id="ereceived_by_designation" type="text" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Area:</label>
                                    <div class="col-lg-9">
                                        <select id="eics_area" class="form-control select2_demo_1">
                                            <option disabled selected></option>
                                        </select> 
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
                    <div class="panel-body" style="height: 200px; overflow: auto;">
                        <table id="eics_items" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>SN/LN</th>
                                    <th>Category</th>
                                    <th>Property No</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Cost</th>
                                    <th>Total</th>
                                    <th>Remarks</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><b>Total</b></th>
                                    <th>₱ <span id="tot_amt">0</span></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
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