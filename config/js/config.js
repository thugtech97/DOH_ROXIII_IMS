$(document).ready(function(){
	ready_all();
});


function ready_all(){
	$(".select2_demo_1").select2({
        theme: 'bootstrap4',
        width: '100%'
    });
    $("#director_head").ready(function(){
    	$.ajax({
    		url: "../supply_records/php/php_ics.php",
    		data: {call_func: "get_employee"},
    		type: "POST",
    		success: function(data){
    			$("#director_head").html("<option disabled selected></option>").append(data);
    			$("#property_custodian").html("<option disabled selected></option>").append(data);
    			$("#division_chief").html("<option disabled selected></option>").append(data);
    			$("#ppe_prepared_by").html("<option disabled selected></option>").append(data);
    			$("#ppe_noted_by").html("<option disabled selected></option>").append(data);
    			$("#wi_prepared_by").html("<option disabled selected></option>").append(data);
    			$("#wi_reviewed_by").html("<option disabled selected></option>").append(data);
    			$("#wi_noted_by").html("<option disabled selected></option>").append(data);
    			$("#wi_approved_by").html("<option disabled selected></option>").append(data);
    			$("#rpci_prepared_by").html("<option disabled selected></option>").append(data);
    			$("#rpci_certified").html("<option disabled selected></option>").append(data);
    			$("#rpci_noted_by").html("<option disabled selected></option>").append(data);
    			$("#rpci_approved_by").html("<option disabled selected></option>").append(data);
    			get_data();
    		}
    	});
    });
}

function get_data(){
	$.ajax({
		type: "POST",
		data: {call_func: "get_data"},
		dataType: "JSON",
		url: "php/config.php",
		success: function(data){
			$("#img_logo").attr("src", "../../archives/img/"+data["company_logo"]);
			$("#company_title").val(data["company_title"]);
			$("#supporting_title").val(data["supporting_title"]);
			$("#entity_name").val(data["entity_name"]);
			set_names("director_head", data["company_head"]);
			set_names("property_custodian", data["property_custodian"]);
			set_names("division_chief", data["division_chief"]);
			set_names("ppe_prepared_by", data["ppe_prepared_by"]);
			set_names("ppe_noted_by", data["ppe_noted_by"]);
			set_names("wi_prepared_by", data["wi_prepared_by"]);
			set_names("wi_reviewed_by", data["wi_reviewed_by"]);
			set_names("wi_noted_by", data["wi_noted_by"]);
			set_names("wi_approved_by", data["wi_approved_by"]);
			set_names("rpci_prepared_by", data["rpci_prepared_by"]);
			set_names("rpci_certified", data["rpci_certified_correct"]);
			set_names("rpci_noted_by", data["rpci_noted_by"]);
			set_names("rpci_approved_by", data["rpci_approved_by"]);
			$("#rpci_coa").val(data["rpci_coa"]);
			$("#rpci_coa_designation").val(data["rpci_coa_designation"]);
		}
	});
}

function set_names(id, value){
	var v = value.split("|");
	$('#'+id+' option').each(function() {
        if($(this).text() == v[1]) {
            $(this).prop("selected", true).change();
        }
    });
}

function save_organizational(){
	$.ajax({
		type: "POST",
		data: {
			call_func: "save_org",
			company_title: $("#company_title").val(),
			supporting_title: $("#supporting_title").val(),
			entity_name: $("#entity_name").val(),
			company_head: $("#director_head").val()+"|"+$("#director_head option:selected").text()
			},
		url: "php/config.php",
		success: function(data){
			swal("Updated!", "Organization details successfully updated.", "success");
		}
	});
}

function save_reporting(){
	$.ajax({
		type: "POST",
		data: {
			call_func: "save_rep",
			property_custodian: $("#property_custodian").val()+"|"+$("#property_custodian option:selected").text(),
			division_chief: $("#division_chief").val()+"|"+$("#division_chief option:selected").text(),
			ppe_prepared_by: $("#ppe_prepared_by").val()+"|"+$("#ppe_prepared_by option:selected").text(),
			ppe_noted_by: $("#ppe_noted_by").val()+"|"+$("#ppe_noted_by option:selected").text(),
			wi_prepared_by: $("#wi_prepared_by").val()+"|"+$("#wi_prepared_by option:selected").text(),
			wi_reviewed_by: $("#wi_reviewed_by").val()+"|"+$("#wi_reviewed_by option:selected").text(),
			wi_noted_by: $("#wi_noted_by").val()+"|"+$("#wi_noted_by option:selected").text(),
			wi_approved_by: $("#wi_approved_by").val()+"|"+$("#wi_approved_by option:selected").text(),
			rpci_prepared_by: $("#rpci_prepared_by").val()+"|"+$("#rpci_prepared_by option:selected").text(),
			rpci_certified_correct: $("#rpci_certified").val()+"|"+$("#rpci_certified option:selected").text(),
			rpci_noted_by: $("#rpci_noted_by").val()+"|"+$("#rpci_noted_by option:selected").text(),
			rpci_approved_by: $("#rpci_approved_by").val()+"|"+$("#rpci_approved_by option:selected").text(),
			rpci_coa: $("#rpci_coa").val(),
			rpci_coa_designation: $("#rpci_coa_designation").val()
			},
		url: "php/config.php",
		success: function(data){
			swal("Updated!", "Reporting details successfully updated.", "success");
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
	$.ajax({
		url: 'php/upload_logo.php?files&id=1',
		type: 'POST',
		data: data,
		cache: false,
		processData: false,
		contentType: false,
		success: function(data){
			$("#img_logo").attr("src", "../../archives/img/"+data);
  		}
	});
}