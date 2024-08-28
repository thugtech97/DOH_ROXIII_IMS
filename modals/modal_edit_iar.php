<div class="modal inmodal" id="edit_iar" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-pencil-square-o"></i> Edit IAR No. <span id="iarn"></span></h5>
            </div>
            <div class="modal-body">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> IAR Information
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Entity Name:</label>
                                    <div class="col-lg-8">
                                        <input id="evar_en" type="text" class="form-control" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Purchase Order:</label>
                                    <div class="col-lg-8">
                                        <input id="evar_po" type="text" class="form-control" disabled="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Supplier's Name:</label>
                                    <div class="col-lg-8">
                                        <input id="evar_sn" type="text" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">End User:</label>
                                    <div class="col-lg-8">
                                        <input id="evar_eu" type="text" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Requisitioning Office/Dept:</label>
                                    <div class="col-lg-8">
                                        <select id="evar_rod" class="select2_demo_1 form-control">
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Responsibility Center Code:</label>
                                    <div class="col-lg-8">
                                        <input id="evar_rcc" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Supervisor (For DV):</label>
                                    <div class="col-lg-8">
                                        <input id="espvs" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Fund Cluster:</label>
                                    <div class="col-lg-8">
                                        <input id="evar_fc" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">IAR Number:</label>
                                    <div class="col-lg-8">
                                        <input id="evar_iar" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Charge Invoice:</label>
                                    <div class="col-lg-8">
                                        <input id="evar_ci" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Inspector:</label>
                                    <div class="col-lg-8">
                                        <input id="evar_inspector" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Date Inspected:</label>
                                    <div class="col-lg-8">
                                        <input id="evar_inspected" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Date Received:</label>
                                    <div class="col-lg-8">
                                        <input id="evar_dr" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Designation:</label>
                                    <div class="col-lg-8">
                                        <input id="espvs_designation" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-info-circle"></i> Item Details
                    </div>
                    <div class="panel-body" style="height: 220px; overflow: auto;">
                        <table id="evar_items" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date Delivered/Travel</th>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Expiry Date</th>
                                    <th>Manufacturer</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
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