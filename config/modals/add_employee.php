<div class="modal inmodal modal-child" id="modal_add_employee" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false" style="color: black;">
    <div class="modal-dialog modal-xs">
    <div class="modal-content animated fadeInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h2><b><i class="fa fa-plus"></i> Add new employee</b></h2>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Honorifics:</label>
                    <div class="col-lg-9">
                        <input id="add_honor" type="text" class="form-control" placeholder="(e.g. Atty, Engr, Dr, etc.)" onblur="capitalize(this, this.value)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Firstname: <span style="color: red;">*</span></label>
                    <div class="col-lg-9">
                        <input id="add_fname" type="text" class="form-control" onblur="capitalizeFirstLetter(this, this.value)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Middlename:</label>
                    <div class="col-lg-9">
                        <input id="add_mname" type="text" class="form-control" onblur="capitalizeFirstLetter(this, this.value)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Lastname: <span style="color: red;">*</span></label>
                    <div class="col-lg-9">
                        <input id="add_lname" type="text" class="form-control" onblur="capitalizeFirstLetter(this, this.value)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Post-nominal:</label>
                    <div class="col-lg-9">
                        <input id="add_postn" type="text" class="form-control" placeholder="(e.g. RN, RMT, MD, etc.)" onblur="capitalize(this, this.value)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label">Designation: <span style="color: red;">*</span></label>
                    <div class="col-lg-9">
                        <input type="text" id="add_designation" class="form-control" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_employee();">Save</button>
            </div>
        </div>
    </div>
</div>