<div class="modal inmodal" id="edit_group" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg" style="width: 750px;">
        <div class="modal-content animated slideInDown">
            <form id="save_group">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title"><i class="fa fa-user-secret"></i> Edit Group</h5>
                </div>
                <div class="modal-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-info-circle"></i> Inspectorate Group Information
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Group Name:</label>
                                        <div class="col-lg-9">
                                            <input id="group_id" type="text" class="form-control d-none" name="group_id">
                                            <input id="egroup_name" type="text" class="form-control" name="group_name" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="d-none" style="width: 10%;">ID</th>
                                                <th style="width: 50%;">Inspector Name</th>
                                                <th style="width: 30%;">Designation</th>
                                                <th style="width: 10%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="einspectors_table_body">
                                            <!-- Rows will be added here -->
                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success dim" onclick="eaddInspectorRow()"><i class="fa fa-plus"></i> Add More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save Changes">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function eaddInspectorRow() {
        const tableBody = document.getElementById('einspectors_table_body');
        const currentRowCount = tableBody.getElementsByTagName('tr').length;

        if (currentRowCount < 6) {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td class="d-none"><input type="text" class="form-control" name="id[]"></td>
                <td><input type="text" class="form-control" name="inspector_name[]" placeholder="Enter Inspector Name" required></td>
                <td>
                    <select class="form-control" name="designation[]" required>
                        <option value="">Select Designation</option>
                        <option value="Chairperson">Chairperson</option>
                        <option value="Vice Chairperson">Vice Chairperson</option>
                        <option value="Member">Member</option>
                    </select>
                </td>
                <td><button type="button" class="btn btn-danger btn-xs dim" onclick="eremoveInspectorRow(this)"><i class="fa fa-trash"></i></button></td>
            `;
            tableBody.appendChild(newRow);
        }else{
            swal("Notice!", "You can only add a maximum of 6 inspectors.", "warning");
        }
    }

    function eremoveInspectorRow(button) {
        const row = button.parentElement.parentElement;
        row.remove();
    }
</script>
