<div class="modal inmodal" id="edit_po_various" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-pencil-square-o"></i> Purchase Order (General)</h5>
            </div>
            <div class="modal-body">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> Purchase Order Information
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Date Received:</label>
                                    <input id="edate_received" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="col-lg-9 form-control">
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">PO Number:</label>
                                    <input id="epo_number" type="text" class="col-lg-9 form-control">
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">PO Type:</label>
                                    <input id="epo_type" type="text" class="col-lg-9 form-control" disabled>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">PR Number:</label>
                                    <input id="epr_no" type="text" class="col-lg-9 form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Mode of Procurement:</label>
                                    <div class="col-lg-8">
                                        <select id="eprocurement_mode" class="form-control select2_demo_1">
                                            <option value="" disabled selected></option>
                                            <option value="Bidding">Bidding</option>
                                            <option value="Shopping">Shopping</option>
                                            <option value="SVP">SVP</option>
                                            <option value="Central-Office">Central-Office</option>
                                            <option value="PS-DBM">PS-DBM</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Delivery Term:</label>
                                    <div class="col-lg-8">
                                        <select id="edelivery_term" class="form-control select2_demo_1">
                                            <option value="" disabled selected></option>
                                            <option value="15 days">15 days</option>
                                            <option value="30 days">30 days</option>
                                            <option value="45 days">45 days</option>
                                            <option value="60 days">60 days</option>
                                            <option value="90 days">90 days</option>
                                            <option value="120 days">120 days</option>
                                            <option value="Progress Billing">Progress Billing</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Payment Term:</label>
                                    <div class="col-lg-8">
                                        <select id="epayment_term" class="form-control select2_demo_1">
                                            <option value="" disabled selected></option>
                                            <option value="Progress Billing">Progress Billing</option>
                                            <option value="After the Delivery">After the Delivery</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Supplier:</label>
                                    <div class="col-lg-8">
                                        <select id="esupplier" class="form-control select2_demo_1">
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="fa fa-info-circle"></i> Item Information
                            </div>
                            <div class="panel-body">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">End User:</label>
                                    <div class="col-lg-9">
                                        <input type="text" id="epo_enduser" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Date Conformed:</label>
                                    <div class="col-lg-9">
                                        <input id="edate_conformed" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control">
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Date Delivered:</label>
                                    <div class="col-lg-9">
                                        <input id="edate_delivered" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Status:</label>
                                    <div class="col-lg-9">
                                        <select id="estatus" class="form-control select2_demo_1">
                                            <option value="" disabled selected></option>
                                            <option value="Delivered">Delivered</option>
                                            <option value="Not Yet Delivered">Not Yet Delivered</option>
                                            <option value="Waived">Waived</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <label class="col-form-label"><input type="checkbox" id="ins_chk" class="i-checks" style="height: 20px; width: 20px;"> Inspected</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="fa fa-list"></i> Item Lists 
                                <?php if($_SESSION["role"] == "SUPPLY" || $_SESSION["role"] == "SUPPLY_SU"){ ?>
                                    <button class="pull-right btn btn-xs" onclick="add_item_po($('#epo_number').val());"><i class="fa fa-plus"></i> Add item</button>
                                <?php } ?>
                                
                            </div>
                            <div class="panel-body" style="height: 310px; overflow: auto;">
                                <table id="eitem_various" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Item Name</th>
                                            <th>Description</th>
                                            <th>Unit Cost</th>
                                            <th>IN</th>
                                            <th>Quantity</th>
                                            <th>Total Amount</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>
                                            <td colspan="4"></td>
                                            <td><b>TOTAL</b></td>
                                            <td><b>₱ <span id="tot_amt"></span></b></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <?php if($_SESSION["role"] == "SUPPLY" || $_SESSION["role"] == "SUPPLY_SU"){ ?>
                    <button type="button" class="btn btn-primary" onclick="update();">Save changes</button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal modal-child" id="modal_snln" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-sm" style="width: 800px;">
    <div class="modal-content animated fadeInDown">
            <div class="modal-header">
                <button type="button" class="close" onclick="$('#modal_snln').modal('hide'); $('body').addClass('modal-open');"><span aria-hidden="true">&times;</span></button>
                <h2><b><i class="fa fa-pencil-square-o"></i> Add Serial/Lot Numbers (POID#<span id="po_id"></span>)</b></h2>
            </div>
            <div class="modal-body">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div class="form-group">
                            <div class="input-group m-b">
                                <input id="sn_lns" type="text" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-addon" style="background-color: #1ab394;" onclick="add_snlns();"><i class="fa fa-plus" style="color: white;"></i></span>
                                </div>
                            </div>
                        </div>
                        <div style="height: 320px; overflow: auto; border-width: 1px; border-style: solid;">
                            <table id="serials_numbers" class="table table-bordered">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-white" onclick="$('#modal_snln').modal('hide'); $('body').addClass('modal-open');">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_snln();">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal modal-child" id="modal_add_item_po" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg" style="width: 800px;">
    <div class="modal-content animated fadeInDown">
            <div class="modal-header">
                <button type="button" class="close" onclick="$('#modal_add_item_po').modal('hide'); $('body').addClass('modal-open');"><span aria-hidden="true">&times;</span></button>
                <h2><b><i class="fa fa-plus"></i> Add new item (PO#<span id="apo"></span>)</b></h2>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Item:</label>
                                    <div class="col-lg-10">
                                        <select id="e_item_name" class="select2_demo_1 form-control">
                                            <option value="" disabled selected></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Quantity:</label>
                                    <div class="col-lg-9">
                                        <input id="e_quantity" type="number" class="form-control e-input-amount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Description:</label>
                                    <div class="col-lg-10">
                                        <textarea id="e_description" class="tdesc form-control" style="width:100%;height:90px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Category:</label>
                                    <div class="col-lg-9">
                                        <input id="e_category" type="text" class="form-control" disabled="">
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
                                        <input id="e_unit_cost" type="text" class="form-control" onfocus="(this.type='number');" onblur="(this.type='text'); $(this).val(formatNumber($(this).val())); e_calculate_total_amount();">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Exp. Date:</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="e_exp_date" disabled="" />
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
                                        <input id="e_total_amount" type="text" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label">Unit:</label>
                                    <div class="col-lg-9">
                                        <select id="e_unit" class="select2_demo_1 form-control">
                                            <option value="" disabled selected></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" onclick="$('#modal_add_item_po').modal('hide'); $('body').addClass('modal-open');">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_item_po();">Save</button>
            </div>
        </div>
    </div>
</div>