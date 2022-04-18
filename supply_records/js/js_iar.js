var items = [];
var state = 1;
var po_type = "";

var partial_specify = null;

$(document).ready(function(){
    get_iar();
});

Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

function get_iar(){
    $.ajax({
        type: "POST",
        url: "php/php_iar.php",
        data: {call_func: "get_iar"},
        success: function(data){
            $("table#tbl_iar tbody").html(data);
            create_datatable();
        }
    });
}

function create_datatable(){
    $('.dataTables-example').DataTable({
        pageLength: 10,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            { extend: 'copy'},
            {extend: 'csv', title: 'IAR'},
            {extend: 'excel', title: 'IAR'},
            {extend: 'pdf', title: 'IAR'},
            {extend: 'print',
            customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');
                    $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                }
            }
        ]
    });
    $(".first_col").click();
    ready_all();
}

function save_changes(){
    switch(get_state()){
        case 1:
            validate_various();
            break;
        case 2:
            validate_ntc();
            break;
    }
}

function ready_all(){
    //$("#niar").attr("disabled", true);
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    $(".select2_demo_1").select2({
        theme: 'bootstrap4',
        width: '100%',
        separator: "|"
    });
    //$("#var_dr").val(new Date().toDateInputValue());
    $("#var_po").ready(function(){
        $.ajax({
            type: "POST",
            data: {call_func: "get_po", action: "get_number", po_type: "gen", add_query: "iar_mode"},
            url: "php/php_iar.php",
            success: function(data){
                $("#var_po").html("<option disabled selected></option>").append(data);
            }
        });
    });

    $("#var_po").change(function(){
        $.ajax({
            type: "POST",
            data: {call_func: "get_po", action: "get_details", po_number: $("#var_po option:selected").text()},
            dataType: "JSON",
            url: "php/php_iar.php",
            success: function(data){
                if(!data["success"]){
                    swal("Inspection done!","Items were already inspected","success");
                }
                $("#var_sn").val(data["supplier"]);
                $("#var_dated").val(data["date_delivered"]);
                $("#var_datec").val(data["date_conformed"]);
                $("table#var_items tbody").html("").append(data["tbody"]);
                $("#var_eu").val(data["end_user"]);
                po_type = data["po_type"];
            }
        });
    });

    $("#var_rod").ready(function(){
        $.ajax({
            type: "POST",
            data: {call_func: "get_rcc"},
            url: "php/php_iar.php",
            success: function(data){
                $("#var_rod").html("<option disabled selected></option>").append(data);
                $("#evar_rod").html("<option disabled selected></option>").append(data);
            }
        });
    });

    $("#var_rod").change(function(){
        $("#var_rcc").val($(this).val());
    });
    $("#evar_rod").change(function(){
        $("#evar_rcc").val($(this).val());
    });

    $("#var_inspector").ready(function(){
        $.ajax({
            type: "POST",
            url: "php/php_ics.php",
            data: {call_func: "get_employee"},
            success: function(data){
                $("#var_inspector").html("").append(data);
                $("#spvs").html("<option disabled selected></option>").append(data);
                //$("#evar_inspector").html("<option disabled selected></option>").append(data);
            }
        });
    });

    $("#var_as").change(function(){
        if($("#var_as").val() == "partial"){
            var person = prompt("Please specify quantity","");
            if(person != null){
                partial_specify = person;
            }
        }else{
            partial_specify = $("#var_as option:selected").text();
        }
    });

    Ladda.bind( '.ladda-button',{ timeout: 2000 });
    Ladda.bind( '.progress-demo .ladda-button',{
        callback: function( instance ){
            var progress = 0;
            var interval = setInterval( function(){
                progress = Math.min( progress + Math.random() * 0.1, 1 );
                instance.setProgress( progress );

                if( progress === 1 ){
                    instance.stop();
                    clearInterval( interval );
                }
            }, 200 );
        }
    });
    var l = $( '.ladda-button-demo' ).ladda();
    l.click(function(){
        l.ladda( 'start' );
        setTimeout(function(){
            l.ladda('stop');
        },12000)
    });
}

function modify(iar_number){
    $("#edit_iar").modal();
    $("#iarn").html(iar_number);
    $("#evar_iar").val(iar_number);
    $.ajax({
        type: "POST",
        url: "php/php_iar.php",
        data: {call_func: "get_iar_details",
                iar_number: iar_number},
        dataType: "JSON",
        success: function(data){
            $("#evar_en").val(data["entity_name"]);
            $("#evar_po").val(data["po_number"]);
            $("#evar_fc").val(data["fund_cluster"]);
            $("#evar_sn").val(data["supplier"]);
            $("#evar_eu").val(data["end_user"]);
            $("#espvs").val(data["spvs"]);
            $("#espvs_designation").val(data["spvs_designation"]);

            $('#evar_rod option').each(function() {
                if($(this).text() == data["req_office"]) {
                    $(this).prop("selected", true).change();
                }
            });
            $("#evar_rcc").val(data["res_cc"]);
            $("#evar_ci").val(data["charge_invoice"]);
            $('#evar_inspector').val(data["inspector"]);
            $("#evar_inspected").val(data["date_inspected"]);
            $("#evar_dr").val(data["date_received"]);
            $("table#evar_items tbody").html(data["table"]);
        }
    });
}

function update(){
    items = [];
    var rows = 0;
    var table = $("table#evar_items tbody");
    table.find('tr').each(function (i) {
        var $tds = $(this).find('td');
        var id = $tds.eq(0).text();
        var item = $tds.eq(2).text();
        var description = $tds.eq(3).text();
        var exp_date = $tds.eq(4).find('input').val();
        var manufactured_by = $tds.eq(5).find('input').val();
        var bool = ($tds.eq(8).find('input').is(":checked") ? 1 : 0);
        items.push([id,item,description,exp_date,manufactured_by,bool]);
        rows++;
    });
    $.ajax({
        type: "POST",
        url: "php/php_iar.php",
        data: {
            call_func: "update",
            entity_name: $("#evar_en").val(),
            iar_number: $("#evar_iar").val(),
            po_number: $("#evar_po").val(),
            fund_cluster: $("#evar_fc").val(),
            req_office: $("#evar_rod option:selected").text(),
            res_cc: $("#evar_rcc").val(),
            charge_invoice: $("#evar_ci").val(),
            inspector: $("#evar_inspector").val(),
            date_inspected: $("#evar_inspected").val(),
            date_received: $("#evar_dr").val(),
            spvs: $("#espvs").val(),
            spvs_designation: $("#espvs_designation").val(),
            items: items
        },
        success: function(data){
            swal("Updated!", "IAR details successfully updated.", "success");
            setTimeout(function () {
                location.reload();
              }, 1500);
        }
    });
}

function delete_control(iar_number){
    swal({
        title: "Are you sure?",
        text: "This IAR record will be removed from the database.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false
    }, function () {
        $.ajax({
            type: "POST",
            data: {call_func: "delete_control",
                    number: iar_number
                },
            url: "php/php_iar.php",
            success: function(data){
                swal("Deleted!", "The IAR No. "+iar_number+" is now deleted.", "success");
                setTimeout(function () {
                    location.reload();
                  }, 1500);
            }
        });
    });
}

function set_state(n){
    state = n;
}

function get_state(){
    return state;
}

function add_item(tbl_name){
    items = [];
    var rows = 0;
    var table = $("table#"+tbl_name+" tbody");
    table.find('tr').each(function (i) {
        var $tds = $(this).find('td');
        var id = $tds.eq(0).text();
        var item = $tds.eq(2).text();
        var description = $tds.eq(3).text();
        var exp_date = $tds.eq(4).find('input').val();
        var manufactured_by = $tds.eq(5).find('input').val();
        var bool = ($tds.eq(8).find('input').is(":checked") ? 1 : 0);
        items.push([id,item,description,exp_date,manufactured_by,bool]);
        rows++;
    });
    return rows;
}

function validate_various(){
    if($("#var_po").val() != null){
        if($("#var_rod").val() != null){
            if($("#var_iar").val() != ""){
                if($("#var_inspector").select2("val").length != 0){
                    var inspectors = "";
                    var lngth = $("#var_inspector").select2("val").length;
                    for(var k = 0; k < lngth; k++){
                        inspectors+=((k == lngth-1) ? $("#var_inspector").select2("data")[k].text : $("#var_inspector").select2("data")[k].text+"|");
                    }
                    if($("#var_pc").val() != ""){
                        if(add_item("var_items")!=0){
                            if($("#spvs option:selected").text() != ""){
                                $("#save_changes").attr("disabled", true);
                                $.ajax({
                                    type: "POST",
                                    url: "php/php_iar.php",
                                    data: { 
                                        entity_name: $("#var_en").val(),
                                        call_func: "insert_various",
                                        fund_cluster: $("#var_fc").val(),
                                        po_number: $("#var_po option:selected").text(),
                                        iar_number: $("#var_iar").val(),
                                        iar_type: po_type,
                                        req_office: $("#var_rod option:selected").text(),
                                        res_cc: $("#var_rcc").val(),
                                        charge_invoice: $("#var_ci").val(),
                                        date_inspected: $("#var_inspected").val(),
                                        date_received: $("#var_dr").val(),
                                        inspector: inspectors,
                                        inspected: ($('#var_chk').is(':checked')) ? 1 : 0,
                                        property_custodian: $("#var_pc").val(),
                                        status: $("#var_as option:selected").text(),
                                        partial_specify: partial_specify,
                                        items: items,
                                        spvs: $("#spvs option:selected").text(),
                                        spvs_id: $("#spvs").val()
                                         },
                                    success: function(data){
                                        if(data == "0"){
                                            swal("Inserted!", "Saved successfully to the database.", "success");
                                            setTimeout(function () {
                                                location.reload();
                                              }, 1500);
                                        }else{
                                            $("#save_changes").attr("disabled", false);
                                            swal("IAR Number already existed!", "Please enter another IAR number!", "warning");
                                        }
                                    }
                                });
                            }else{
                                swal("Please fill in!", "Supervisor (For Disbursement Voucher)", "warning");
                            }
                        }else{
                            swal("Items not found!", "No item to be inspected!", "warning");
                        }
                    }else{
                        swal("Please fill in!", "Property Custodian", "warning");
                    }
                }else{
                    swal("Please fill in!", "Inspector", "warning");
                }
            }else{
                swal("Please fill in!", "IAR Number", "warning");
            }
        }else{
            swal("Please fill in!", "Requisitioning Office/Dept.", "warning");
        }
    }else{
        swal("Please fill in!", "Purchase Order", "warning");
    }
}

function validate_ntc(){

}

function print_iar(iar_number){
    $.ajax({
        type: "POST",
        data: {call_func: "print_iar_gen", iar_number: iar_number},
        url: "php/php_iar.php",
        dataType: "JSON",
        success: function(data){
            $("#gprint_en").html(data["entity_name"]);
            $("#gprint_fc").html(data["fund_cluster"]);
            $("#gprint_po").html(data["po_number"]);
            $("#gprint_sup").html(data["supplier"]);
            $("#gprint_iarno").html(iar_number);
            $("#gprint_dd").html(data["date_delivered"]);
            $("#gprint_rod").html(data["req_office"]);
            $("#gprint_ci").html(data["charge_invoice"]);
            $("#gprint_rcc").html(data["res_cc"]);
            $("#gprint_dc").html(data["date_conformed"]);
            $("#iar_gen_body").html(data["tbody"]);
            $("#gprint_ta").html(data["total_amount"]);
            $("#gprint_di").html(data["date_inspected"]);
            $("#gprint_dr").html(data["date_received"]);
            $("#gprint_eu").html("<u>"+data["end_user"].toUpperCase()+"</u>");
            $("#gprint_pc").html("<u>"+data["property_custodian"].toUpperCase()+"</u>");
            var inspc = data["inspector"].split("|");

            for(var i = 0; i < inspc.length; i++){
                $("#g_insp"+(i+1)).html("<u>"+inspc[i].toUpperCase()+"</u>");
            }

            /*
            if(data["inspected"] == 1){
                $("input#inspected").attr("checked", "checked");
            }
            if(data["status"] == "Complete"){
                $("input#Complete").attr("checked", "checked");
            }else{
                $("input#Partial").attr("checked", "checked");
                $("#gprint_psq").html(data["partial_specify"]);
            }
            */
            var divContents = $("#report_iar_gen").html(); 
            var a = window.open('', '_blank', 'height=1500, width=800'); 
            a.document.write('<html>'); 
            a.document.write('<body><center>');
            a.document.write('<table><tr>');
            a.document.write('<td>'+divContents+'</td>'); 
            a.document.write('</tr></table>');
            a.document.write('</center></body></html>'); 
            a.document.close(); 
            a.print();
        }
    });
}

function download_xls(iar_number){
    $.ajax({
        type: "POST",
        data: {call_func: "print_iar_gen", iar_number: iar_number},
        url: "php/php_iar.php",
        dataType: "JSON",
        success: function(data){
            $("#gprint_en").html(data["entity_name"]);
            $("#gprint_fc").html(data["fund_cluster"]);
            $("#gprint_po").html(data["po_number"]);
            $("#gprint_sup").html(data["supplier"]);
            $("#gprint_iarno").html(iar_number);
            $("#gprint_dd").html(data["date_delivered"]);
            $("#gprint_rod").html(data["req_office"]);
            $("#gprint_ci").html(data["charge_invoice"]);
            $("#gprint_rcc").html(data["res_cc"]);
            $("#gprint_dc").html(data["date_conformed"]);
            $("#iar_gen_body").html(data["tbody"]);
            $("#gprint_ta").html(data["total_amount"]);
            $("#gprint_di").html(data["date_inspected"]);
            $("#gprint_dr").html(data["date_received"]);
            $("#gprint_eu").html("<u>"+data["end_user"].toUpperCase()+"</u>");
            $("#gprint_pc").html("<u>"+data["property_custodian"].toUpperCase()+"</u>");
            var inspc = data["inspector"].split("|");

            for(var i = 0; i < inspc.length; i++){
                $("#g_insp"+(i+1)).html("<u>"+inspc[i].toUpperCase()+"</u>");
            }

            /*
            if(data["inspected"] == 1){
                $("input#inspected").attr("checked", "checked");
            }
            if(data["status"] == "Complete"){
                $("input#Complete").attr("checked", "checked");
            }else{
                $("input#Partial").attr("checked", "checked");
                $("#gprint_psq").html(data["partial_specify"]);
            }
            */
            exportTableToExcel("report_iar_gen", "IAR No. "+iar_number);
        }
    });
}

function print_iar_dm(iar_number){
     $.ajax({
        type: "POST",
        data: {call_func: "print_iar_dm", iar_number: iar_number},
        url: "php/php_iar.php",
        dataType: "JSON",
        success: function(data){
            $("#dprint_en").html(data["entity_name"]);
            $("#dprint_fc").html(data["fund_cluster"]);
            $("#dprint_po").html(data["po_number"]);
            $("#dprint_sup").html(data["supplier"]);
            $("#dprint_iarno").html(iar_number);
            $("#dprint_dd").html(data["date_delivered"]);
            $("#dprint_rod").html(data["req_office"]);
            $("#dprint_in").html(data["invoice_number"]);
            $("#dprint_rcc").html(data["res_cc"]);
            $("#dprint_dc").html(data["date_conformed"]);
            $("#iar-dm").html(data["tbody"]);
            $("#dprint_ta").html(data["total_amount"]);
            $("#dprint_di").html(data["date_inspected"]);
            $("#dprint_dr").html(data["date_received"]);
            $("#dprint_date").html(data["date_received"]);
            $("#dprint_eu").html("<u>"+data["end_user"].toUpperCase()+"</u>");
            $("#dprint_pc").html("<u>"+data["property_custodian"].toUpperCase()+"</u>");
            var inspc = data["inspector"].split("|");

            for(var i = 0; i < inspc.length; i++){
                $("#insp"+(i+1)).html("<u>"+inspc[i].toUpperCase()+"</u>");
            }

            /*
            if(data["inspected"] == 1){
                $("input#dinspected").attr("checked", "checked");
            }
            if(data["status"] == "Complete"){
                $("input#dComplete").attr("checked", "checked");
            }else{
                $("input#dPartial").attr("checked", "checked");
                $("#gprint_psq").html(data["partial_specify"]);
            }
            */

            var divContents = $("#report_iar_dm").html(); 
            var a = window.open('', '_blank', 'height=1500, width=800'); 
            a.document.write('<html>'); 
            a.document.write('<body><center>');
            a.document.write('<table><tr>');
            a.document.write('<td>'+divContents+'</td>'); 
            a.document.write('</tr></table>');
            a.document.write('</center></body></html>'); 
            a.document.close(); 
            a.print();
        }
    });
}

function download_xls_dm(iar_number){
     $.ajax({
        type: "POST",
        data: {call_func: "print_iar_dm", iar_number: iar_number},
        url: "php/php_iar.php",
        dataType: "JSON",
        success: function(data){
            $("#dprint_en").html(data["entity_name"]);
            $("#dprint_fc").html(data["fund_cluster"]);
            $("#dprint_po").html(data["po_number"]);
            $("#dprint_sup").html(data["supplier"]);
            $("#dprint_iarno").html(iar_number);
            $("#dprint_dd").html(data["date_delivered"]);
            $("#dprint_rod").html(data["req_office"]);
            $("#dprint_in").html(data["invoice_number"]);
            $("#dprint_rcc").html(data["res_cc"]);
            $("#dprint_dc").html(data["date_conformed"]);
            $("#iar-dm").html(data["tbody"]);
            $("#dprint_ta").html(data["total_amount"]);
            $("#dprint_di").html(data["date_inspected"]);
            $("#dprint_dr").html(data["date_received"]);
            $("#dprint_date").html(data["date_received"]);
            $("#dprint_eu").html("<u>"+data["end_user"].toUpperCase()+"</u>");
            $("#dprint_pc").html("<u>"+data["property_custodian"].toUpperCase()+"</u>");
            var inspc = data["inspector"].split("|");

            for(var i = 0; i < inspc.length; i++){
                $("#insp"+(i+1)).html("<u>"+inspc[i].toUpperCase()+"</u>");
            }

            /*
            if(data["inspected"] == 1){
                $("input#dinspected").attr("checked", "checked");
            }
            if(data["status"] == "Complete"){
                $("input#dComplete").attr("checked", "checked");
            }else{
                $("input#dPartial").attr("checked", "checked");
                $("#gprint_psq").html(data["partial_specify"]);
            }
            */
            exportTableToExcel("report_iar_dm", "IAR No. "+iar_number);
        }
    });
}

function print_nod(iar_number, po_number){
    $.ajax({
        type: "POST",
        data: {
            call_func: "get_nod_dv",
            po_number: po_number,
            iar_number: iar_number
            },
        dataType: "JSON",
        url: "php/php_iar.php",
        success: function(data){
            $("#modal_nod").modal();
            $("#p_iarno1").html(iar_number);
            $("#p_po").html(po_number);
            $("#p_supplier").html(data["supplier"]);
            $("#p_ci").html(data["charge_invoice"]);
            $("#p_itemdesc").html(data["item_description"]);
            $("#dopc").html(data["date_conformed"]);
        }
    });
}

function print_dv(iar_number, po_number){
     $.ajax({
        type: "POST",
        data: {
            call_func: "get_nod_dv",
            po_number: po_number,
            iar_number: iar_number
            },
        dataType: "JSON",
        url: "php/php_iar.php",
        success: function(data){
            $("#modal_dv").modal();
            $("#pp_iar").html(iar_number);
            $("#pp_supplier").html(data["supplier"].toUpperCase());
            $("#pp_spvs").html(data["spvs"].toUpperCase());
            $("#pp_spvs_designation").html(data["spvs_designation"]);
            $("#pp_total_amount").html(data["total_amount"]);
            $("#pp_res_cc").html(data["res_cc"]);
        }
    });
}

function print_pe(iar_number, po_number){
    $.ajax({
        type: "POST",
        data: {
            call_func: "get_nod_dv",
            po_number: po_number,
            iar_number: iar_number
            },
        dataType: "JSON",
        url: "php/php_iar.php",
        success: function(data){
            $("#modal_pe").modal();
            $("#pe_po").html(po_number);
            $("#pe_supplier").html(data["supplier"].toUpperCase());
            $("#pe_date_r").html(data["date_conformed"]);
            $("#pe_dt").html(data["delivery_term"]);
            $("#pe_date_d").html(data["date_delivered"]);
            $("#pe_pm").html("<b>Bidding / Alternative Method of Procurement</b>");
            $("#pe_item").html(data["item_name"]);
            $("#pe_pt").html("After Delivery / Progress Billing");

            $("#pe_inspector").html("");
            var pe_insp = data["inspector"].toUpperCase().split('|');
            for(var i = 0; i < pe_insp.length; i++){
                $("#pe_inspector").html($("#pe_inspector").html()+"<u><b>"+pe_insp[i]+"</b></u>"+((i == pe_insp.length-1) ? "" : "<br>Inspector<br><br>"));
            }

            $("#pe_eu").html(data["end_user"].toUpperCase());
        }
    });
}

$(".pe_addr").click(function(){ var a = prompt("Enter Address:",$("#pe_address").html()); $("#pe_address").html((a != null) ? a : "");});
$(".pe_contact").click(function(){ var c = prompt("Enter Contact Number:",$("#pe_cn").html()); $("#pe_cn").html((c != null) ? c : ""); });