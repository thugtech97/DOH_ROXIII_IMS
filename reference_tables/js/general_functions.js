$(document).ready(function(){
	console.log("reference table functions!!!");
    $(".select2_demo_1").select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    $("#category").ready(function(){
        $.ajax({
            type: "POST",
            data: {call_func: "get_category"},
            url: "../php/php_po.php",
            success: function(data){
                $("#category").html("<option disabled selected></option>").append(data);
            }
        });
    });
});

function loadData(query, fields, title, table) {
	$.ajax({
		data: {call_func: "get_data", query: query, fields: fields},
		type: 'POST',
		url: 'php/php_datatables.php',
		success: function (data) {
			$("table#"+table+" tbody").html(data);
			create_datatable(title);
		}
	});
}

function create_datatable(title){
    $('.dataTables-example').DataTable({
        pageLength: 10,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: title},
            {extend: 'pdf', title: title},
            {extend: 'print',
             customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
            }
            }
        ]
    });
}

function add_category(){
    if($("#category_name").val() != ""){
        if($("#category_code").val() != ""){
            $.ajax({
                data: {call_func: "insert_category", category: $("#category_name").val(), category_code: $("#category_code").val()},
                type: "POST",
                url: "php/php_datatables.php",
                success: function(data){
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            });
        }else{
            swal("Please fill in!","Category code","warning");
        }
    }else{
        swal("Please fill in!","Category name","warning");
    }
}

function add_item(){
    if($("#item").val() != ""){
        if($("#category").val() != null){
            $.ajax({
                data: {call_func: "insert_item", item: $("#item").val(), category_id: $("#category").val()},
                type: "POST",
                url: "php/php_datatables.php",
                success: function(data){
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            });
        }else{
            swal("Please fill in!","Category","warning");
        }
    }else{
        swal("Please fill in!","Item name","warning");
    }
}

function add_supplier(){
    var supplier = prompt("Enter new supplier:", "");
    if(supplier != ""){
        $.ajax({
            data: {call_func: "insert_supplier", supplier: supplier},
            type: "POST",
            url: "php/php_datatables.php",
            success: function(data){
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
        });
    }else{
        swal("Supplier not added!","","error");
    }
}

function add_unit(){
    var unit = prompt("Enter new unit:", "");
    if(unit != ""){
        $.ajax({
            data: {call_func: "insert_unit", unit: unit},
            type: "POST",
            url: "php/php_datatables.php",
            success: function(data){
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
        });
    }else{
        swal("Unit not added!","","error");
    }
}