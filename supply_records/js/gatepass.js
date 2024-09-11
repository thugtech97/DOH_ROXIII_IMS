var _url = "";
var selectedType = "";
var table = "";
var field = "";
var id = "";


Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

$(".select2_demo_1").select2({
    theme: 'bootstrap4',
    width: '100%',
});

$(document).on('click', '.page-link', function(){
    var page = $(this).data('page_number');
    var query = $('#search_box').val();
    get_records(page, _url, query);
});

$('#search_box').keyup(function(){
    var query = $('#search_box').val();
    get_records(1, _url, query);
});

function get_records(page, url, query = ""){
    var arr = ["<div class=\"sk-spinner sk-spinner-wave\"><div class=\"sk-rect1\"></div>&nbsp;<div class=\"sk-rect2\"></div>&nbsp;<div class=\"sk-rect3\"></div>&nbsp;<div class=\"sk-rect4\"></div>&nbsp;<div class=\"sk-rect5\"></div></div>", "<div class=\"sk-spinner sk-spinner-rotating-plane\"></div>", "<div class=\"sk-spinner sk-spinner-double-bounce\"><div class=\"sk-double-bounce1\"></div><div class=\"sk-double-bounce2\"></div></div>", "<div class=\"sk-spinner sk-spinner-wandering-cubes\"><div class=\"sk-cube1\"></div><div class=\"sk-cube2\"></div></div>", "<div class=\"sk-spinner sk-spinner-pulse\"></div>", "<div class=\"sk-spinner sk-spinner-chasing-dots\"><div class=\"sk-dot1\"></div><div class=\"sk-dot2\"></div></div>", "<div class=\"sk-spinner sk-spinner-three-bounce\"><div class=\"sk-bounce1\"></div><div class=\"sk-bounce2\"></div><div class=\"sk-bounce3\"></div></div>", "<div class=\"sk-spinner sk-spinner-circle\"><div class=\"sk-circle1 sk-circle\"></div><div class=\"sk-circle2 sk-circle\"></div><div class=\"sk-circle3 sk-circle\"></div><div class=\"sk-circle4 sk-circle\"></div><div class=\"sk-circle5 sk-circle\"></div><div class=\"sk-circle6 sk-circle\"></div><div class=\"sk-circle7 sk-circle\"></div><div class=\"sk-circle8 sk-circle\"></div><div class=\"sk-circle9 sk-circle\"></div><div class=\"sk-circle10 sk-circle\"></div><div class=\"sk-circle11 sk-circle\"></div><div class=\"sk-circle12 sk-circle\"></div></div>", "<div class=\"sk-spinner sk-spinner-cube-grid\"><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div></div>", "<div class=\"sk-spinner sk-spinner-fading-circle\"><div class=\"sk-circle1 sk-circle\"></div><div class=\"sk-circle2 sk-circle\"></div><div class=\"sk-circle3 sk-circle\"></div><div class=\"sk-circle4 sk-circle\"></div><div class=\"sk-circle5 sk-circle\"></div><div class=\"sk-circle6 sk-circle\"></div><div class=\"sk-circle7 sk-circle\"></div><div class=\"sk-circle8 sk-circle\"></div><div class=\"sk-circle9 sk-circle\"></div><div class=\"sk-circle10 sk-circle\"></div><div class=\"sk-circle11 sk-circle\"></div><div class=\"sk-circle12 sk-circle\"></div></div>"];
    $('#dynamic_content').html(arr[Math.floor(Math.random() * arr.length)]+"<br>");
    $.ajax({
        type: "POST",
        cache: true,
        data: {call_func: "get_gatepass", page: page, search: query},
        url: url,
        success: function(data){
            $('#dynamic_content').html(data);
        }
    });
}

function set_url(url){
    _url = url;
    get_records(1, _url);
}

$("#control_number").ready(function(){
    var date = (new Date().toDateInputValue()).split("-");
    $.ajax({
        type: "POST",
        url: _url,
        data: {call_func: "get_latest_gatepass", yy_mm: date[0]+"-"+date[1]},
        success: function(data){
            $('#control_number').val('DOH-DOONGAN-'+date[0]+"-"+date[1]+"-"+data);
        }
    });
});

$('#authorized_personnel').typeahead({ source: ["NAME 1", "NAME 2", "NAME 3"] });
$('#driver').typeahead({ source: ["NAME 1", "NAME 2", "NAME 3"] });
$('#plate_number').typeahead({ source: ["NAME 1", "NAME 2", "NAME 3"] });
$('#vehicle_type').typeahead({ source: ["NAME 1", "NAME 2", "NAME 3"] });

$('input[name="issuance_type"]').change(function() {
    selectedType = $(this).val();
    table = $(this).data("table");
    field = $(this).data("field");
    id = $(this).data("id");
    $("#issuance_type").html(selectedType+ " Number");
    $("#issuance_no").val(null).trigger('change')

    $.ajax({
        type: "POST",
        url: _url,
        data: {call_func: "get_issuance_no", table: table, field: field, id: id},
        success: function(data){
            $("#issuance_no").html(data);
        }
    })
});

$("#checked_by").ready(function(){
    $.ajax({
        type: "POST",
        url: _url,
        data: {call_func: "get_employee"},
        success: function(data){
            $("#checked_by").html("<option disabled selected></option>").append(data);
            $("#approved_by").html("<option disabled selected></option>").append(data);
            $('#approved_by option').each(function() {
                if($(this).text() == $("#control_number").data("ppb")){
                    $(this).prop("selected", true).change();
                }
            });
        }
    });
});

function insert_issuance(){
    let issuances = $("#issuance_no").val();
    $.ajax({
        type: 'POST',
        url: _url,
        data: {call_func: "get_items_issuances", table: table, field: field, issuances: issuances},
        success: function(data){
            let items = JSON.parse(data)
            if(items.error){
                swal("No selected issuances!", "Kindly select at least 1 issuance number.", "warning");
                return;
            }
            items.forEach(function(item) {
                var row = `<tr>
                    <td class='d-none'><input type='text' name='issuance_id[]' value='${item[id]}'></td>
                    <td><input type='text' class='form-control' name='issuance_no[]' value='${selectedType}#${item[field]}' readonly></td>
                    <td>${item.reference_no}</td>
                    <td><b>${item.item}</b> - ${item.description}</td>
                    <td>
                        ${
                            selectedType == "RIS" 
                            ? item.lot_no.split("|").filter(part => part.trim() !== "").map(part => part.trim()).join(",") 
                            : item.serial_no
                        }
                    </td>
                    <td>${item.quantity}</td>
                    <td>${item.unit}</td>
                    <td><input type='text' class='form-control' name='program[]' value='${selectedType == "RIS" ? item.office : selectedType == "PTR" ? item.to : item.received_by}'></td>
                    <td><input type='text' class='form-control' name='purpose[]' value='${selectedType == "RIS" ? item.purpose : selectedType == "PTR" ? item.reason : item.remarks}'></td>
                    <td><button type='button' class='btn btn-danger btn-sm' onclick='removeRow(this)'><i class='fa fa-trash'></i> </button></td>
                </tr>`;
                $("#item_table_body").append(row);
            });
            $("#issuance_no").val(null).trigger('change')
        }
    });
}

$('#insert_gatepass').on('submit', function(event) {
    event.preventDefault();

    let formData = $(this).serialize();
    formData += `&${encodeURIComponent('call_func')}=${encodeURIComponent('insert_gatepass')}`;

    console.log("Serialized Form Data:", formData);
    
    $.ajax({
        url: _url,
        type: 'POST',
        data: formData,
        success: function(response) {
            swal("Inserted!", "Saved successfully to the database.", "success");
            setTimeout(function () {location.reload();}, 1500);
            
        },
        error: function(xhr, status, error) {
            swal("Error saving rfi!", error, "error");
        }
    });
});

function print_gatepass(gid){
    $.ajax({
        url: _url,
        type: 'POST',
        data: {call_func: "print_gatepass", id: gid},
        success: function(response) {
            let data = JSON.parse(response);
            if(data.error){
                swal("Error!", data.error, "error");
                return;
            }

            console.log(data);
            let gatepass = data.gatepass;
            let gatepass_items = data.items;
            let checked_by = gatepass.checked_by.split("|");
            let approved_by = gatepass.approved_by.split("|");
            $("#print_control").html(gatepass.control_number);
            $("#print_date").html(gatepass.created_at);
            $("#print_authorized").html(gatepass.authorized_personnel);
            $("#print_plate").html(gatepass.plate_number);
            $("#print_driver").html(gatepass.driver);
            $("#print_vehicle").html(gatepass.vehicle_type)
            $("#print_checked").html(checked_by[0].toUpperCase());
            $("#print_approved").html(approved_by[0].toUpperCase());
            $("#print_checked_pos").html(checked_by[1]);
            $("#print_approved_pos").html(approved_by[1]);

            $("#item_gatepass").empty()
            gatepass_items.forEach(function(item, index) {
                var row = `<tr>
                        <td style="height: 20px; text-align: center; font-size: 10px; vertical-align: middle; border: 1px solid black;">${item.issuance_type}#${item.issuance_number}</td>
                        <td style="height: 20px; text-align: center; font-size: 10px; vertical-align: middle; border: 1px solid black;">${item.reference_no}</td>
                        <td style="height: 20px; text-align: center; font-size: 10px; vertical-align: middle; border: 1px solid black;"><b>${item.item}</b>-${item.description}</td>
                        <td style="height: 20px; text-align: center; font-size: 10px; vertical-align: middle; border: 1px solid black;">
                            ${
                                item.issuance_type == "RIS" 
                                ? item.lot_no.split("|").filter(part => part.trim() !== "").map(part => part.trim()).join(",") 
                                : item.serial_no
                            }
                        </td>
                        <td style="height: 20px; text-align: center; font-size: 10px; vertical-align: middle; border: 1px solid black;">${ item.quantity }</td>
                        <td style="height: 20px; text-align: center; font-size: 10px; vertical-align: middle; border: 1px solid black;">${ item.unit }</td>
                        <td style="height: 20px; text-align: center; font-size: 10px; vertical-align: middle; border: 1px solid black;">${ item.issuance_program }</td>
                        <td style="height: 20px; text-align: center; font-size: 10px; vertical-align: middle; border: 1px solid black;">${ item.issuance_purpose }</td>
                    </tr>`
                $("#item_gatepass").append(row);
            });

            var divContents = $("#report_gatepass").html();
            var a = window.open('', '_blank', 'height=1500, width=800'); 
            a.document.write('<html><head><link rel="stylesheet" type="text/css" href="../css/demand_letter.css"></head><body><center>');
            a.document.write('<table style="width: 100%;"><tr><td>');
            a.document.write(divContents);
            a.document.write('</td></tr></table>');
            a.document.write('</center></body></html>'); 
            a.document.close(); 
            setTimeout(function() { a.print(); }, 1000);
        },
        error: function(xhr, status, error) {
            swal("Error printing rfi!", error, "error");
        }
    });
}

function delete_gatepass(gid){
    alert("deleting "+gid)
}