$(document).ready(function(){
	
});

function get_ptr(){
    $.ajax({
        type: "POST",
        data: {call_func: "get_ptr"},
        url: "php/testcode.php",
        success: function(data){
            $("table#test_table tbody").html(data);
            create_datatable("PTR");
        }
    });
}

function get_records(call_func, type){
    $.ajax({
        type: "POST",
        data: {call_func: call_func},
        url: "php/testcode.php",
        success: function(data){
            $("table#test_table tbody").html(data);
            create_datatable(type);
        }
    });
}

function create_datatable(type){
    $('.dataTables-example').DataTable({
        pageLength: 10,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            { extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: type},
            {extend: 'pdf', title: type},

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