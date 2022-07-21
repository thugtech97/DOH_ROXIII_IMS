var _url = "";

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
    get_records(1, _url);
}

function get_pr_items(id){
    $("#modal_pr_code").html(id);
    $.ajax({
        type: "POST",
        url: "php/php_sai.php",
        data: {call_func: "get_items", pr_code: id},
        success: function(data){
            $("#sai_items").modal();
            $("table#for_sai_table tbody").html(data);
        }
    });
}