<div class="modal inmodal" id="add_rfi" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg" style="width: 950px;">
        <div class="modal-content animated slideInDown">
            <form id="insert_rfi">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    <h5 class="modal-title"><i class="fa fa-plus"></i> Add RFI</h5>
                </div>
                <div class="modal-body">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-info-circle"></i> RFI Information
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Control Number:</label>
                                        <div class="col-lg-9">
                                            <input id="control_number" type="text" class="form-control" name="control_number" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Chairperson:</label>
                                        <div class="col-lg-9">
                                            <select id="chairperson" type="text" class="form-control select2_demo_1" name="chairperson" required>
                                            
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Reference/PO Number:</label>
                                        <div class="col-lg-9">
                                            <select id="reference_no" type="text" class="form-control select2_demo_1" name="reference_no[]" multiple required>
                                            
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th class="d-none">ID</th>
                                                <th style="width: 30%;">Item Description</th>
                                                <th style="width: 10%;">Quantity Delivered</th>
                                                <th style="width: 25%;">RSD Control No.</th>
                                                <th style="width: 10%;">Approved date of Delivery/Inspection</th>
                                                <th style="width: 20%;">Location of Delivery/Inspection</th>
                                                <th style="width: 5%;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="item_table_body">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save RFI">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function removeRow(button) {
        const row = button.parentElement.parentElement;
        row.remove();
    }
</script>

