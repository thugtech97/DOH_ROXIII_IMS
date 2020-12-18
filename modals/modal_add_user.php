<div class="modal inmodal modal-child" id="add_user" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-sm">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h2><b><i class="fa fa-user-plus"></i> Add User</b></h2>
            </div>
            <div class="modal-body">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">User:</label>
                            <div class="col-lg-8">
                                <select id="emp_user" class="select2_demo_1 form-control">
                                    <option value="" disabled selected></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Role:</label>
                            <div class="col-lg-8">
                                <select id="emp_role" class="select2_demo_1 form-control">
                                    <option disabled selected></option>
                                    <option>Administrator</option>
                                    <option>Employeee</option>
                                    <option>IT Support</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Username:</label>
                            <div class="col-lg-8">
                                <input id="uname" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Password:</label>
                            <div class="col-lg-8">
                                <input id="pword" type="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Confirm Password:</label>
                            <div class="col-lg-8">
                                <input id="cpword" type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="save();">Save</button>
            </div>
        </div>
    </div>
</div>