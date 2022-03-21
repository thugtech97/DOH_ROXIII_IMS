var category = "";
var item_name = "";
var item_desc = "";

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

function get_rsmi_details(month,year){
	var year_month = year+"-"+month;
	$("#rmonth").html($("#rsmi_month option:selected").text());$("#ryear").html($("#rsmi_year option:selected").text());
	$("#rsmi_tbody").html("<tr>"+
                            "<td colspan=\"10\"><center><h2><span><i class=\"fa fa-refresh fa-spin loader_ppe\" style=\"color: black;\"></i></span></h2></center></td>"+
                        "</tr>");
	$.ajax({
		type: "POST",
		data: {call_func: "get_rsmi_details", year_month: year_month},
		url: "php/php_sc.php",
		success: function(data){
			$("#rsmi_tbody").html(data);
		}
	});
}

function get_idr_details(from, to){
	if(from != null && to != null){
		var from_arr = from.split("-");
		var to_arr = to.split("-");	
		if(parseInt(from_arr[0]) <= parseInt(to_arr[0]) && parseInt(from_arr[1]) <= parseInt(to_arr[1])){
			$("#lbl_idrfrom").html($("#from_idr option:selected").text().toUpperCase());$("#lbl_idrto").html($("#to_idr option:selected").text().toUpperCase());
			$("#idr_tbody").html("<tr>"+
                                    "<td colspan=\"7\"><center><h2><span><i class=\"fa fa-refresh fa-spin loader_ppe\" style=\"color: black;\"></i></span></h2></center></td>"+
                                "</tr>");
			$.ajax({
				type: "POST",
				data: {call_func: "get_idr", from: from, to: to},
				url: "php/php_sc.php",
				dataType: "JSON",
				success: function(data){
					$("#idr_tbody").html(data["tbody"]);
					$("#idr_gtotal").html(data["grand_total"]);
				}
			});
		}else{
			swal("Invalid date selections!", "Please select a valid date range.", "error");
			$("#idr_tbody").html("");
			$("#idr_gtotal").html("0.00");
		}
	}
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

function excel_idr(){
	let file = new Blob([$('#report_idr').html()], {type:"application/vnd.ms-excel"});
	let url = URL.createObjectURL(file);
	let a = $("<a />", {
	  href: url,
	  download: "IDR_"+$("#from_idr option:selected").text()+"-"+$("#to_idr option:selected").text()+".xls"}).appendTo("body").get(0).click();
}

function print_idr(){
	var divContents = $("#report_idr").html(); 
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

function generate_wi(){
	$.ajax({
		type: "POST",
		data: {call_func: "print_wi", filter: $("#wi_lookup").val()},
		url: "php/php_sc.php",
		dataType: "JSON",
		success: function(data){
			$("#tbody_wi").html(data["tbody"]);
			$("#grand_total").html(data["grand_total"]);
			$("#modal_wi").modal();
		}
	});
}

function excel_wi(){
	let file = new Blob([$('#report_wi').html()], {type:"application/vnd.ms-excel"});
	let url = URL.createObjectURL(file);
	let a = $("<a />", {
	  href: url,
	  download: "WAREHOUSE_INVENTORY_"+$("#mwi").html()+$("#ywi").html()+".xls"}).appendTo("body").get(0).click();
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

function get_rpci(){
	$.ajax({
		type: "POST",
		data: {call_func: "get_rpci"},
		url: "php/php_sc.php",
		dataType: "JSON",
		success: function(data){
			$("#rpci_body").html(data["tbody"]);
			$("#rpci_gt").html(data["grand_total"]);
			$('#print_rpci').modal();
		}
	});
}

function excel_rpci(){
	let file = new Blob([$('#report_rpci').html()], {type:"application/vnd.ms-excel"});
	let url = URL.createObjectURL(file);
	let a = $("<a />", {
	  href: url,
	  download: "RPCI - "+$("#ao_rep").html()+".xls"}).appendTo("body").get(0).click();
}

function print_rpci(){
	var divContents = $("#report_rpci").html(); 
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
    item_name = $(this).find('b').text();
    item_desc = $(this).data("desc");
    $("#loader").show();
    $("#print_itemname").html("");
	$("#desc").html("");
	$("#sc_drugs").html("");
    $.ajax({
    	type: "POST",
    	data: {call_func: "print_stock_card", item_name: item_name, item_desc: item_desc, spec: ""},
    	url: "php/php_sc.php",
    	dataType: "JSON",
    	success: function(data){
    		$("#sc_refn").html(data["option_ref"]);
    		$("#loader").hide();
    		element.addClass("dd-handle");
    		$("#print_itemname").html(item_name);
    		$("#desc").html(item_desc);
    		$("#sc_drugs").html(data["sc_drugs"]);
    	}
    });
});

function load_sc_spec(spc){
	if(item_name != "" && item_desc != ""){
		$("#loader").show();
	    $("#print_itemname").html("");
		$("#desc").html("");
		$("#sc_drugs").html("");
	    $.ajax({
	    	type: "POST",
	    	data: {call_func: "print_stock_card", item_name: item_name, item_desc: item_desc, spec: spc},
	    	url: "php/php_sc.php",
	    	dataType: "JSON",
	    	success: function(data){
	    		$("#loader").hide();
	    		//element.addClass("dd-handle");
	    		$("#print_itemname").html(item_name);
	    		$("#desc").html(item_desc);
	    		$("#sc_drugs").html(data["sc_drugs"]);
	    	}
	    });
	}else{
		alert("panget ka!!");
	}
}

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

function compute_shortage(q, uc, value, qi, vi){
	var shortage_quantity = parseInt(q) - parseInt(value);
	$("#"+qi).html(shortage_quantity.toString())
	var shortage_value = parseFloat(uc * shortage_quantity);
	$("#"+vi).html(shortage_value.toFixed(2));
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

$("#wi_lookup").keyup(function() {
	var value = this.value;
	generate_wi();
});

$("#tbl_ppe:has(td)").mouseover(function(e) {
	$(this).css("cursor", "pointer");
});

$("#tbl_ppe:has(td)").click(function(e) {
	$("#tbl_ppe td").removeClass("highlight");
	var clickedCell= $(e.target).closest("td");
	clickedCell.addClass("highlight");
	var account_code = prompt("Edit account code:", clickedCell.text());
	if(account_code != null){
		clickedCell.html(account_code);
	}
});

$("#from_idr").change(function(){
	get_idr_details($("#from_idr").val(), $("#to_idr").val());
});

$("#to_idr").change(function(){
	get_idr_details($("#from_idr").val(), $("#to_idr").val());
});

$("#inv_rpci").keyup(function(){
	$("#inv_rep").html($("#inv_rpci").val().toUpperCase());
});

$("#ao_rpci").keyup(function(){
	$("#ao_rep").html($("#ao_rpci").val().toUpperCase());
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

$("#rsmi_month").change(function(){
	get_rsmi_details($("#rsmi_month").val(),$("#rsmi_year").val());
});

$("#rsmi_year").change(function(){
	get_rsmi_details($("#rsmi_month").val(),$("#rsmi_year").val());
});

$("#wi_month").change(function(){
	$("#mwi").html($("#wi_month option:selected").text());
	$("#ywi").html($("#wi_year option:selected").text());
});

$("#wi_year").change(function(){
	$("#mwi").html($("#wi_month option:selected").text());
	$("#ywi").html($("#wi_year option:selected").text());
});

$("#sc_refn").change(function(){
	$.ajax({
		type: "POST",
		url: "php/php_sc.php",
		data: {call_func: "get_sc_ref", refn: $("#sc_refn option:selected").text()},
		success: function(data){
			$("#sc_drugs").html(data);
		}
	});
});