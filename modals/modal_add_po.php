<div class="modal inmodal" id="add_po" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-plus"></i> Add Purchase Order</h5>
            </div>
            <div class="modal-body">
                <div class="tabs-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li><a class="nav-link active" data-toggle="tab" href="#tab-1" onclick="setActiveState(1);">General</a></li>
                        <?php //<li><a class="nav-link" data-toggle="tab" href="#tab-2" onclick="setActiveState(2);">Catering</a></li> ?>
                    </ul>
                    <div class="tab-content">
                        <!-- Starting with tab-1 !-->
                        <div role="tabpanel" id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <i class="fa fa-info-circle"></i> Purchase Order Information
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Date Received:</label>
                                                    <div class="col-lg-9">
                                                        <input id="vdate_received" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label"><span id="title-type">P.O</span> Number:</label>
                                                    <div class="col-lg-9">
                                                        <input id="vpo_number" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">P.R Number:</label>
                                                    <div class="col-lg-9">
                                                        <input id="vpr_number" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">End User:</label>
                                                    <div class="col-lg-9">
                                                        <select id="po_enduser" class="select2_demo_1 form-control">
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Date Conformed:</label>
                                                    <div class="col-lg-9">
                                                        <input id="date_conformed" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label">Mode of Procurement:<span id="span_pmode"></span></label>
                                                    <div class="col-lg-8">
                                                        <select id="vprocurement_mode" class="select2_demo_1 form-control">
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
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group row">
                                                            <label class="col-lg-5 col-form-label">Delivery Term:</label>
                                                            <div class="col-lg-7">
                                                                <select id="po_deliveryterm" class="select2_demo_1 form-control">
                                                                    <option value="" disabled selected></option>
                                                                    <option value="15 days">15 days</option>
                                                                    <option value="30 days">30 days</option>
                                                                    <option value="45 days">45 days</option>
                                                                    <option value="60 days">60 days</option>
                                                                    <option value="90 days">90 days</option>
                                                                    <option value="Progress Billing">Progress Billing</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group row">
                                                            <label class="col-lg-5 col-form-label">Payment Term:</label>
                                                            <div class="col-lg-7">
                                                                <select id="po_paymentterm" class="select2_demo_1 form-control">
                                                                    <option value="" disabled selected></option>
                                                                    <option value="Progress Billing">Progress Billing</option>
                                                                    <option value="After the Delivery">After the Delivery</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Supplier:</label>
                                                    <div class="col-lg-9">
                                                        <select id="po_supplier" class="select2_demo_1 form-control">
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Date Delivered:</label>
                                                    <div class="col-lg-9">
                                                        <input id="date_delivered" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Status:</label>
                                                    <div class="col-lg-9">
                                                        <select id="status" class="select2_demo_1 form-control">
                                                            <option value="" disabled selected></option>
                                                            <option value="Delivered">Delivered</option>
                                                            <option value="Not Yet Delivered">Not Yet Delivered</option>
                                                            <option value="Waived">Waived</option>
                                                            <option value="Cancelled">Cancelled</option>
                                                            <option value="Others">Others</option>
                                                        </select>
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
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <div class="form-group row">
                                                            <label class="col-lg-2 col-form-label">Item:</label>
                                                            <div class="col-lg-10">
                                                                <select id="item_name" class="select2_demo_1 form-control">
                                                                    <option value="" disabled selected></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label">Quantity:</label>
                                                            <div class="col-lg-9">
                                                                <input id="quantity" type="number" class="form-control input-amount">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <div class="form-group row">
                                                            <label class="col-lg-2 col-form-label">Description:</label>
                                                            <div class="col-lg-10">
                                                                <textarea id="description" class="tdesc" style="width:100%;height:90px;"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label">Category:</label>
                                                            <div class="col-lg-9">
                                                                <input id="category" type="text" class="form-control" disabled="">
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
                                                                <input id="unit_cost" type="text" class="form-control" onfocus="(this.type='number');" onblur="(this.type='text'); $(this).val(formatNumber($(this).val())); calculate_total_amount();">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label">Exp. Date:</label>
                                                            <div class="col-lg-9">
                                                                <input class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="exp_date" disabled="" />
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
                                                                <input id="total_amount" type="text" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label">Unit:</label>
                                                            <div class="col-lg-9">
                                                                <select id="unit" class="select2_demo_1 form-control">
                                                                    <option value="" disabled selected></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label"><input type="checkbox" class="i-checks" style="height: 20px; width: 20px;"> SN/LN:</label>
                                                    <div class="input-group m-b col-lg-9">
                                                        <input id="sn_ln" type="text" class="form-control" disabled="">
                                                        <div class="input-group-append">
                                                            <span class="input-group-addon" style="background-color: #1ab394;" onclick="add_snln();"><i class="fa fa-plus" style="color: white;"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="height: 320px; overflow: auto; border-width: 1px; border-style: solid;">
                                                    <table id="serial_numbers" class="table table-bordered">
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
                                            <button type="button" class="btn btn-info" onclick="add_item();">Add Item</button>
                                            <button type="button" class="btn btn-danger">Clear</button>
                                        </center>
                                    </div>
                                </div>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <i class="fa fa-list"></i> Item Lists
                                    </div>
                                    <div class="panel-body" style="height: 180px; overflow: auto;">
                                        <table id="item_various" class="table table-bordered">
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
                                                    <th>₱ <span id="all_total_amount"></span></th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of tab-1 !-->

                        <!-- Starting with tab-1 !-->
                        <div role="tabpanel" id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <i class="fa fa-info-circle"></i> Purchase Order Information
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Date Received:</label>
                                                    <div class="col-lg-9">
                                                        <input id="cdate_received" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">P.O Number:</label>
                                                    <div class="col-lg-9">
                                                        <input id="cpo_number" type="text" class="form-control" maxlength="12">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="form-group row">
                                                            <label class="col-lg-5 col-form-label">NTC Category:</label>
                                                            <div class="col-lg-7">
                                                                <select id="ntc_category" class="select2_demo_1 form-control">
                                                                    <option value="" disabled selected></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group row">
                                                            <label class="col-lg-3 col-form-label">Year:</label>
                                                            <div class="col-lg-9">
                                                                <select id="ntc_year" class="select2_demo_1 form-control">
                                                                    <option value="" disabled selected></option>
                                                                    <?php
                                                                    for($i = 2015; $i <= 2030; $i++){
                                                                    ?>
                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Mode of Procurement:</label>
                                                    <div class="col-lg-9">
                                                        <select id="cprocurement_mode" class="select2_demo_1 form-control">
                                                            <option value="" disabled selected></option>
                                                            <option value="Bidding">Bidding</option>
                                                            <option value="Shopping">Shopping</option>
                                                            <option value="SVP">SVP</option>
                                                            <option value="PS-DBM">PS-DBM</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-5" id="ntc_contract_panel" style="display: none;">
                                                <div class="row">
                                                    <label class="col-lg-4 col-form-label">Total Contract:</label>
                                                    <div class="input-group m-b col-lg-8">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-addon">₱</span>
                                                        </div>
                                                        <input id="total_contract" type="text" class="form-control" disabled="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label">Contract Effectivity:</label>
                                                    <div class="col-lg-8">
                                                        <input id="effect_contract" type="text" class="form-control" disabled="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label">Contract Number:</label>
                                                    <div class="col-lg-8">
                                                        <input id="contract_no" type="text" class="form-control" disabled="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <i class="fa fa-info-circle"></i> Program/Event Information
                                            </div>
                                            <div class="panel-body">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Date Filed:</label>
                                                    <div class="col-lg-9">
                                                        <input id="date_filed" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Date of Activity:</label>
                                                    <div class="col-lg-9">
                                                        <input id="activity_date" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" />
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">NTC Control Number:</label>
                                                    <div class="col-lg-9">
                                                        <input id="ntc_number" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Title of Activity:</label>
                                                    <div class="col-lg-9">
                                                        <input id="activity_title" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Coordinator:</label>
                                                    <div class="col-lg-9">
                                                        <select id="coordinator" class="select2_demo_1 form-control">
                                                            <option value="" disabled selected></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label">Caterer:</label>
                                                    <div class="col-lg-9">
                                                        <select id="caterer" class="select2_demo_1 form-control">
                                                            <option value="" disabled selected></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <i class="fa fa-info-circle"></i> Amount Information
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <label class="col-lg-4 col-form-label">NTC Amount:</label>
                                                    <div class="input-group m-b col-lg-8">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-addon">₱</span>
                                                        </div>
                                                        <input id="ntc_amount" type="text" class="form-control" disabled="">
                                                        <div class="input-group-append">
                                                            <span class="input-group-addon" style="background-color: #1ab394;" onclick="fill_pax();"><i class="fa fa-plus" style="color: white;"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-lg-4 col-form-label">Balance after NTC:</label>
                                                    <div class="input-group m-b col-lg-8">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-addon">₱</span>
                                                        </div>
                                                        <input id="ntc_balance" type="text" class="form-control" disabled="">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-lg-4 col-form-label">Actual Amount:</label>
                                                    <div class="input-group m-b col-lg-8">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-addon">₱</span>
                                                        </div>
                                                        <input id="actual_amount" type="text" class="form-control" onfocus="(this.type='number'); $(this).val(origNumber($(this).val()));" onblur="(this.type='text'); $('#actual_balance').val(formatNumber(parseFloat(actual_balance) - parseFloat($('#actual_amount').val()))); $('#actual_amount').val(formatNumber($('#actual_amount').val())); $('#rta').val(formatNumber(parseFloat(origNumber($('#ntc_amount').val())) - parseFloat(origNumber($('#actual_amount').val()))));">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-lg-4 col-form-label">Actual Balance:</label>
                                                    <div class="input-group m-b col-lg-8">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-addon">₱</span>
                                                        </div>
                                                        <input id="actual_balance" type="text" class="form-control" disabled="">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-lg-4 col-form-label">Return to Allotment:</label>
                                                    <div class="input-group m-b col-lg-8">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-addon">₱</span>
                                                        </div>
                                                        <input id="rta" type="text" class="form-control" disabled="">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label">DV No./Remarks:</label>
                                                    <div class="col-lg-8">
                                                        <input id="remarks" type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <i class="fa fa-info-circle"></i> Date Information
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label">Date Received by Supply:</label>
                                                    <input id="received_supply" class="col-lg-8 form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" />
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label">Date Processed by Supply:</label>
                                                    <input id="processed_supply" class="col-lg-8 form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Date Forwarded to Finance:</label>
                                                    <input id="forwarded_finance" class="col-lg-7 form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" />
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-5 col-form-label">Date Forwarded to Accountant:</label>
                                                    <input id="forwarded_accountant" class="col-lg-7 form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_changes" onclick="insert_po();">Save changes</button>
            </div>
        </div>
    </div>
</div>