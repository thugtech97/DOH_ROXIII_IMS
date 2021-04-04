var iss_numbers, tables, fields, isss, iss_fields, rbs;

function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    filename = filename?filename+'.xls':'excel_data.xls';
    downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
    }
}

function view_iss(iss_number, table, field, iss, iss_field, rb){
    $("#view_iss").modal();
    $("#iss").html(iss);
    $("#iss_num").html(iss_number);
    iss_numbers = iss_number; tables = table; fields = field; isss = iss; iss_fields = iss_field; rbs = rb;
    $.ajax({
        type: "POST",
        data: {
            call_func: "get_pic",
            table: table,
            field: field,
            iss_field: iss_field,
            iss_number: iss_number
        },
        url: "php/php_ics.php",
        success: function(data){
            if(iss != "IAR"){
                $("#img_iss").attr("src", "../../archives/"+iss+"/"+iss_number.substring(0,4)+"/"+rb+"/"+data);
            }else{
                $("#img_iss").attr("src", "../../archives/"+iss+"/"+rb+"/"+data);
            }
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
        url: '../php/upload_iss.php?files&iss_number='+iss_numbers+'&table='+tables+'&field='+fields+'&iss='+isss+'&iss_field='+iss_fields+'&rb='+rbs,
        type: 'POST',
        data: data,
        cache: false,
        processData: false,
        contentType: false,
        success: function(data){
            if(isss != "IAR"){
                $("#img_iss").attr("src", "../../archives/"+isss+"/"+iss_numbers.substring(0,4)+"/"+rbs+"/"+data);
            }else{
                $("#img_iss").attr("src", "../../archives/"+isss+"/"+rbs+"/"+data);
            }
        }
    });
}

function edit_quantity(id,quantity,po_number,item,description, table, field){
    //alert(id+" - "+quantity+" - "+po_number+" - "+item+" - "+description);
    var new_quantity = prompt("Enter new quantity:", quantity);
    $.ajax({
        type: "POST",
        data: {
                call_func: "update_quantity",
                item: item,
                description: description,
                po_number: po_number,
                quantity: quantity,
                new_quantity: new_quantity,
                table: table,
                field: field,
                iss_id: id
            },
        url: "php/php_ics.php",
        success: function(data){
            if(data == "1"){
                swal("Updated!", "Quantity and remaining stocks updated successfully.", "success");
                setTimeout(function () {
                    location.reload();
                  }, 1500);
            }else{
                swal("Invalid!", "Remaining stocks cannot be negative.", "warning");
            }
        }
    })
}