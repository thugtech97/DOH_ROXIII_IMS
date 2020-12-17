var category = "";

$(document).ready(function(){
	$(".select2_demo_1").select2({
        theme: 'bootstrap4',
        width: '100%'
    });
});

function get_ppe_details(month,year){
	var year_month = year+"-"+month;
	$("#lbl_month").html($("#ppe_month option:selected").text());$("#lbl_year").html($("#ppe_year option:selected").text());
	$("table#tbl_ppe tbody").html("<tr>"+
                                    "<td colspan=\"13\"><h2><span><i class=\"fa fa-refresh fa-spin loader_ppe\" style=\"color: black;\"></i></span></h2></td>"+
                                "</tr>");
	$.ajax({
		type: "POST",
		data: {call_func: "get_ppe_details", year_month: year_month},
		url: "php/php_sc.php",
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

function print_sc(){
	var divContents = $("#report_sc").html(); 
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

function print_wi(){
	var divContents = $("#report_wi").html(); 
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

function load_item(c,s){
	$("#print_itemname").html("");
	$("#desc").html("");
	$("#sc_drugs").html("");
	$("#nestable").html("<div style=\"display:flex;justify-content:center;align-items:center;height:400px;\"><p><i class=\"fa fa-refresh fa-spin loader\" style=\"font-size:24px; color: black;\"></i></p></div>");
	$.ajax({
		type: "POST",
		data: {call_func: "get_item", category: c, searchkw: s},
		url: "php/php_sc.php",
		dataType: "JSON",
		success: function(data){
			$("#cat").html(c);
			$("#nestable").html(data["list_items"]);
			$("#num_items").html(data["num_items"]);
		}
	});
}

$("#nestable").on('click','li .dd-handle',function (){
	var element = $(this);
	element.removeClass("dd-handle");
    var item_name = $(this).find('b').text();
    var item_desc = $(this).data("desc");
    $("#loader").show();
    $("#print_itemname").html("");
	$("#desc").html("");
	$("#sc_drugs").html("");
    $.ajax({
    	type: "POST",
    	data: {call_func: "print_stock_card", item_name: item_name, item_desc: item_desc},
    	url: "php/php_sc.php",
    	dataType: "JSON",
    	success: function(data){
    		$("#loader").hide();
    		element.addClass("dd-handle");
    		$("#print_itemname").html(item_name);
    		$("#desc").html(item_desc);
    		$("#sc_drugs").html(data["sc_drugs"]);
    	}
    });
});

$("#category").ready(function(){
	$.ajax({
		type: "POST",
		data: {call_func: "get_category"},
		url : "php/php_po.php",
		success: function(data){
			$("#category").html("<option disabled selected></option>").append(data);
		}
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
    $("#num_items").html(num_count);
});

$("#category").change(function(){
	load_item($("#category option:selected").text(), $("#searchkw").val());
});

$("#ppe_month").change(function(){
	get_ppe_details($("#ppe_month").val(),$("#ppe_year").val());
});

$("#ppe_year").change(function(){
	get_ppe_details($("#ppe_month").val(),$("#ppe_year").val());
});