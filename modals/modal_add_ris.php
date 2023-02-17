<div class="modal inmodal" id="add_ris" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-plus"></i> Add RIS</h5>
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
                                        <input type="text" data-pc="<?php echo $_SESSION["property_custodian"]; ?>" data-ppb="<?php echo $_SESSION["ppe_prepared_by"]; ?>" id="ris_no" placeholder="XXXX-XX-XXXX" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Entity Name:</label>
                                    <div class="col-lg-9">
                                        <input id="entity_name" type="text" class="form-control" value="<?php echo $_SESSION["entity_name"]; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Division:</label>
                                            <div class="col-lg-9">
                                                <select id="division" class="form-control select2_demo_1">
                                                    <option disabled selected></option>
                                                </select>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Office:</label>
                                            <div class="col-lg-9">
                                                <select id="office" class="form-control select2_demo_1">
                                                    <option disabled selected></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Date:</label>
                                            <div class="col-lg-9">
                                                <input id="date" type="text" onfocus="(this.type='date');" onblur="(this.type='text')" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Fund Cluster:</label>
                                            <div class="col-lg-8">
                                                <input id="fund_cluster" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Responsibility Center Code:</label>
                                    <div class="col-lg-8">
                                        <input id="rcc" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Requested by:</label>
                                    <div class="col-lg-9">
                                        <select id="requested_by" class="form-control select2_demo_1">
                                            <option disabled selected></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Issued by:</label>
                                            <div class="col-lg-8">
                                                <select id="issued_by" class="form-control select2_demo_1">
                                                    <option disabled selected></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Approved by:</label>
                                            <div class="col-lg-8">
                                                <select id="approved_by" class="form-control select2_demo_1">
                                                    <option disabled selected></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Purpose:</label>
                                    <div class="col-lg-9">
                                        <input id="purpose" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary" style="display: none;">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> Item Information
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Item:</label>
                                            <div class="col-lg-9">
                                                <select id="item_name" class="form-control select2_demo_1">
                                                    <option disabled selected></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">PO:</label>
                                            <div class="col-lg-10">
                                                <select id="po_no" class="form-control select2_demo_1">
                                                    <option disabled selected></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Description:</label>
                                    <div class="col-lg-10">
                                        <textarea id="description" style="width:100%;height:77px; resize: none;" disabled=""></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Stocks:</label>
                                            <div class="col-lg-9">
                                                <input id="stock" type="text" class="form-control" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Category:</label>
                                            <div class="col-lg-9">
                                                <input id="category" type="text" class="form-control" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Quantity:</label>
                                            <input id="quantity" onkeyup="total_amount();" type="number" class="col-lg-7 form-control">
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
                                    <label class="col-lg-3 col-form-label">Unit Value:</label>
                                    <div class="input-group m-b col-lg-9">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">₱</span>
                                        </div>
                                        <input id="unit_value" type="text" class="form-control" onfocus="(this.type='number');" onblur="(this.type='text');" disabled="">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-lg-3 col-form-label">Total Amount:</label>
                                    <div class="input-group m-b col-lg-9">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">₱</span>
                                        </div>
                                        <input id="total_amount" type="text" class="form-control" disabled="">
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
                    <div class="panel-body" style="height: 300px; overflow: scroll;">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Reference/PO Number:</label>
                                    <div class="col-lg-8">
                                        <select id="ris_po_multiple" class="form-control select2_demo_1" multiple="multiple"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="ris_items" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th hidden style="border: thin solid black;"></th>
                                    <th style="border: thin solid black;">PO#</th>
                                    <th style="border: thin solid black;">Item</th>
                                    <th style="border: thin solid black;">Description</th>
                                    <th hidden style="border: thin solid black;">Category</th>
                                    <th style="border: thin solid black;">Lot#</th>
                                    <th style="border: thin solid black;">Exp. Date</th>
                                    <th style="border: thin solid black;">Stocks</th>
                                    <th style="border: thin solid black;">Quantity</th>
                                    <th hidden style="border: thin solid black;">Unit</th>
                                    <th style="border: thin solid black;">Cost</th>
                                    <th style="border: thin solid black;">Total</th>
                                    <th style="border: thin solid black;">Remarks</th>
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
                <button type="button" class="btn btn-primary" id="save_changes" onclick="validate();">Save changes</button>
            </div>
        </div>
    </div>
</div>