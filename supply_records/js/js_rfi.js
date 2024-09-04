var _url = "";

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
        data: {call_func: "get_rfi", page: page, search: query},
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
        data: {call_func: "get_latest_rfi", yy_mm: date[0]+"-"+date[1]},
        success: function(data){
            $('#control_number').val('RFI/CHD13-CR-'+date[0]+"-"+date[1]+"-"+data);
        }
    });
});

$("#chairperson").ready(function(){
    $.ajax({
        type: "POST",
        data: {call_func: "get_chairperson"},
        url: _url,
        success: function(data){
            $("#chairperson").html("<option disabled selected></option>").append(data);
        }
    });
});

$("#reference_no").ready(function(){
    $.ajax({
        type: "POST",
        data: {call_func: "get_po_for_rfi"},
        url: _url,
        success: function(data){
            $("#reference_no").html(data);
        }
    });
});

$("#reference_no").change(function(){
    $.ajax({
        type: "POST",
        data: {call_func: "get_items_po", po_numbers: $("#reference_no").val()},
        url: _url,
        success: function(data){
            var decodedJson = data.replace(/&quot;/g, '"');
            var items = JSON.parse(decodedJson);
            $("#item_table_body").empty();
            items.forEach(function(item) {
                var row = `<tr>
                    <td class="d-none"><input type='hidden' name="po_id[]" value='${item.id}'></td>
                    <td>${item.item_description}</td>
                    <td style='text-align: center;'>${item.quantity_delivered}</td>
                    <td><input type='text' class='form-control' name='rsd_control_no[]' /></td>
                    <td><input type='date' class='form-control' name='approved_date[]' value='${item.date_delivered}' /></td>
                    <td>${item.location}</td>
                    <td><button type='button' class='btn btn-danger btn-sm' onclick='removeRow(this)'><i class='fa fa-trash'></i> </button></td>
                </tr>`;
                $("#item_table_body").append(row);
            });
        }
    });
});

$('#insert_rfi').on('submit', function(event) {
    event.preventDefault();

    let formData = $(this).serialize();
    formData += `&${encodeURIComponent('call_func')}=${encodeURIComponent('insert_rfi')}`;

    console.log("Serialized Form Data:", formData);
    
    $.ajax({
        url: _url,
        type: 'POST',
        data: formData,
        success: function(response) {
            swal("Inserted!", "Saved successfully to the database.", "success");
            setTimeout(function () {
                location.reload();
            }, 1500);
            
        },
        error: function(xhr, status, error) {
            swal("Error saving rfi!", error, "error");
        }
    });
});

function print_rfi(id){
    alert("Printing: "+id);
}

function delete_rfi(id){
    alert("Deleting: "+id);
}