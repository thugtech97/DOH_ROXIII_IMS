<div class="modal inmodal modal-child" id="fill_pax" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-sm">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" onclick="$('#fill_pax').modal('hide'); $('body').addClass('modal-open');"><span aria-hidden="true">&times;</span></button>
                <h2><b><i class="fa fa-pencil-square-o"></i> PAX Fill In</b></h2>
            </div>
            <div class="modal-body">
                <div class="ibox ">
                    <div class="ibox-content">
                        <table id="pax_table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th><center>Price/pax</center></th>
                                    <th><center>Pax</center></th>
                                    <th><center>No. of Days</center></th>
                                    <th><center>Total Cost</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><center>₱ <span id="total_cost_pax"></span></center></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" onclick="$('#fill_pax').modal('hide'); $('body').addClass('modal-open');">Close</button>
                <button type="button" class="btn btn-primary" onclick="save_pax();">Save</button>
            </div>
        </div>
    </div>
</div>