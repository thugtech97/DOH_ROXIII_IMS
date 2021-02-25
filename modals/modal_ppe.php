<div class="modal inmodal" id="print_ppe" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-print"></i> Generate ISSUANCES PPE AND OTHER SUPPLIES</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Month:</label>
                                    <div class="col-lg-10">
                                        <select id="ppe_month" class="select2_demo_1 form-control">
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
                                        <select id="ppe_year" class="select2_demo_1 form-control">
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
                        <button type="button" class="btn btn-success btn-lg" onclick="print_ppe();"><i class="fa fa-print"></i> Print</button>
                        <button type="button" class="btn btn-primary btn-lg" onclick="excel_ppe();"><i class="fa fa-file-excel-o"></i> Save As Excel</button>
                    </div>
                </div>
                <hr>
                <div class="ibox">
                    <div class="ibox-content" style="height: 400px; overflow: auto; color: black;">
                        <input type="text" id="lookup" placeholder="Search...">
                        <center>
                            <div id="ppe_head">
                                <table>
                                    <tr>
                                        <td colspan="13" style="text-align: center;font-size: 12px;"><?php echo $_SESSION["company_title"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="13" style="text-align: center;font-size: 12px;"><b>ISSUANCES PPE AND OTHER SUPPLIES</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="13" style="text-align: center;font-size: 12px;">As of <span id="lbl_month">MONTH</span>&nbsp;<span id="lbl_year">YEAR</span></td>
                                    </tr>
                                </table>
                                <br>
                            </div>
                        </center>
                        <div id="ppe_report">
                            <table id='tbl_ppe' width='100%' border='1' cellspacing='0' cellpadding='0' style='border-collapse:collapse; text-align: center;'>
                                <thead>
                                    <tr style="background-color: #F0F0F0; font-size: 12px;">
                                        <th style="padding: 5px;">Date</th>
                                        <th style="padding: 5px;">Particular</th>
                                        <th style="padding: 5px;">PAR/PTR/ICS Reference</th>
                                        <th style="padding: 5px;">QTY</th>
                                        <th style="padding: 5px;">Unit</th>
                                        <th style="padding: 5px;">Unit Cost</th>
                                        <th style="padding: 5px;">Total Cost</th>
                                        <th style="padding: 5px;">Account Code</th>
                                        <th style="padding: 5px;">PTR</th>
                                        <th style="padding: 5px;">PAR</th>
                                        <th style="padding: 5px;">ICS</th>
                                        <th style="padding: 5px;">Received by:</td>
                                        <th style="padding: 5px;">REMARKS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="font-size: 12px;">
                                        <td colspan="13" style="text-align: center;">No records found.</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br><br>
                            <div class="container" style="display: flex; float: left;">
                                <div>
                                    <p style="font-size: 12px;">Prepared by:</p><p style="font-size: 12px;"><b><?php echo strtoupper($_SESSION["ppe_prepared_by"]); ?></b><span><br><?php echo $_SESSION["ppe_prepared_by_designation"]; ?></span></p>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <div>
                                    <p style="font-size: 12px;">Noted by:</p><p style="font-size: 12px;"><b><?php echo strtoupper($_SESSION["ppe_noted_by"]); ?></b><span><br><?php echo $_SESSION["ppe_noted_by_designation"]; ?></span></p>
                                </div>
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