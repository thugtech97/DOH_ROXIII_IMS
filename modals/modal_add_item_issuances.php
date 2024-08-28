<div class="modal inmodal modal-child" id="modal_add_item_issuances" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg" style="width: 1250px;">
    <div class="modal-content animated fadeInDown">
            <div class="modal-header">
                <button type="button" class="close" onclick="$('#modal_add_item_issuances').modal('hide'); $('body').addClass('modal-open');"><span aria-hidden="true">&times;</span></button>
                <h2><b><i class="fa fa-plus"></i> Add new item (<span id="add_item_num"></span>)</b></h2>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">PO Number:</label>
                            <div class="col-lg-9">
                                <select id="a_reference_no" class="form-control select2_demo_1">
                                    <option disabled selected></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Item Name:</label>
                                    <div class="col-lg-8">
                                        <select id="a_item_name" class="form-control select2_demo_1">
                                            <option disabled selected></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Stocks:</label>
                                    <div class="col-lg-9">
                                        <input id="a_stock" type="text" class="form-control" disabled="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Description:</label>
                            <div class="col-lg-9">
                                <textarea id="a_description" style="width:100%;height:78px;" disabled=""></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Category:</label>
                            <div class="col-lg-9">
                                <input type="text" id="a_category" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Property No.:</label>
                            <div class="col-lg-9">
                                <input id="a_property_no" type="text" class="form-control">
                                <label class="col-form-label">*** Property Number should start with <span id="a_lbl_pn" style="color: red; font-weight: bold;"></span> ***</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Serial No.:</label>
                            <div class="col-lg-9">
                                <select id="a_serial_no" class="form-control select2_demo_1">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Quantity:</label>
                                    <input id="a_quantity" onkeyup="a_total_amount();" type="number" class="col-lg-7 form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Unit:</label>
                                    <div class="col-lg-9">
                                        <input id="a_unit" type="text" class="form-control" disabled=""> 
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
                                <input id="a_unit_value" type="text" class="form-control" onfocus="(this.type='number');" onblur="(this.type='text');" disabled="">
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-lg-3 col-form-label">Total Amount:</label>
                            <div class="input-group m-b col-lg-9">
                                <div class="input-group-prepend">
                                    <span class="input-group-addon">₱</span>
                                </div>
                                <input id="a_total_amount" type="text" class="form-control" disabled="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Remarks:</label>
                            <div class="col-lg-9">
                                <input id="a_remarks" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" onclick="$('#modal_add_item_issuances').modal('hide'); $('body').addClass('modal-open');">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_new_item();">Add</button>
            </div>
        </div>
    </div>
</div>