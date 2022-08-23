var bitems = [];

$(document).ready(function(){
	bready_all();
});

function bready_all(){
	$("#bitem_name").ready(function(){
		$.ajax({
			type: "POST",
			data: {call_func: "get_item"},
			url: "php/php_po.php",
			success: function(data){
				$("#bitem_name").html("<option disabled selected></option>").append(data);
			}
		});
	});

	$("#bitem_name").change(function(){
		$("#bcategory").val($("#bitem_name option:selected").data("cat"));
		if($("#bcategory").val()=="Drugs and Medicines" || $("#bcategory").val()=="Medical Supplies" || $("#bcategory").val()=="Various Supplies"){
			$('#bexp_date').prop('disabled',false);	
		}else{
			$('#bexp_date').prop('disabled',true);
		}
	});

	$("#bunit").ready(function(){
		$.ajax({
			type: "POST",
			data: {call_func: "get_unit"},
			url: "php/php_po.php",
			success: function(data){
				$("#bunit").html("<option disabled selected></option>").append(data);
			}
		});
	});
	$("#bf_sup").ready(function(){
		$.ajax({
			type: "POST",
			data: {call_func: "get_supplier"},
			url: "php/php_po.php",
			success: function(data){
				$("#bf_sup").html("<option disabled selected></option>").append(data);
				$('#bf_sup option').each(function() {
			    if($(this).text() == "Bal-Fwd") {
			        $(this).prop("selected", true).change();
			    }
			});
			}
		});
	});
}

function bget_snln_rows(){
	snln = "";
	var table = $("table#bserial_numbers tbody");
	var rows = 0;
	table.find('tr').each(function(i){
		var $tds = $(this).find('td');
		snln+=$tds.eq(0).text()+"|";
		rows++;
	});
	return [rows, snln];
}

function bget_total_row_amount(){
	var all_total_amount = 0;
	var table = $("table#bitem_various tbody");
	table.find('tr').each(function (i) {
		var $tds = $(this).find('td');
		all_total_amount+=parseFloat(origNumber($tds.eq(8).text()));
	});
	$("#btot_amt").html(formatNumber(all_total_amount.toFixed(3)));
}

function badd_item(){
	if($("#bitem_name").val() != null){
		if($("#bdescription").val() != ""){
			if($("#bcategory").val() != ""){
				if($("#bunit_cost").val() != ""){
					if($("#bquantity").val() != ""){
						if(parseInt($("#bquantity").val()) > 0){
							if($("#bunit").val() != null){
								if($("#btotal_amount").val() != ""){
									if(bget_snln_rows()[0] == 0){
										$("table#bitem_various tbody").append("<tr>"+
																			"<td>"+($("#bitem_name").val().split("┼"))[0]+"</td>"+
																			"<td>"+$("#bitem_name option:selected").text()+"</td>"+
																			"<td>"+$("#bdescription").val()+"</td>"+
																			"<td>"+$("#bcategory").val()+"</td>"+
																			"<td></td>"+
																			"<td>"+$("#bexp_date").val()+"</td>"+
																			"<td>"+$("#bunit_cost").val()+"</td>"+
																			"<td>"+$("#bquantity").val()+" "+$( "#bunit option:selected" ).text()+"</td>"+
																			"<td>"+$("#btotal_amount").val()+"</td>"+
																			"<td><center><button class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i></button></center></td>"+
																			"</tr>");
											$("#bitem_name").val(null).change();
											$("#bdescription").val("");
											$("#bcategory").val("");
											$("#bsn_ln").val("");
											$("#bexp_date").val("");
											$("#bunit_cost").val("");
											$("#bquantity").val("");
											$("#bunit").val(null).change();
											$("#btotal_amount").val("");
											$('#bexp_date').prop('disabled',true);
											bget_total_row_amount();
									}else{
										bvalidate_with_snln();
									}
								}else{
									swal("Please fill in!", "Total amount", "warning");
								}
							}else{
								swal("Please fill in!", "Unit", "warning");
							}
						}else{
							swal("Quantity can't be negative or zero","","warning");	
						}
					}else{
						swal("Please fill in!", "Quantity", "warning");
					}	
				}else{
					swal("Please fill in!", "Unit cost", "warning");
				}
			}else{
				swal("Please fill in!", "Category", "warning");	
			}
		}else{
			swal("Please fill in!", "Description", "warning");	
		}
	}else{
		swal("Please fill in!", "Item name", "warning");
	}
}

function bvalidate_with_snln(){
	if($("#bcategory").val() != "Drugs and Medicines" && $("#bcategory").val() != "Medical Supplies" && $("#bcategory").val() != "Various Supplies"){
		if(bget_snln_rows()[0] == parseInt($("#bquantity").val())){
			$("table#bitem_various tbody").append("<tr>"+
											"<td>"+($("#bitem_name").val().split("┼"))[0]+"</td>"+
											"<td>"+$("#bitem_name option:selected").text()+"</td>"+
											"<td>"+$("#bdescription").val()+"</td>"+
											"<td>"+$("#bcategory").val()+"</td>"+
											"<td>"+snln+"</td>"+
											"<td>"+$("#bexp_date").val()+"</td>"+
											"<td>"+$("#bunit_cost").val()+"</td>"+
											"<td>"+$("#bquantity").val()+" "+$( "#bunit option:selected" ).text()+"</td>"+
											"<td>"+$("#btotal_amount").val()+"</td>"+
											"<td><center><button class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i></button></center></td>"+
											"</tr>");
			$("#bitem_name").val(null).change();
			$("#bdescription").val("");
			$("#bcategory").val("");
			$("#bsn_ln").val("");
			$("#bexp_date").val("");
			$("#bunit_cost").val("");
			$("#bquantity").val("");
			$("#bunit").val(null).change();
			$("#btotal_amount").val("");
			$('#bexp_date').prop('disabled',true);
			$("table#bserial_numbers tbody").html("");
			bget_total_row_amount();
		}else{
			swal("Quantity not matched!","Number of serial numbers should correspond to the inputted quantity","warning");
		}
	}else{
		$("table#bitem_various tbody").append("<tr>"+
										"<td>"+($("#bitem_name").val().split("┼"))[0]+"</td>"+
										"<td>"+$("#bitem_name option:selected").text()+"</td>"+
										"<td>"+$("#bdescription").val()+"</td>"+
										"<td>"+$("#bcategory").val()+"</td>"+
										"<td>"+snln+"</td>"+
										"<td>"+$("#bexp_date").val()+"</td>"+
										"<td>"+$("#bunit_cost").val()+"</td>"+
										"<td>"+$("#bquantity").val()+" "+$( "#bunit option:selected" ).text()+"</td>"+
										"<td>"+$("#btotal_amount").val()+"</td>"+
										"<td><center><button class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i></button></center></td>"+
										"</tr>");
		$("#bitem_name").val(null).change();
		$("#bdescription").val("");
		$("#bcategory").val("");
		$("#bsn_ln").val("");
		$("#bexp_date").val("");
		$("#bunit_cost").val("");
		$("#bquantity").val("");
		$("#bunit").val(null).change();
		$("#btotal_amount").val("");
		$('#bexp_date').prop('disabled',true);
		$("table#bserial_numbers tbody").html("");
		bget_total_row_amount();
	}
}

$('#bitem_various').on('click', 'tbody tr button', function(event) {
	event.preventDefault();
	$(this).parents('tr').remove();
	bget_total_row_amount();
});

function badd_snln(){
	if($("#bsn_ln").val() != ""){
		$("table#bserial_numbers tbody").append("<tr>"+
													"<td>"+$("#bsn_ln").val()+"</td>"+
													"<td><center><button class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i></button></center></td>"+
												"</tr>");
		$("#bsn_ln").val("");
	}else{
		swal("Please fill in!", "No serial numbers inputted!", "warning");
	}
	$("#bsn_ln").focus();
}

function bget_item_rows(){
	var table = $("table#bitem_various tbody");
	var rows = 0;
	table.find('tr').each(function (i) {
		var $tds = $(this).find('td');
		var item_id = $tds.eq(0).text();
	    var item_name = $tds.eq(1).text();
	    var description = $tds.eq(2).text();
	    var category = $tds.eq(3).text();
	    var sn_ln = $tds.eq(4).text();
	    var exp_date = $tds.eq(5).text();
	    var unit_cost = origNumber($tds.eq(6).text());
	    var quantity = $tds.eq(7).text();
	    var total_amount = origNumber($tds.eq(8).text());
	    bitems.push([item_id, item_name, description, category, sn_ln, exp_date, unit_cost, quantity, total_amount]);
		rows++;
	});
	return rows;
}

function save_balfwd(){
	bitems = [];
	if($("#bdfwd").val() != ""){
		if(bget_item_rows() != 0){
			$("#bsave_changes").attr("disabled", true);
			$.ajax({
				type: "POST",
				data: {
					call_func: "save_bf",
					po_number: ($("#bf_pon").val()!="") ? $("#bf_pon").val() : "Bal-Fwd",
					date_fwd: $("#bdfwd").val(),
					supplier_id: ($("#bf_sup").val().split("┼"))[0],
					program_eu: $("#bprogrameu").val(),
					items: bitems
				},
				url: "php/php_bf.php",
				success: function(data){
					swal("Inserted!", "Saved successfully to the database.", "success");
			        setTimeout(function () {
				        location.reload();
				      }, 1500);
				}
			});
		}else{
			swal("No items!", "Please add an item", "warning");
		}
	}else{
		swal("Please fill in!", "Date Forwarded", "warning");
	}
}

function bcalculate_total_amount(){
	var unit_cost = ($("#bunit_cost").val() != "") ? parseFloat(origNumber($("#bunit_cost").val())) : 0.00;
	var quantity = ($("#bquantity").val() != "") ? parseFloat($("#bquantity").val()) : 0.00;

	var total_amount = unit_cost * quantity;
	$("#btotal_amount").val(formatNumber(total_amount.toFixed(3)));
}

$('#bserial_numbers').on('click', 'tbody tr button', function(event) {
	event.preventDefault();
	$(this).parents('tr').remove();
});

$(".input-amounts").keyup(function(){
	bcalculate_total_amount();
});

$(".bcheck").change(function(){
	if(this.checked){
		$("#bsn_ln").prop("disabled", false);
	}else{
		$("#bsn_ln").prop("disabled", true);
	}
});