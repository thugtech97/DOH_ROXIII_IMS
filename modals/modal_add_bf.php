<div class="modal inmodal" id="bal_fwd" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-plus"></i> New Bal-Fwd</h5>
            </div>
            <div class="modal-body">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> Balance Forwarding Information
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">PO Number:</label>
                                    <div class="col-lg-10">
                                        <input id="bf_pon" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Supplier:</label>
                                    <div class="col-lg-10">
                                        <select id="bf_sup" class="select2_demo_1 form-control">
                                            <option value="" disabled selected></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Date Fwd:</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="bdfwd"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Program/EU:</label>
                                    <div class="col-lg-10">
                                        <input class="form-control" type="text" id="bprogrameu"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Item:</label>
                                            <div class="col-lg-10">
                                                <select id="bitem_name" class="select2_demo_1 form-control">
                                                    <option value="" disabled selected></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Quantity:</label>
                                            <div class="col-lg-9">
                                                <input id="bquantity" type="number" class="form-control input-amounts">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Description:</label>
                                            <div class="col-lg-10">
                                                <textarea id="bdescription" style="width:100%;height:90px;"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Category:</label>
                                            <div class="col-lg-9">
                                                <input id="bcategory" type="text" class="form-control" disabled="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <label class="col-lg-3 col-form-label">Unit Cost:</label>
                                            <div class="input-group m-b col-lg-9">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-addon">₱</span>
                                                </div>
                                                <input id="bunit_cost" type="text" class="form-control" onfocus="(this.type='number');" onblur="(this.type='text'); $(this).val(formatNumber($(this).val())); bcalculate_total_amount();">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Exp. Date:</label>
                                            <div class="col-lg-9">
                                                <input class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="bexp_date" disabled="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <label class="col-lg-3 col-form-label">Total:</label>
                                            <div class="input-group m-b col-lg-9">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-addon">₱</span>
                                                </div>
                                                <input id="btotal_amount" type="text" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Unit:</label>
                                            <div class="col-lg-9">
                                                <select id="bunit" class="select2_demo_1 form-control">
                                                    <option value="" disabled selected></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label"><input type="checkbox" class="i-checks bcheck" style="height: 20px; width: 20px;"> SN/LN:</label>
                                    <div class="input-group m-b col-lg-9">
                                        <input id="bsn_ln" type="text" class="form-control" disabled="">
                                        <div class="input-group-append">
                                            <span class="input-group-addon" style="background-color: #1ab394;" onclick="badd_snln();"><i class="fa fa-plus" style="color: white;"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div style="height: 320px; overflow: auto; border-width: 1px; border-style: solid;">
                                    <table id="bserial_numbers" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Serial No./Lot No.</th>
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
                    <div class="panel-footer">
                        <center>
                            <button type="button" class="btn btn-info" onclick="badd_item();">Add Item</button>
                            <button type="button" class="btn btn-danger">Clear</button>
                        </center>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-list"></i> Item Lists
                    </div>
                    <div class="panel-body" style="height: 180px; overflow: auto;">
                        <table id="bitem_various" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Item Name</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>SN / LN</th>
                                    <th>Expiry Date</th>
                                    <th>Unit Cost</th>
                                    <th>Quantity</th>
                                    <th>Total Amount</th>
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
                                    <th>TOTAL</th>
                                    <th>₱ <span id="btot_amt"></span></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="bsave_changes" onclick="save_balfwd();">Save changes</button>
            </div>
        </div>
    </div>
</div>