<div class="modal inmodal" id="gen_ics_par" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-focus="false">
    <div class="modal-dialog modal-lg">
    <div class="modal-content animated slideInDown">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title"><i class="fa fa-print"></i> ICS-PAR</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Category:</label>
                            <div class="col-lg-10">
                                <select id="ics-par-cat" class="form-control select2_demo_1" multiple="multiple">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Quarter:</label>
                            <div class="col-lg-8">
                                <select id="ics-par-qua" class="form-control select2_demo_1" multiple="multiple">
                                    <option value="01-03">1st Quarter</option>
                                    <option value="04-06">2nd Quarter</option>
                                    <option value="07-09">3rd Quarter</option>
                                    <option value="10-12">4th Quarter</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Year:</label>
                            <div class="col-lg-8">
                                <select id="ics-par-yea" class="form-control select2_demo_1">
                                    <?php
                                        for($i = 2022; $i >= 2010; $i--){
                                            echo "<option>".$i."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class=""></div>
                <hr>
                <div class="ibox">
                    <div class="ibox-content" style="height: 380px; overflow: auto; color: black;">
                        <center>
                            <div id="ics-par-rep">
                                <table id='ics-par-tbl' width='100%' border='1' cellspacing='0' cellpadding='0' style='border-collapse:collapse; text-align: center;'>
                                    <thead>
                                        <tr style="background-color: #F0F0F0; font-size: 12px;">
                                            <th style="padding: 5px;">ITEM DESCRIPTION</th>
                                            <th style="padding: 5px;">PROPERTY NO.</th>
                                            <th style="padding: 5px;">SERIAL NO.</th>
                                            <th style="padding: 5px;">QUANTITY</th>
                                            <th style="padding: 5px;">UNIT COST</th>
                                            <th style="padding: 5px;">END-USER</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="font-size: 12px;">
                                            <td colspan="8" style="text-align: center;">No records found.</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="get_ics_par();">Generate</button>
                <button type="button" class="btn btn-primary" onclick="print_ics_par();">Print</button>
                <button type="button" class="btn btn-primary" onclick="excel_ics_par();">Excel</button>
            </div>
        </div>
    </div>
</div>