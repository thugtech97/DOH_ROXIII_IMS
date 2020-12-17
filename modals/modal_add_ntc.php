<div class="modal inmodal" id="add_ntc" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-plus"></i> New NTC Form</h5>
            </div>
            <div class="modal-body">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> NTC Information
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Control Number:</label>
                                    <div class="col-lg-9">
                                        <input id="ntc_cn" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Activity Title:</label>
                                    <div class="col-lg-9">
                                        <input id="ntc_at" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Activity Date:</label>
                                    <div class="col-lg-9">
                                        <input id="ntc_ad" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Date Filed:</label>
                                    <div class="col-lg-9">
                                        <input id="ntc_df" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Activity Duration:</label>
                                    <div class="col-lg-9">
                                        <input id="ntc_adu" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Activity Venue:</label>
                                    <div class="col-lg-9">
                                        <input id="ntc_av" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label class="col-lg-6 col-form-label"><b>Number of Pax/Person(s):</b></label>
                                    <div class="col-lg-6">
                                        <input id="nopp" class="form-control" type="number"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">

                            </div>
                        </div>
                        <table id="tbl_pax_ibox" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Day 1</th>
                                    <th>Day 2</th>
                                    <th>Day 3</th>
                                    <th>Day 4</th>
                                    <th>Day 5</th>
                                    <th>Total No. of Pax</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="6"></th>
                                    <th><center>₱ <span id="total_cost_pax">0.00</span></center></th>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Other Services Needed:</label>
                                    <div class="col-lg-5">
                                        <select class="form-control select2_demo_1">
                                            <option disabled="" selected=""></option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <input id="nopp" class="form-control" type="text"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Choose type:</label>
                                    <div class="col-lg-5">
                                        <select id="choose_type" class="form-control select2_demo_1">
                                            <option disabled="" selected=""></option>
                                            <option>Contract</option>
                                            <option>Purchase Order</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Total Cost Required:</label>
                                    <div class="input-group m-b col-lg-8">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">₱</span>
                                        </div>
                                        <input id="ntc_tcr" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="contract_form" style="display: none;">
                            <div style="border-color: grey; border-style: solid; border-width: 1px; border-radius: 10px; padding: 20px;">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Contract Number:</label>
                                            <div class="col-lg-9">
                                                <input id="con_cn" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Category:</label>
                                            <div class="col-lg-9">
                                                <input id="con_cg" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Quarter:</label>
                                            <div class="col-lg-9">
                                                <input id="con_qua" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">OBR Number:</label>
                                            <div class="col-lg-9">
                                                <input id="con_obr" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Caterer:</label>
                                            <div class="col-lg-9">
                                                <input id="con_cr" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Address:</label>
                                            <div class="col-lg-9">
                                                <input id="con_add" type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="po_form" style="display: none;">
                            <div style="border-color: grey; border-style: solid; border-width: 1px; border-radius: 10px; padding: 20px;">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Purchase Order Number:</label>
                                    <div class="col-lg-8">
                                        <input id="po_no" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Total Amount on PO:</label>
                                    <div class="input-group m-b col-lg-8">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">₱</span>
                                        </div>
                                        <input id="po_tap" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Remaining Balance:</label>
                                    <div class="input-group m-b col-lg-8">
                                        <div class="input-group-prepend">
                                            <span class="input-group-addon">₱</span>
                                        </div>
                                        <input id="po_rb" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> 
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Coordinator:</label>
                                    <div class="col-lg-8">
                                        <select id="ntc_coor" class="select2_demo_1 form-control">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Noted By:</label>
                                    <div class="col-lg-8">
                                        <select id="ntc_nb" class="select2_demo_1 form-control">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Conformed By:</label>
                                    <div class="col-lg-8">
                                        <select id="ntc_cb" class="select2_demo_1 form-control">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>