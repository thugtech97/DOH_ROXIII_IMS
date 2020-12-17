$(document).ready(function(){
    populate_pax_table();
});

$("#choose_type").change(function(){
    if($("#choose_type option:selected").text() == "Contract"){
        $("#po_form").slideUp("fast", function(){
            $("#contract_form").slideDown("fast");
        });
    }else{
        $("#contract_form").slideUp("fast", function(){
            $("#po_form").slideDown("fast");
        });
    }
});

function calculate_pax_table(){

}

function populate_pax_table(){
    var _ppax = ["BREAKFAST", "AM SNACKS", "LUNCH", "PM SNACKS", "DINNER", "LODGING"];
    for(var i = 0; i < _ppax.length; i++){
        $("table#tbl_pax_ibox tbody").append("<tr>"+
                                            "<td><label style=\"width: 180px;\">"+_ppax[i]+"</label></td>"+
                                            "<td><input type=\"number\" onkeyup=\"\" style=\"width:100%;\"></td>"+
                                            "<td><input type=\"number\" onkeyup=\"\" style=\"width:100%;\"></td>"+
                                            "<td><input type=\"number\" onkeyup=\"\" style=\"width:100%;\"></td>"+
                                            "<td><input type=\"number\" onkeyup=\"\" style=\"width:100%;\"></td>"+
                                            "<td><input type=\"number\" onkeyup=\"\" style=\"width:100%;\"></td>"+
                                            "<td><input type=\"text\" style=\"width:100%;\" disabled></td>"+
                                        "</tr>");
    }
    calculate_pax_table();
}