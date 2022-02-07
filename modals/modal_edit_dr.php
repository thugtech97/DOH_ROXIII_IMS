<div class="modal inmodal modal-child" id="edit_dr" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-xs">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" class="close" onclick="//$('#fill_pax').modal('hide'); $('body').addClass('modal-open');"><span aria-hidden="true">&times;</span></button>
                <h3><b><i class="fa fa-pencil-square-o"></i> Edit Date Received (<span id="control_no"></span>)</b></h3>
            </div>
            <div class="modal-body">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Date Received:</label>
                            <div class="col-lg-8">
                                <input id="input_date_dr" style="text-align: center;" type="text" onfocus="(this.type='date');" onblur="(this.type='text'); set_dr();" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>