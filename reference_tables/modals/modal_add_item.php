<div class="modal inmodal" id="add_item" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog" style="margin-top: 100px;">
        <div class="modal-content animated fadeInDown">
            <div class="modal-header">
                <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
                <h2><b><i class="fa fa-plus"></i> Add Item</b></h2>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Item name:</label>
                    <div class="col-lg-8">
                        <input type="text" id="item" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Category:</label>
                    <div class="col-lg-8">
                        <select class="select2_demo_1 form-control" id="category">
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_item" onclick="add_item();">Save</button>
            </div>
        </div>
    </div>
</div>