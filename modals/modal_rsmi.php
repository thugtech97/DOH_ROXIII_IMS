<div class="modal inmodal" id="print_rsmi" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-print"></i> Generate RSMI</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Month:</label>
                                    <div class="col-lg-10">
                                        <select id="rsmi_month" class="select2_demo_1 form-control">
                                            <option value="00" selected disabled></option>
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Year:</label>
                                    <div class="col-lg-10">
                                        <select id="rsmi_year" class="select2_demo_1 form-control">
                                            <option value="2000" selected disabled></option>
                                            <script>
                                                for(var i = 2010; i <= 2040; i++){
                                                    document.write("<option value=\""+i+"\">"+i+"</option>");
                                                }
                                            </script>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <button type="button" class="btn btn-primary btn-lg" onclick="print_rsmi();"><i class="fa fa-print"></i> Print</button>
                    </div>
                </div>
                <hr>
                <div class="ibox">
                    <div class="ibox-content" style="height: 400px; overflow: auto;">
                        <input type="text" id="rsmi_lookup" placeholder="Search...">
                        <center>
                            <?php
                                require "reports/report_rsmi.php";
                            ?>
                        </center>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Print</button>
            </div>
        </div>
    </div>
</div>