<div class="modal inmodal" id="view_po" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg" style="width: 1200px;">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-picture-o"></i> PO No. <span id="po_num"></span></h5>
            </div>
            <div class="modal-body">
                <?php if($_SESSION["role"] == "SUPPLY" || $_SESSION["role"] == "SUPPLY_SU") { ?><input type="file" name="file_upload" id="file_upload" accept="application/pdf" class="file pull-right" multiple> <?php } ?>
                <embed id="img_po" src="" type="application/pdf" height="1200" width="100%"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>