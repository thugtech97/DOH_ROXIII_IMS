<div class="modal inmodal" id="search_item" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg" style="width: 1200px;">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-search"></i> Item Search</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Item Name:</label>
                            <div class="col-lg-9">
                                <select id="item_name_search" class="form-control select2_demo_1">
                                    <option disabled selected></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <i class="fa fa-list"></i> Results
                    </div>
                    <div class="panel-body" style="height: 300px; overflow: auto;">
                        <table id="item_search_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Reference No.</th>
                                    <th>Item Name</th>
                                    <th>Description</th>
                                    <th>Unit Cost</th>
                                    <th>Quantity (IN)</th>
                                    <th>Total Amount (IN)</th>
                                    <th>Remaining</th>
                                    <th>Total Amount (Remaining)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="7"><center>Select item name first.</center></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>