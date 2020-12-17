<div class="modal inmodal" id="add_ptr" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-plus"></i> Add PTR</h5>
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
                                        <input id="ptr_no" type="text" class="form-control" placeholder="XXXX-XX-XXXX">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">From:</label>
                                    <div class="col-lg-9">
                                        <input id="from" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Entity Name:</label>
                                    <div class="col-lg-9">
                                        <input id="entity_name" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Approved By:</label>
                                    <div class="col-lg-9">
                                        <select id="approved_by" class="form-control select2_demo_1">
                                            <option disabled selected></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Date Released:</label>
                                    <div class="col-lg-9">
                                        <input id="date" type="text" onfocus="(this.type='date');" onblur="(this.type='text')" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Transfer Type:</label>
                                    <div class="col-lg-9">
                                        <select id="transfer_type" class="form-control select2_demo_1">
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
                                        <select id="reference_no" class="form-control select2_demo_1">
                                            <option disabled selected></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">To:</label>
                                    <div class="col-lg-9">
                                        <input id="to" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Fund Cluster:</label>
                                    <div class="col-lg-9">
                                        <input id="fund_cluster" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Received From:</label>
                                    <div class="col-lg-9">
                                        <select id="received_from" class="form-control select2_demo_1">
                                            <option disabled selected></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Area:</label>
                                    <div class="col-lg-9">
                                        <select id="area" class="form-control select2_demo_1">
                                            <option disabled selected></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Transfer Reason:</label>
                                    <div class="col-lg-9">
                                        <input id="reason" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> Item Information
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Item Name:</label>
                                            <div class="col-lg-8">
                                                <select id="item_name" class="form-control select2_demo_1">
                                                    <option disabled selected></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Stock:</label>
                                            <div class="col-lg-9">
                                                <input id="stock" type="number" class="form-control" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Description:</label>
                                    <div class="col-lg-9">
                                        <textarea id="description" style="width:100%;height:90px;" disabled=""></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Category:</label>
                                    <div class="col-lg-9">
                                        <input type="text" id="category" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Property No.:</label>
                                    <div class="col-lg-9">
                                        <input id="property_no" type="text" class="form-control">
                                    </div>
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">SN / LN:</label>
                                    <div class="col-lg-9">
                                        <select id="serial_no" class="form-control select2_demo_1" multiple="multiple">

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Quantity:</label>
                                            <input id="quantity" onkeyup="total_amount();" type="number" class="col-lg-8 form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Unit:</label>
                                            <div class="col-lg-9">
                                                <input id="unit" type="text" class="form-control" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Unit Value:</label>
                                             <div class="col-lg-8">
                                                <div class="input-group m-b">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-addon">₱</span>
                                                    </div>
                                                    <input id="unit_value" type="text" class="form-control" onfocus="(this.type='number');" onblur="(this.type='text');" disabled="" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Condition:</label>
                                            <input id="conditions" type="text" class="col-lg-7 form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-lg-3 col-form-label">Total Amount:</label>
                                    <div class="col-lg-9">
                                        <div class="input-group m-b">
                                            <div class="input-group-prepend">
                                                <span class="input-group-addon">₱</span>
                                            </div>
                                            <input id="total_amount" type="text" class="form-control" onfocus="(this.type='number');" onblur="(this.type='text');" disabled="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Remarks:</label>
                                    <div class="col-lg-9">
                                        <input id="remarks" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <center>
                            <button type="button" class="btn btn-info" onclick="add_item();">Add</button>
                            <button type="button" class="btn btn-danger">Remove</button>
                        </center>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-list"></i> Item Lists
                    </div>
                    <div class="panel-body" style="height: 220px; overflow: auto;">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <table id="ptr_items" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
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
                                            <th></th>
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
                <button type="button" class="btn btn-primary" id="save_changes" onclick="validate();">Save changes</button>
            </div>
        </div>
    </div>
</div>