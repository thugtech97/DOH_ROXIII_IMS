<div class="modal inmodal" id="add_category" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog" style="margin-top: 100px;">
        <div class="modal-content animated fadeInDown">
            <div class="modal-header">
                <button type="button" class="close"><span aria-hidden="true">&times;</span></button>
                <h2><b><i class="fa fa-plus"></i> Add Category</b></h2>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Category name:</label>
                    <div class="col-lg-8">
                        <input type="text" id="category_name" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Category code:</label>
                    <div class="col-lg-8">
                        <input type="text" id="category_code" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_category" onclick="add_category();">Save</button>
            </div>
        </div>
    </div>
</div>