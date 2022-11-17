var state = 1;
var warehouse_name = "";
var arr = ["<div class=\"sk-spinner sk-spinner-wave\"><div class=\"sk-rect1\"></div>&nbsp;<div class=\"sk-rect2\"></div>&nbsp;<div class=\"sk-rect3\"></div>&nbsp;<div class=\"sk-rect4\"></div>&nbsp;<div class=\"sk-rect5\"></div></div>", "<div class=\"sk-spinner sk-spinner-rotating-plane\"></div>", "<div class=\"sk-spinner sk-spinner-double-bounce\"><div class=\"sk-double-bounce1\"></div><div class=\"sk-double-bounce2\"></div></div>", "<div class=\"sk-spinner sk-spinner-wandering-cubes\"><div class=\"sk-cube1\"></div><div class=\"sk-cube2\"></div></div>", "<div class=\"sk-spinner sk-spinner-pulse\"></div>", "<div class=\"sk-spinner sk-spinner-chasing-dots\"><div class=\"sk-dot1\"></div><div class=\"sk-dot2\"></div></div>", "<div class=\"sk-spinner sk-spinner-three-bounce\"><div class=\"sk-bounce1\"></div><div class=\"sk-bounce2\"></div><div class=\"sk-bounce3\"></div></div>", "<div class=\"sk-spinner sk-spinner-circle\"><div class=\"sk-circle1 sk-circle\"></div><div class=\"sk-circle2 sk-circle\"></div><div class=\"sk-circle3 sk-circle\"></div><div class=\"sk-circle4 sk-circle\"></div><div class=\"sk-circle5 sk-circle\"></div><div class=\"sk-circle6 sk-circle\"></div><div class=\"sk-circle7 sk-circle\"></div><div class=\"sk-circle8 sk-circle\"></div><div class=\"sk-circle9 sk-circle\"></div><div class=\"sk-circle10 sk-circle\"></div><div class=\"sk-circle11 sk-circle\"></div><div class=\"sk-circle12 sk-circle\"></div></div>", "<div class=\"sk-spinner sk-spinner-cube-grid\"><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div></div>", "<div class=\"sk-spinner sk-spinner-fading-circle\"><div class=\"sk-circle1 sk-circle\"></div><div class=\"sk-circle2 sk-circle\"></div><div class=\"sk-circle3 sk-circle\"></div><div class=\"sk-circle4 sk-circle\"></div><div class=\"sk-circle5 sk-circle\"></div><div class=\"sk-circle6 sk-circle\"></div><div class=\"sk-circle7 sk-circle\"></div><div class=\"sk-circle8 sk-circle\"></div><div class=\"sk-circle9 sk-circle\"></div><div class=\"sk-circle10 sk-circle\"></div><div class=\"sk-circle11 sk-circle\"></div><div class=\"sk-circle12 sk-circle\"></div></div>"];

$(document).ready(function(){
	$(".select2_demo_1").select2({
        theme: 'bootstrap4',
        width: '100%'
    });
});

function set_state(s){
	state = s;
}

function print_items(eu){
	var divContents = $("#div_item_eu").html(); 
	var a = window.open('', '', 'height=800, width=1500'); 
	a.document.write('<html>'); 
  	a.document.write('<body><center>');
  	a.document.write(eu+'<br>');
  	a.document.write('<table><tr>');
	a.document.write('<td>'+divContents+'</td>'); 
	a.document.write('</tr></table>');
  	a.document.write('</center></body></html>'); 
	a.document.close(); 
	a.print();
}

$(".warehouse_link").on('click', function(){
	$("#lbl_end_user").html("");
	$("table#item_eu tbody").html("");
    $("#all_total_amount").html("");

	$("#btn_show_end_users").removeAttr("disabled");
	$(".warehouse_link").removeClass('active');
	$(this).addClass('active');
	warehouse_name = $(this).data('name');
	$("#wh_name").html(warehouse_name);
	$("#warehouse_name").hide().html("<i class='fas'>&#xf494;</i> "+warehouse_name).fadeIn('fast');
	$.ajax({
		url: 	"php/pptctd_php.php",
		type: 	"POST",
		data: 	{call_func: "connect", warehouse: warehouse_name},
		success: function(data){
			get_distinct_users();
			get_records(state, 1, "");
		}
	});
});

function get_data(call_func, page, query = ""){
	$.ajax({
		type: 	"POST",
		data: 	{call_func: call_func, page: page, query: query, warehouse: warehouse_name},
		url: 	"php/pptctd_php.php",
		success: function(data){
			$('.table-responsive').html(data);
		}
	});
}

function get_distinct_users(){
	$.ajax({
		type: "POST",
		url: "php/pptctd_php.php",
		data: {call_func: "get_distinct_users", warehouse: warehouse_name},
		success: function(data){
			$("#nestable").html(data);
		}
	});
}

function get_records(s, p, q){
	if(warehouse_name != ""){
		$('.table-responsive').html(arr[Math.floor(Math.random() * arr.length)]+"<br>");
		switch(s){
			case 1:
				get_data("get_purchase_orders", p, q);
				break;
			case 2:
				get_data("get_iar", p, q);
				break;
			case 3:
				get_data("get_ics", p, q);
				break;
			case 4:
				get_data("get_par", p, q);
				break;
			case 5:
				get_data("get_ptr", p, q);
				break;
			case 6:
				get_data("get_ris", p, q);
				break;
		}
	}
}

$(document).on('click', '.page-link', function(){
    var page = $(this).data('page_number');
    var query = $('.search_box').val();
    get_records(state, page, query);
});

$('.search_box').keyup(function(){
    var query = $(this).val();
    get_records(state, 1, query);
});


function get_ppe_details(month,year){
	var year_month = year+"-"+month;
	$("#lbl_month").html($("#ppe_month option:selected").text());$("#lbl_year").html($("#ppe_year option:selected").text());
	$("table#tbl_ppe tbody").html("<tr>"+
                                    "<td colspan=\"13\"><h2><span><i class=\"fa fa-refresh fa-spin loader_ppe\" style=\"color: black;\"></i></span></h2></td>"+
                                "</tr>");
	$.ajax({
		type: "POST",
		data: {call_func: "get_ppe_details", year_month: year_month, warehouse: warehouse_name},
		url: "php/pptctd_php.php",
		success: function(data){
			if(data != ""){
				$("table#tbl_ppe tbody").html(data);
			}else{
				$("table#tbl_ppe tbody").html("<tr>"+
                                    "<td colspan=\"13\" style=\"text-align: center;\">No records found.</td>"+
                                "</tr>");
			}
		}
	});
}


function get_rsmi_details(month,year){
	var year_month = year+"-"+month;
	$("#rmonth").html($("#rsmi_month option:selected").text());$("#ryear").html($("#rsmi_year option:selected").text());
	$("#rsmi_tbody").html("<tr>"+
                            "<td colspan=\"10\"><center><h2><span><i class=\"fa fa-refresh fa-spin loader_ppe\" style=\"color: black;\"></i></span></h2></center></td>"+
                        "</tr>");
	$.ajax({
		type: "POST",
		data: {call_func: "get_rsmi_details", year_month: year_month, warehouse: warehouse_name},
		url: "php/pptctd_php.php",
		success: function(data){
			$("#rsmi_tbody").html(data);
		}
	});
}


function excel_ppe(){
	let file = new Blob([$('#ppe_head').html() + $('#ppe_report').html()], {type:"application/vnd.ms-excel"});
	let url = URL.createObjectURL(file);
	let a = $("<a />", {
	  href: url,
	  download: "PPE"+$("#lbl_month").html()+$("#lbl_year").html()+".xls"}).appendTo("body").get(0).click();
}

function print_ppe(){
	var divContents = $("#ppe_report").html(); 
	var a = window.open('', '', 'height=800, width=1500'); 
	a.document.write('<html>'); 
  	a.document.write('<body><center>');
  	a.document.write($("#ppe_head").html());
  	a.document.write('<table><tr>');
	a.document.write('<td>'+divContents+'</td>'); 
	a.document.write('</tr></table>');
  	a.document.write('</center></body></html>'); 
	a.document.close(); 
	a.print();
}


function excel_rsmi(){
	let file = new Blob([$('#report_rsmi').html()], {type:"application/vnd.ms-excel"});
	let url = URL.createObjectURL(file);
	let a = $("<a />", {
	  href: url,
	  download: "RSMI"+$("#rmonth").html()+$("#ryear").html()+".xls"}).appendTo("body").get(0).click();
}

function print_rsmi(){
	var divContents = $("#report_rsmi").html(); 
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

$("#lookup").keyup(function () {
    var value = this.value.toLowerCase().trim();
    $("table#tbl_ppe tbody tr").each(function (index) {
        $(this).find("td").each(function () {
            var id = $(this).text().toLowerCase().trim();
            var not_found = (id.indexOf(value) == -1);
            $(this).closest('tr').toggle(!not_found);
            return not_found;
        });
    });
});

$("#searchkw").keyup(function(){
	var num_count = 0;
	var value = $("#searchkw").val().toLowerCase();
	$("div#nestable ol li div").each(function(){
		var text = $(this).text().toLowerCase();
		if(text.indexOf(value) >= 0){
			$(this).parent().parent().show();
			num_count++;
		}else{
			$(this).parent().parent().hide();
		}
    });
});

$("#nestable").on('click','li .dd-handle',function (){
	$("li .dd-handle").css("background-color", "");
	var element = $(this);
	element.removeClass("dd-handle");
    var end_user = $(this).text();
    $.ajax({
    	type: "POST",
    	data: {call_func: "get_user_items", end_user: end_user, warehouse: warehouse_name},
    	url: "php/pptctd_php.php",
    	dataType: "JSON",
    	success: function(data){
    		$("#lbl_end_user").html("of "+end_user);
    		element.addClass("dd-handle");
    		element.css("background-color", "cyan");
    		$("table#item_eu tbody").html(data["tbody"]);
    		$("#all_total_amount").html(data["grand_total"]);
    	}
    });
});

$("#ppe_month").change(function(){
	get_ppe_details($("#ppe_month").val(),$("#ppe_year").val());
});

$("#ppe_year").change(function(){
	get_ppe_details($("#ppe_month").val(),$("#ppe_year").val());
});

$("#rsmi_month").change(function(){
	get_rsmi_details($("#rsmi_month").val(),$("#rsmi_year").val());
});

$("#rsmi_year").change(function(){
	get_rsmi_details($("#rsmi_month").val(),$("#rsmi_year").val());
});