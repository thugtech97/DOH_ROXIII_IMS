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
                    <td>${selectedType}#${item[field]}</td>
                    <td>${item.reference_no}</td>
                    <td><b>${item.item}</b> - ${item.description}</td>
                    <td>
                        ${
                            selectedType == "RIS" 
                            ? item.lot_no.split("|").filter(part => part.trim() !== "").map(part => part.trim()).join(",") 
                            : item.serial_no.split("|").filter(part => part.trim() !== "").map(part => part.trim()).join(",")
                        }
                    </td>
                    <td>${item.quantity}</td>
                    <td>${item.unit}</td>
                    <td></td>
                    <td>${ selectedType == "ICS" || selectedType == "PAR" ? item.remarks : selectedType == "RIS" ? item.purpose : item.reason }</td>
                    <td><button type='button' class='btn btn-danger btn-sm' onclick='removeRow(this)'><i class='fa fa-trash'></i> </button></td>
                </tr>`;
                $("#item_table_body").append(row);
            });
            $("#issuance_no").val(null).trigger('change')
        }
    });
}