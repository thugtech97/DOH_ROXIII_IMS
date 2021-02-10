var active_state = 1;
var items = [];
var pax_selected = "";
var snln = "";

var ntc_balance = "", actual_balance = "", quant = 0, pon="", eus = "", ctgr = "", account_code = "";

var $po_regex=/^([0-9]{4}-[0-9]{2}-[0-9]{4})|^([0-9]{4}-[0-9]{2}-[0-9]{3})$/;

var files;

$(document).ready(function(){
	get_po();
});

function loadLocal() {
	try{
		if(typeof(Storage) !== "undefined") {
			$("#vdate_received").val(JSON.parse(localStorage.getItem("po_details"))[0]);
			$("#vpo_number").val(JSON.parse(localStorage.getItem("po_details"))[1]);
			$("#vpr_number").val(JSON.parse(localStorage.getItem("po_details"))[2]);
			$("#po_enduser option").each(function() {
			    if($(this).text() == JSON.parse(localStorage.getItem("po_details"))[3]) {
			        $(this).prop("selected", true).change();
			    }
			});
			$("#date_conformed").val(JSON.parse(localStorage.getItem("po_details"))[4]);
			$("#vprocurement_mode").val(JSON.parse(localStorage.getItem("po_details"))[5]).change();
			$("#po_deliveryterm").val(JSON.parse(localStorage.getItem("po_details"))[6]).change();
			$("#po_paymentterm").val(JSON.parse(localStorage.getItem("po_details"))[7]).change();
			$("#po_supplier option").each(function() {
			    if($(this).text() == JSON.parse(localStorage.getItem("po_details"))[8]) {
			        $(this).prop("selected", true).change();
			    }
			});
			$("#date_delivered").val(JSON.parse(localStorage.getItem("po_details"))[9]);
			$("#status").val(JSON.parse(localStorage.getItem("po_details"))[10]).change();
			$("#item_various").html(JSON.parse(localStorage.getItem("po_details"))[11]);
		}else{
			console.log("Browser doesn't support local storage...");
		}
	}catch(e){
		console.log("No data stored on local storage.");
	}
}

Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

function insert_po(){
	switch(getActiveState()){
		case 1:
			validate_po_various();
			break;
		case 2:
			validate_po_catering();
			break;
		default:
			alert("working pa");
			break;
	}
}

function get_po(){
	$.ajax({
		type: "POST",
		data: {call_func: "get_po"},
		url: "php/php_po.php",
		success: function(data){
			$("table#tbl_po tbody").html(data);
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
            {extend: 'csv'},
            {extend: 'excel', title: 'PO'},
            {extend: 'pdf', title: 'PO'},

            {extend: 'print',
            	customize: function (win){
            		$(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');
                    $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
            	}
            }
        ]
    });
    ready_all();
}

/*
function validate_po_catering(){
	if($("#cdate_received").val() != ""){
		if($("#cpo_number").val().match($po_regex)){
			if($("#ntc_category").val() != null){
				if($("#cprocurement_mode").val() != null){
					if($("#date_filed").val() != ""){
						if($("#activity_date").val() != ""){
							if($("#ntc_number").val() != ""){
								if($("#activity_title").val() != ""){
									if($("#coordinator").val() != null){
										if($("#caterer").val() != null){
											if(pax_selected != "2" && pax_selected != ""){
												if($("#ntc_amount").val() != ""){
													if($("#actual_amount").val() != ""){
														$.ajax({
															type: "POST",
															url: "php/php_po.php",
															data: {
																call_func: "insert_po_catering",
																date_received: $("#cdate_received").val(),
																po_number: $("#cpo_number").val(),
																ntc_category: $("#ntc_category").val(),
																procurement_mode: $("#cprocurement_mode option:selected").text(),
																date_filed: $("#date_filed").val(),
																activity_date: $("#activity_date").val(),
																control_number: $("#ntc_number").val(),
																activity_title: $("#activity_title").val(),
																coordinator_id: $("#coordinator").val(),
																caterer_id: $("#caterer").val(),
																ntc_amount: origNumber($("#ntc_amount").val()),
																po_amount: ntc_balance,
																ntc_balance: origNumber($("#ntc_balance").val()),
																actual_amount: origNumber($("#actual_amount").val()),
																remarks: $("#remarks").val(),
																supply_received: $("#received_supply").val(),
																supply_processed: $("#processed_supply").val(),
																finance_forwarded: $("#forwarded_finance").val(),
																accountant_forwarded: $("#forwarded_accountant").val()
															},
															success: function(data){
																setTimeout(function() {
													                toastr.options = {
													                    closeButton: true,
													                    progressBar: true,
													                    showMethod: 'slideDown',
													                    timeOut: 4000
													                };
													                toastr.success('', 'New Purchase Order Added!');
													            }, 300);
																
																$("#add_po .close").click();
																$("#ntc_category").val(null).change();
																$("#cprocurement_mode").val(null).change();
																$("#date_filed").val("");
																$("#activity_date").val("");
																$("#ntc_number").val("");
																$("#activity_title").val("");
																$("#coordinator").val(null).change();
																$("#caterer").val(null).change();
																pax_selected = "";
																$("#ntc_amount").val("");
																$("#actual_amount").val("");
																get_po();
															}
														});
													}else{
														swal("Please fill in!", "Actual Amount", "warning");
													}
												}else{
													swal("Please fill in!", "NTC Amount", "warning");
												}
											}else{
												swal("Please fill in!", "NTC Not Found", "warning");
											}
										}else{
											swal("Please fill in!", "Caterer", "warning");
										}
									}else{
										swal("Please fill in!", "Coordinator", "warning");
									}
								}else{
									swal("Please fill in!", "Activity Title", "warning");
								}
							}else{
								swal("Please fill in!", "NTC Number", "warning");
							}
						}else{
							swal("Please fill in!", "Activity Date", "warning");
						}
					}else{
						swal("Please fill in!", "Date Filed", "warning");	
					}
				}else{
					swal("Please fill in!", "Mode of Procurement", "warning");
				}
			}else{
				swal("Please fill in!", "NTC Category", "warning");	
			}
		}else{
			swal("Invalid PO Number!", "Invalid PO Number", "warning");
		}
	}else{
		swal("Please fill in!", "Date Received", "warning");
	}
}
*/

function validate_po_various(){
	items = [];
	if($("#vdate_received").val() != ""){
		if($("#vpo_number").val() != ""){
			if($("#vprocurement_mode").val() != null){
				if($("#po_supplier").val() != null){
					if(get_item_rows() != 0){
						if($("#po_enduser").val() != null){
							if($("#status").val() != null){
								var inspect = 0;
								$("#save_changes").attr("disabled", true);
								$.ajax({
									type: "POST",
									url: "php/php_po.php",
									data: {	call_func: "insert_po_various",
											date_received: $("#vdate_received").val(),
											po_number: $("#vpo_number").val(),
											procurement_mode: $("#vprocurement_mode option:selected").text(),
											delivery_term: $("#po_deliveryterm option:selected").text(),
											payment_term: $("#po_paymentterm option:selected").text(),
											pr_no: $("#vpr_number").val(),
											//reso_no: $("#reso_number").val(),
											//abstract_no: $("#abstract_number").val(),
											supplier_id: ($("#po_supplier").val().split("┼"))[0],
											inspect: inspect,
											items: items,
											end_user: $("#po_enduser option:selected").text(),
											date_conformed: $("#date_conformed").val(),
											date_delivered: $("#date_delivered").val(),
											status: $("#status option:selected").text()
											},
									success: function(data){
										localStorage.setItem("po_details", JSON.stringify(["","","","","","","","","","","","<thead>"+
                                        "<tr><th></th><th>Item Name</th><th>Description</th><th>Category</th><th>SN / LN</th><th>Expiry Date</th>"+
                                        "<th>Unit Cost</th><th>Quantity</th><th>Total Amount</th><th></th></tr></thead><tbody></tbody><tfoot>"+
                                        "<tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th>TOTAL</th><th>₱ <span id=\"all_total_amount\"></span></th>"+
                                        "<th></th></tr></tfoot>"]));
										swal("Inserted!", "Saved successfully to the database.", "success");
								        setTimeout(function () {
									        location.reload();
									      }, 1500);
									}
								});
							}else{
								swal("Please fill in!", "Status", "warning");
							}
						}else{
							swal("Please fill in!", "End User", "warning");	
						}
					}else{
						swal("No items!", "Please add an item", "warning");
					}
				}else{
					swal("Please fill in!", "Supplier", "warning");
				}
			}else{
				swal("Please fill in!", "Mode of Procurement", "warning");
			}
		}else{
			swal("Invalid PO Number!", "Invalid PO Number", "warning");
		}
	}else{
		swal("Please fill in!", "Date Received", "warning");
	}
}

function view_po(po_number, eu){
	$("#view_po").modal();
	$("#po_num").html(po_number);
	eus = eu;
	$.ajax({
		type: "POST",
		data: {
			call_func: "get_po_pic",
			po_number: po_number
		},
		url: "php/php_po.php",
		success: function(data){
			$("#img_po").attr("src", "../archives/po/"+po_number.substring(0,4)+"/"+eu+"/"+data);
		}
	});
}

$(document).on('change', '.file', function(){
	prepareUpload(event);
});

function prepareUpload(event){
	files = event.target.files;
	uploadFiles(event);
}

function uploadFiles(event) {
	event.stopPropagation();
	event.preventDefault();
	var data = new FormData();
	$.each(files, function(key, value){
  		data.append(key, value);
	});
	console.log(data);
	$.ajax({
		url: 'php/upload_image.php?files&po_no='+$("#po_num").html()+'&eu='+eus,
		type: 'POST',
		data: data,
		cache: false,
		processData: false,
		contentType: false,
		success: function(data){
			$("#img_po").attr("src", "../archives/po/"+$("#po_num").html().substring(0,4)+"/"+eus+"/"+data);
  		}
	});
}

function edit_po_various(po_number){
	$("#ins_chk").attr("checked", false);
	pon = po_number;
	$("#edit_po_various").modal();
	$.ajax({
		type: "POST",
		url: "php/php_po.php",
		data: { call_func: "edit_po_various",
				po_number: po_number},
		dataType: "JSON",
		success: function(data){
			$("#edate_received").val(data["date_received"]);
			$("#epo_number").val(po_number);
			$("#epo_type").val(data["po_type"]);
			$("#epr_no").val(data["pr_no"]);
			$("#eprocurement_mode").val(data["procurement_mode"]).change();
			$("#edelivery_term").val(data["delivery_term"]).change();
			$("#epayment_term").val(data["payment_term"]).change();
			
			//$("#esupplier").val(data["supplier"]);
			$('#esupplier option').each(function() {
			    if($(this).text() == data["supplier"]) {
			        $(this).prop("selected", true).change();
			    }
			});
			$("#epo_enduser").val(data["end_user"]);
			/*$('#epo_enduser option').each(function() {
			    if($(this).text() == data["end_user"]) {
			        $(this).prop("selected", true).change();
			    }
			});*/
			var bool = (data["inspection_status"] == "1" ? true : false);
			$("#ins_chk").attr("checked", bool);
			$("#edate_conformed").val(data["date_conformed"]);
			$("#edate_delivered").val(data["date_delivered"]);
			$("#estatus").val(data["status"]).change();
			$("table#eitem_various tbody").html(data["tbody"]);
			$("#tot_amt").html(formatNumber(data["tot_amt"].toFixed(2)));
		}
	});
	
}

function delete_control(po_number){
	swal({
        title: "Are you sure?",
        text: "This PO record will be removed from the database.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: false
    }, function () {
    	$.ajax({
    		type: "POST",
    		data: {call_func: "delete_control",
    				field: "po_number",
    				table: "tbl_po",
    				number: po_number
    			},
    		url: "php/php_po.php",
    		success: function(data){
    			swal("Deleted!", "The PO No. "+po_number+" is now deleted.", "success");
		        setTimeout(function () {
			        location.reload();
			      }, 1500);
    		}
    	});
    });
}

function update(){
	$.ajax({
		type: "POST",
		url: "php/php_po.php",
		data: {
			call_func: "update_po",
			edate_received: $("#edate_received").val(),
			epo_number: $("#epo_number").val(),
			epr_no: $("#epr_no").val(),
			eprocurement_mode: $("#eprocurement_mode option:selected").text(),
			edelivery_term: $("#edelivery_term option:selected").text(),
			epayment_term: $("#epayment_term option:selected").text(),
			esupplier: ($("#esupplier").val().split("┼"))[0],
			epo_enduser: $("#epo_enduser").val(),
			edate_conformed: $("#edate_conformed").val(),
			edate_delivered: $("#edate_delivered").val(),
			estatus: $("#estatus option:selected").text(),
			einspection_status: ($('#ins_chk').is(':checked')) ? 1 : 0,
		},
		success: function(data){
			swal("Updated!", "PO details successfully updated.", "success");
	        setTimeout(function () {
		        location.reload();
		      }, 1500);
		}
	});
}

function add_sl(po_id,quan, ctgry){
	quant = quan; ctgr = ctgry;
	$("#po_id").html(po_id);
	$("#modal_snln").modal();
}

function save_snln(){
	var table = $("table#serials_numbers tbody");
	var rows = 0;
	var snlns = "";
	table.find('tr').each(function(i){
		var $tds = $(this).find('td');
		snlns+=$tds.eq(0).text()+"|";
		rows++;
	});
	if(ctgr != "Drugs and Medicines" && ctgr != "Medical Supplies"){
		if(rows == quant){
			$.ajax({
				type: "POST",
				data: {
					call_func: "add_serials",
					po_number: pon,
					po_id: $("#po_id").html(),
					sn_ln: snlns
				},
				url: "php/php_po.php",
				success: function(data){
					$("#modal_snln .close").click();
					$("table#eitem_various tbody").html(data);
					table.html("");
				}
			});
		}else{
			swal("Quantity not matched!", "Number of serial numbers should correspond to the item quantity", "error");
		}
	}else{
		$.ajax({
			type: "POST",
			data: {
				call_func: "add_serials",
				po_number: pon,
				po_id: $("#po_id").html(),
				sn_ln: snlns
			},
			url: "php/php_po.php",
			success: function(data){
				$("#modal_snln .close").click();
				$("table#eitem_various tbody").html(data);
				table.html("");
			}
		});
	}
}

function add_quantity(po_id, po_number){
	var q = prompt("New quantity:", "");
	$.ajax({
		type: "POST",
		url: "php/php_po.php",
		data: {call_func: "update_quantity",
				po_id: po_id,
				po_number: po_number,
				quantity: q
				},
		dataType: "JSON",
		success: function(data){
			$("table#eitem_various tbody").html(data["tbody"]);
			$("#tot_amt").html(formatNumber(data["tot_amt"].toFixed(2)));
		}
	});
}

function setActiveState(state){
	active_state = state;
}

function getActiveState(){
	return active_state;
}

$('#item_various').on('click', 'tbody tr button', function(event) {
	event.preventDefault();
	$(this).parents('tr').remove();
	get_total_row_amount();
});

function add_item(){
	if($("#item_name").val() != null){
		if($("#description").val() != ""){
			if($("#category").val() != ""){
				if($("#unit_cost").val() != ""){
					if($("#quantity").val() != ""){
						if(parseInt($("#quantity").val()) > 0){
							if($("#unit").val() != null){
								if($("#total_amount").val() != ""){
									if(get_snln_rows()[0] == 0){
										$("table#item_various tbody").append("<tr>"+
																			"<td>"+($("#item_name").val().split("┼"))[0]+"</td>"+
																			"<td>"+$("#item_name option:selected").text()+"</td>"+
																			"<td>"+$("#description").val()+"</td>"+
																			"<td>"+$("#category").val()+"</td>"+
																			"<td></td>"+
																			"<td>"+$("#exp_date").val()+"</td>"+
																			"<td>"+$("#unit_cost").val()+"</td>"+
																			"<td>"+$("#quantity").val()+" "+$( "#unit option:selected" ).text()+"</td>"+
																			"<td>"+$("#total_amount").val()+"</td>"+
																			"<td><center><button class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i></button></center></td>"+
																			"</tr>");
											$("#item_name").val(null).change();
											$("#description").val("");
											$("#category").val("");
											$("#sn_ln").val("");
											$("#exp_date").val("");
											$("#unit_cost").val("");
											$("#quantity").val("");
											$("#unit").val(null).change();
											$("#total_amount").val("");
											$('#exp_date').prop('disabled',true);
											get_total_row_amount();
									}else{
										validate_with_snln();
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


function validate_with_snln(){
	if($("#category").val() != "Drugs and Medicines" && $("#category").val() != "Medical Supplies"){
		if(get_snln_rows()[0] == parseInt($("#quantity").val())){
			$("table#item_various tbody").append("<tr>"+
											"<td>"+($("#item_name").val().split("┼"))[0]+"</td>"+
											"<td>"+$("#item_name option:selected").text()+"</td>"+
											"<td>"+$("#description").val()+"</td>"+
											"<td>"+$("#category").val()+"</td>"+
											"<td>"+snln+"</td>"+
											"<td>"+$("#exp_date").val()+"</td>"+
											"<td>"+$("#unit_cost").val()+"</td>"+
											"<td>"+$("#quantity").val()+" "+$( "#unit option:selected" ).text()+"</td>"+
											"<td>"+$("#total_amount").val()+"</td>"+
											"<td><center><button class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i></button></center></td>"+
											"</tr>");
			$("#item_name").val(null).change();
			$("#description").val("");
			$("#category").val("");
			$("#sn_ln").val("");
			$("#exp_date").val("");
			$("#unit_cost").val("");
			$("#quantity").val("");
			$("#unit").val(null).change();
			$("#total_amount").val("");
			$('#exp_date').prop('disabled',true);
			$("table#serial_numbers tbody").html("");
			get_total_row_amount();
		}else{
			swal("Quantity not matched!","Number of serial numbers should correspond to the inputted quantity","warning");
		}
	}else{
		$("table#item_various tbody").append("<tr>"+
										"<td>"+($("#item_name").val().split("┼"))[0]+"</td>"+
										"<td>"+$("#item_name option:selected").text()+"</td>"+
										"<td>"+$("#description").val()+"</td>"+
										"<td>"+$("#category").val()+"</td>"+
										"<td>"+snln+"</td>"+
										"<td>"+$("#exp_date").val()+"</td>"+
										"<td>"+$("#unit_cost").val()+"</td>"+
										"<td>"+$("#quantity").val()+" "+$( "#unit option:selected" ).text()+"</td>"+
										"<td>"+$("#total_amount").val()+"</td>"+
										"<td><center><button class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i></button></center></td>"+
										"</tr>");
		$("#item_name").val(null).change();
		$("#description").val("");
		$("#category").val("");
		$("#sn_ln").val("");
		$("#exp_date").val("");
		$("#unit_cost").val("");
		$("#quantity").val("");
		$("#unit").val(null).change();
		$("#total_amount").val("");
		$('#exp_date').prop('disabled',true);
		$("table#serial_numbers tbody").html("");
		get_total_row_amount();
	}
}
function fill_pax(){
	if(pax_selected != ""){
		if(pax_selected == "1"){
			$('#fill_pax').modal('show');
		}else{
			swal("Contract not found!", "No contracts available.", "error");
		}
	}else{
		swal("Please fill in!", "Select an NTC Category and year.", "warning");
	}
}

function save_pax(){
	$('#ntc_amount').val(formatNumber($('#total_cost_pax').html())); 
	$('#fill_pax').modal('hide'); 
	$('body').addClass('modal-open');
	var diff = parseFloat(ntc_balance) - parseFloat(origNumber($("#ntc_amount").val()));
	$("#ntc_balance").val(formatNumber(diff));
}

function calculate_total_amount(){
	var unit_cost = ($("#unit_cost").val() != "") ? parseFloat(origNumber($("#unit_cost").val())) : 0.00;
	var quantity = ($("#quantity").val() != "") ? parseFloat($("#quantity").val()) : 0.00;

	var total_amount = unit_cost * quantity;
	$("#total_amount").val(formatNumber(total_amount.toFixed(2)));
}

function get_snln_rows(){
	snln = "";
	var table = $("table#serial_numbers tbody");
	var rows = 0;
	table.find('tr').each(function(i){
		var $tds = $(this).find('td');
		snln+=$tds.eq(0).text()+"|";
		rows++;
	});
	return [rows, snln];
}

function pax_total_cost(){
	var table = $("table#pax_table tbody");
	var total_cost_pax = 0.00;
	table.find('tr').each(function(i){
		var $tds = $(this).find('td');
		var ppax = parseFloat($tds.eq(1).text()); 
		var pax = ($tds.eq(2).find('input').val() == "") ? 0.00 : parseFloat($tds.eq(2).find('input').val());
		var days = ($tds.eq(3).find('input').val() == "") ? 0.00 : parseFloat($tds.eq(3).find('input').val());

		var total = ppax * pax * days;
		total_cost_pax+=total;
		$tds.eq(4).find('input').val(total.toFixed(2));
	});
	$("#total_cost_pax").html(formatNumber(total_cost_pax));
}

function get_total_row_amount(){
	var all_total_amount = 0;
	var table = $("table#item_various tbody");
	table.find('tr').each(function (i) {
		var $tds = $(this).find('td');
		all_total_amount+=parseFloat(origNumber($tds.eq(8).text()));
	});
	$("#all_total_amount").html(formatNumber(all_total_amount.toFixed(2)));
}

function get_item_rows(){
	var table = $("table#item_various tbody");
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
	    items.push([item_id, item_name, description, category, sn_ln, exp_date, unit_cost, quantity, total_amount]);
		rows++;
	});
	return rows;
}

function load_ntc_info(){
	$("table#pax_table tbody").html("");
	if($("#ntc_category").val() != null && $("#ntc_year").val() != null){
		$.ajax({
			type: "POST",
			data: {call_func: "get_ntc_attr", ntc_category: $("#ntc_category option:selected").text(), ntc_year: $("#ntc_year").val()},
			url: "php/php_po.php",
			dataType: "JSON",
			success: function(data){
				if(data["found"]){
					pax_selected = "1";
					$("#ntc_contract_panel").slideDown("fast");
					$("#total_contract").val(parseFloat(data["total_contract"]).toLocaleString());
					$("#effect_contract").val(data["contract_effectivity"]);
					$("#contract_no").val(data["contract_number"]);

					ntc_balance = data["ntc_balance"];
					actual_balance = data["actual_balance"];

					var _ppax = ["BREAKFAST", "AM SNACKS", "LUNCH", "PM SNACKS", "DINNER", "LODGING"];

					for(var i = 0; i < data["_ppax"].length; i++){
						$("table#pax_table tbody").append("<tr>"+
						                                    "<td>"+_ppax[i]+"</td>"+
						                                    "<td>"+data["_ppax"][i]+"</td>"+
						                                    "<td style=\"width: 100px;\"><input type=\"number\" onkeyup=\"pax_total_cost();\" style=\"width:100%;\"></td>"+
						                                    "<td style=\"width: 100px;\"><input type=\"number\" onkeyup=\"pax_total_cost();\" style=\"width:100%;\"></td>"+
						                                    "<td style=\"width: 100px;\"><input type=\"text\" style=\"width:100%;\" disabled></td>"+
		                                				"</tr>");
					}
					pax_total_cost();
				}else{
					$("#ntc_contract_panel").slideUp("fast");
					pax_selected = "2";
				}
			}
		});
	}
}

function origNumber(s){
	return s.split(',').join('');
}

function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

function consolidate(_po){
	$("#view_conso").modal();
	$("#_pon_").html(_po);
	$.ajax({
		type: "POST",
		data: {call_func: "consolidate_po", po_number: _po},
		url: "php/php_po.php",
		success: function(data){
			$("#pdf_conso").attr("src", "../archives/consolidated_po/"+$("#_pon_").html().substring(0,4)+"/"+data);
		}
	});
}

function ready_all(){
	$(".select2_demo_1").select2({
        theme: 'bootstrap4',
        width: '100%'
    });

	$("#po_supplier").ready(function(){
		$.ajax({
			type: "POST",
			data: {call_func: "get_supplier"},
			url: "php/php_po.php",
			success: function(data){
				$("#po_supplier").html("<option disabled selected></option>").append(data);
				$("#esupplier").html("<option disabled selected></option>").append(data);
				loadLocal();
			}
		});
	});

	$("#po_enduser").ready(function(){
		$.ajax({
			type: "POST",
			data: {call_func: "get_end_user"},
			url: "php/php_po.php",
			success: function(data){
				$("#po_enduser").html("<option disabled selected></option>").append(data);
				//$("#epo_enduser").html("<option disabled selected></option>").append(data);
				loadLocal();
			}
		});
	});

	$("#item_name").ready(function(){
		$.ajax({
			type: "POST",
			data: {call_func: "get_item"},
			url: "php/php_po.php",
			success: function(data){
				$("#item_name").html("<option disabled selected></option>").append(data);
				loadLocal();
			}
		});
	});

	$("#item_name").on("change", function(e){
		$("#category").val($("#item_name option:selected").data("cat"));
		account_code = $("#item_name option:selected").data("ac");
		if($("#category").val()=="Drugs and Medicines" || $("#category").val()=="Medical Supplies"){
			$('#exp_date').prop('disabled',false);	
		}else{
			$('#exp_date').prop('disabled',true);
		}
	});

	$("#unit").ready(function(){
		$.ajax({
			type: "POST",
			data: {call_func: "get_unit"},
			url: "php/php_po.php",
			success: function(data){
				$("#unit").html("<option disabled selected></option>").append(data);
				loadLocal();
			}
		});
	});

	$("#coordinator").ready(function(){
		$.ajax({
			type: "POST",
			data: {call_func: "get_coordinator"},
			url: "php/php_po.php",
			success: function(data){
				$("#coordinator").html("<option disabled selected></option>").append(data);
				loadLocal();
			}
		});
	});

	$("#caterer").ready(function(){
		$.ajax({
			type: "POST",
			data: {call_func: "get_caterer"},
			url: "php/php_po.php",
			success: function(data){
				$("#caterer").html("<option disabled selected></option>").append(data);
				loadLocal();
			}
		});
	});

	$("#ntc_category").ready(function(){
		$.ajax({
			type: "POST",
			data: {call_func: "get_ntc"},
			url: "php/php_po.php",
			success: function(data){
				$("#ntc_category").html("<option disabled selected></option>").append(data);
				loadLocal();
			}
		});
	});

	$("#vprocurement_mode").on("change", function(event){
		if($("#vprocurement_mode option:selected").text() == "Central-Office"){
			$("#title-type").html("PTR");
		}else{
			$("#title-type").html("P.O");
		}
	});
}

function add_snln(){
	if($("#sn_ln").val() != ""){
		$("table#serial_numbers tbody").append("<tr>"+
													"<td>"+$("#sn_ln").val()+"</td>"+
													"<td><center><button class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i></button></center></td>"+
												"</tr>");
		$("#sn_ln").val("");
	}else{
		swal("Please fill in!", "No serial numbers inputted!", "warning");
	}
	$("#sn_ln").focus();
}

function add_snlns(){
	if($("#sn_lns").val() != ""){
		$("table#serials_numbers tbody").append("<tr>"+
													"<td>"+$("#sn_lns").val()+"</td>"+
													"<td><center><button class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i></button></center></td>"+
												"</tr>");
		$("#sn_lns").val("");
	}else{
		swal("Please fill in!", "No serial numbers inputted!", "warning");
	}
	$("#sn_lns").focus();
}

function setLocalStorage(){
	localStorage.setItem("po_details", JSON.stringify([$("#vdate_received").val(),$("#vpo_number").val(),$("#vpr_number").val(),$("#po_enduser option:selected").text(),
		$("#date_conformed").val(),$("#vprocurement_mode option:selected").text(),$("#po_deliveryterm option:selected").text(),$("#po_paymentterm option:selected").text(),
		$("#po_supplier option:selected").text(),$("#date_delivered").val(),$("#status option:selected").text(),$("#item_various").html()]));
	//alert(JSON.parse(localStorage.getItem("po_details"))[6]);
}

$('#serial_numbers').on('click', 'tbody tr button', function(event) {
	event.preventDefault();
	$(this).parents('tr').remove();
});

$('#serials_numbers').on('click', 'tbody tr button', function(event) {
	event.preventDefault();
	$(this).parents('tr').remove();
});

$(".i-checks").change(function(){
	if(this.checked){
		$("#sn_ln").prop("disabled", false);
	}else{
		$("#sn_ln").prop("disabled", true);
	}
});

$("#ntc_category").change(function(){
	load_ntc_info();
});

$("#ntc_year").change(function(){
	load_ntc_info();
});

$(".input-amount").keyup(function(){
	calculate_total_amount();
});

$(".form-control").focusout(function(){
	setLocalStorage();
});
