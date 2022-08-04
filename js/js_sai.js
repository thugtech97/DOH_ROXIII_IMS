var _url = "";
var prep_id = "";
var pr_no = "";

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
        data: {call_func: "get_pr", page: page, search: query},
        url: url,
        success: function(data){
            $('#dynamic_content').html(data);
        }
    });
}

function set_url(url){
    _url = url;
    view_sai_reports();
    get_records(1, _url);
}

function get_pr_items(id){
    $("#modal_pr_code").html(id);
    $.ajax({
        type: "POST",
        url: "php/php_sai.php",
        data: {call_func: "get_items", pr_code: id},
        dataType: "JSON",
        success: function(data){
            $("#sai_items").modal();
            $("table#for_sai_table tbody").html(data["tbody"]);
            $("#pr_purpose").html(data["pr_purpose"]);
            $("#prep_by").html(data["prep_name"]);
            $("#prep_des").html(data["designation"]);
            $("#pr_division").html(data["division"]);
            $("#pr_office").html(data["office"]);
        }
    });
}

function create_sai(){
    if($("#sai_no").val() != ""){
        items = [];
        var table = $("table#for_sai_table tbody");
        table.find('tr').each(function (i) {
            var $tds = $(this).find('td');
            items.push([$tds.eq(0).text(), $tds.eq(1).text(), $tds.eq(2).text(), $tds.eq(3).text(), $tds.eq(4).text(), $tds.eq(5).text(), ($tds.eq(6).find('input').is(":checked") ? 'Available' : 'Not Available')]);
        });
        $.ajax({
            type: "POST",
            data: {
                call_func: "insert_sai",
                sai_no: $("#sai_no").val(),
                pr_code: $("#modal_pr_code").html(),
                division: $("#pr_division").html(),
                office: $("#pr_office").html(),
                purpose: $("#pr_purpose").html(),
                prep_by: $("#prep_by").html(),
                prep_des: $("#prep_des").html(),
                items: items
            },
            url: "php/php_sai.php",
            success: function(data){
                swal("Inserted!", "Saved successfully to the database.", "success");
                $("#sai_no").val("");
                $("#sai_items .close").click();
                view_sai_reports();
            }
        });
    }else{
        swal("Please fill in!", "SAI Number", "warning");
    }
}

function view_sai_reports(){
    $.ajax({
        type: "POST",
        dataType: "JSON",
        url: "php/php_sai.php",
        data: {call_func: "get_sai_reports"},
        success: function(data){
            $("table#sai_table tbody").html(data["tbody"]);
            $("#count_sai").html(data["count"]);
        }
    });
}

function print_sai(sai_no){
    $.ajax({
        type: "POST",
        url: "php/php_sai.php",
        dataType: "JSON",
        data: {call_func: "print_sai", sai_no: sai_no},
        success: function(data){
            $("#sai_details").html(data["tbody"]);
            $("#rep_div").html(data["division"]);
            $("#rep_off").html(data["office"]);
            $("#rep_sai_no").html(sai_no);
            $("#rep_purpose").html(data["purpose"]);
            $("#sai_rep_name").html(data["inquired_by"]);
            $("#sai_rep_des").html(data["inquired_by_designation"]);

            var divContents = $("#report_sai").html(); 
            var a = window.open('', '', 'height=1500, width=800');
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

function delete_sai(sai_no){
    swal({
        title: "Are you sure?",
        text: "This SAI record will be removed from the database.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false
    }, function () {
        $.ajax({
            type: "POST",
            data: {call_func: "delete_sai", sai_no: sai_no},
            url: "php/php_sai.php",
            success: function(data){
                alert(data);
            }
        });
    });
}