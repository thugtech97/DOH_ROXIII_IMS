<div class="modal inmodal" id="ptr_alloc" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg" style="width: 90%;">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-upload"></i> UPLOAD ALLOCATION LIST (PTR)</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Allocation Number:</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="alloc_number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label">Entity Name:</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="alloc_entity">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input id="inputGroupFile01" type="file" class="custom-file-input" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <a type="button" class="btn btn-info pull-right" href="alloc/DOH_ROXIII_IMS_PTR_ALLOCATION_LIST_FORMAT.xlsx" download>
                            <i class="fa fa-download"></i> Download Template
                        </a>
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Number of recipients: <span class="label label-info" style="border-radius: 15px;" id="count">0</span><span id="loader_upload" class="pull-right" style="display: none; color: green;"><i class="fa fa-refresh fa-spin"></i> Inserting to database...</span></h5>
                    </div>
                    <div class="ibox-content" style="height: 400px; overflow: auto;">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li><a class="nav-link active" data-toggle="tab" href="#tab-3"> <i class="fa fa-upload"></i></a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-4"><i class="fa fa-print"></i></a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-3" class="tab-pane active">
                                    <div class="panel-body">
                                        <table class="table table-bordered" id="upload_alloc">
                                            <thead>
                                                <tr>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Address</th>
                                                    <th>Transfer Reason</th>
                                                    <th>Storage Temp</th>
                                                    <th>Transport Temp</th>
                                                    <th>Inventory ID</th>
                                                    <th>Quantity</th>
                                                    <th>Property No</th>
                                                    <th>Lot/Serial</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="11" style="text-align: center;">No data uploaded.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="tab-4" class="tab-pane">
                                    <div class="panel-body">
                                        <table class="table table-bordered" id="uploaded_alloc">
                                            <thead>
                                                <tr>
                                                    <th>PTR No</th>
                                                    <th>Recipient</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td colspan="3" style="text-align: center;">No PTRs generated.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="insertAlloc();" id="btn_insert" disabled>Insert</button>
            </div>
        </div>
    </div>
</div>