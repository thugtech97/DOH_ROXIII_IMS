<div class="modal inmodal" id="show_end_users" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg" style="width: 2000px;">
        <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-users"></i> End-users - <span id="wh_name"></span></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox" style="border-style: solid; border-color: black; border-width: 1px;">
                            <div class="ibox-title">
                                <h5><i class="fa fa-user"></i> End-users</h5>
                                <input type="text" id="searchkw" class="pull-right" placeholder="Search...">
                            </div>
                            <div class="ibox-content" style="height: 450px;overflow:auto;">
                                <div class="dd" id="nestable">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 animated bounceIn">
                        <div class="ibox" style="border-style: solid; border-color: black; border-width: 1px;">
                            <div class="ibox-title">
                                <h5><i class="fa fa-object-group"></i> Items&nbsp;<span id="lbl_end_user"></span></h5>
                                <div class="pull-right">
                                    <button class="btn btn-xs btn-info" onclick="print_items('<b>Items '+$('#lbl_end_user').html()+'</b>');"><i class="fa fa-print"></i> Print</button>
                                    <button class="btn btn-xs btn-primary" onclick="doit('xlsx');"><i class="fa fa-file-excel-o"></i> XLSX</button>
                                </div>
                            </div>
                            <div id="div_item_eu" class="ibox-content" style="color: black; height: 450px; overflow: auto;">
                                <table id="item_eu" width='100%' border='1' cellspacing='0' cellpadding='0' style='border-collapse:collapse; text-align: center;'>
                                    <thead>
                                        <tr style="font-size: 9px; background-color: #F0F0F0;">
                                            <th>ICS/PAR</th>
                                            <th>Item Name</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>Property No.</th>
                                            <th>Serial No.</th>
                                            <th>Remarks</th>
                                            <th>Unit Cost</th>
                                            <th>Quantity</th>
                                            <th>Total Amount</th>
                                            <th>Released From</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr style="font-size: 9px;">
                                            <th colspan="9"><span class="pull-right"><b>TOTAL</b></span></th>
                                            <th colspan="2">₱ <span id="all_total_amount"></span></th>

                                        </tr>
                                    </tfoot>
                                </table>
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