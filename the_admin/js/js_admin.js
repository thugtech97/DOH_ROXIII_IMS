$(document).ready(function(){
    get_active_users();
});

function get_active_users(){
    $.ajax({
        type: "POST",
        data: {call_func: "get_active_users"},
        url: "php/php_admin.php",
        success: function(data){
            $("table#tbl_users tbody").html(data);
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
            {extend: 'excel', title: 'ActiveUsers'},
            {extend: 'pdf', title: 'ActiveUsers'},
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

function ready_all(){
    $(".select2_demo_1").select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    $("#emp_user").ready(function(){
        $.ajax({
            type: "POST",
            data: {call_func: "get_end_user"},
            url: "../php/php_po.php",
            success: function(data){
                $("#emp_user").html("<option disabled selected></option>").append(data);
            }
        });
    });
}

function save(){
    if($("#emp_user").val() != null){
        if($("#emp_role").val() != null){
            if($("#uname").val() != ""){
                if($("#pword").val() != ""){
                    if($("#cpword").val() != ""){
                        if($("#pword").val() == $("#cpword").val()){
                            $.ajax({
                                type: "POST",
                                data: {
                                    call_func: "save_user",
                                    user: $("#emp_user").val(),
                                    role: $("#emp_role option:selected").text(),
                                    uname: $("#uname").val(),
                                    pword: $("#pword").val()
                                },
                                url: "php/php_admin.php",
                                success: function(data){
                                    swal("New user added!", "", "success");
                                    setTimeout(function () {
                                        location.reload();
                                      }, 1500);
                                }
                            });
                        }else{
                            swal("Password not matched!", "", "warning");
                        }
                    }else{
                        swal("Please fill in!", "Confirm Password", "warning");
                    }
                }else{
                    swal("Please fill in!", "Password", "warning");
                } 
            }else{
                swal("Please fill in!", "Username", "warning");
            }
        }else{
            swal("Please fill in!", "Role", "warning");
        }
    }else{
        swal("Please fill in!", "User", "warning");
    }
}