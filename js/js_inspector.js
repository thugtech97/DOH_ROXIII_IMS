var _url = "";

$(document).on('click', '.page-link', function(){
    var page = $(this).data('page_number');
    var query = $('#search_box').val();
    get_records(page, _url, query);
});

$('#search_box').keyup(function(){
    var query = $('#search_box').val();
    get_records(1, _url, query);
});

function get_records(page, url, query = ""){
    var arr = ["<div class=\"sk-spinner sk-spinner-wave\"><div class=\"sk-rect1\"></div>&nbsp;<div class=\"sk-rect2\"></div>&nbsp;<div class=\"sk-rect3\"></div>&nbsp;<div class=\"sk-rect4\"></div>&nbsp;<div class=\"sk-rect5\"></div></div>", "<div class=\"sk-spinner sk-spinner-rotating-plane\"></div>", "<div class=\"sk-spinner sk-spinner-double-bounce\"><div class=\"sk-double-bounce1\"></div><div class=\"sk-double-bounce2\"></div></div>", "<div class=\"sk-spinner sk-spinner-wandering-cubes\"><div class=\"sk-cube1\"></div><div class=\"sk-cube2\"></div></div>", "<div class=\"sk-spinner sk-spinner-pulse\"></div>", "<div class=\"sk-spinner sk-spinner-chasing-dots\"><div class=\"sk-dot1\"></div><div class=\"sk-dot2\"></div></div>", "<div class=\"sk-spinner sk-spinner-three-bounce\"><div class=\"sk-bounce1\"></div><div class=\"sk-bounce2\"></div><div class=\"sk-bounce3\"></div></div>", "<div class=\"sk-spinner sk-spinner-circle\"><div class=\"sk-circle1 sk-circle\"></div><div class=\"sk-circle2 sk-circle\"></div><div class=\"sk-circle3 sk-circle\"></div><div class=\"sk-circle4 sk-circle\"></div><div class=\"sk-circle5 sk-circle\"></div><div class=\"sk-circle6 sk-circle\"></div><div class=\"sk-circle7 sk-circle\"></div><div class=\"sk-circle8 sk-circle\"></div><div class=\"sk-circle9 sk-circle\"></div><div class=\"sk-circle10 sk-circle\"></div><div class=\"sk-circle11 sk-circle\"></div><div class=\"sk-circle12 sk-circle\"></div></div>", "<div class=\"sk-spinner sk-spinner-cube-grid\"><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div><div class=\"sk-cube\"></div></div>", "<div class=\"sk-spinner sk-spinner-fading-circle\"><div class=\"sk-circle1 sk-circle\"></div><div class=\"sk-circle2 sk-circle\"></div><div class=\"sk-circle3 sk-circle\"></div><div class=\"sk-circle4 sk-circle\"></div><div class=\"sk-circle5 sk-circle\"></div><div class=\"sk-circle6 sk-circle\"></div><div class=\"sk-circle7 sk-circle\"></div><div class=\"sk-circle8 sk-circle\"></div><div class=\"sk-circle9 sk-circle\"></div><div class=\"sk-circle10 sk-circle\"></div><div class=\"sk-circle11 sk-circle\"></div><div class=\"sk-circle12 sk-circle\"></div></div>"];
    $('#dynamic_content').html(arr[Math.floor(Math.random() * arr.length)]+"<br>");
    $.ajax({
        type: "POST",
        cache: true,
        data: {call_func: "get_groups", page: page, search: query},
        url: url,
        success: function(data){
            $('#dynamic_content').html(data);
        }
    });
}

function set_url(url){
    _url = url;
    get_records(1, _url);
}

function edit_group(id, group_name, data_members) {
    $("#group_id").val(id);
    $("#egroup_name").val(group_name);
    $("#einspectors_table_body").empty();

    data_members.forEach(function(member) {
        const newRow = `
            <tr>
                <td class="d-none" style="width: 5%;"><input type="text" class="form-control" name="id[]" value="${member.id}"></td>
                <td style="width: 45%;"><input type="text" class="form-control" name="inspector_name[]" value="${member.name}" required></td>
                <td style="width: 40%;">
                    <select class="form-control" name="designation[]" required>
                        <option value="">Select Designation</option>
                        <option value="Chairperson" ${member.designation === 'Chairperson' ? 'selected' : ''}>Chairperson</option>
                        <option value="Vice Chairperson" ${member.designation === 'Vice Chairperson' ? 'selected' : ''}>Vice Chairperson</option>
                        <option value="Member" ${member.designation === 'Member' ? 'selected' : ''}>Member</option>
                    </select>
                </td>
                <td style="width: 10%;"><button type="button" class="btn btn-danger btn-xs" onclick="eremoveInspectorRow(this)"><i class="fa fa-trash"></i></button></td>
            </tr>`;
        $("#einspectors_table_body").append(newRow);
    });

    $("#edit_group").modal();
}


$('#submit_group').on('submit', function(event) {
    event.preventDefault();

    const inspectorRows = $('#inspectors_table_body').find('tr').length;

    if (inspectorRows === 0) {
        swal("Error!", "Please add at least one inspector before saving.", "error");
        return; 
    }

    let formData = $(this).serialize();
    formData += `&${encodeURIComponent('call_func')}=${encodeURIComponent('insert_group')}`;

    console.log("Serialized Form Data:", formData);

    $.ajax({
        url: _url,
        type: 'POST',
        data: formData,
        success: function(response) {
            swal("Inserted!", "Saved successfully to the database.", "success");
            setTimeout(function () {
                location.reload();
            }, 1500);
        },
        error: function(xhr, status, error) {
            swal("Error saving group!", error, "error");
        }
    });
});

$('#save_group').on('submit', function(event) {
    event.preventDefault();

    const inspectorRows = $('#einspectors_table_body').find('tr').length;

    if (inspectorRows === 0) {
        swal("Error!", "Please add at least one inspector before saving.", "error");
        return; 
    }

    let formData = $(this).serialize();
    formData += `&${encodeURIComponent('call_func')}=${encodeURIComponent('save_group')}`;

    console.log("Serialized Form Data:", formData);

    $.ajax({
        url: _url,
        type: 'POST',
        data: formData,
        success: function(response) {
            swal("Updated!", "Inspectorate group updated successfully.", "success");
            setTimeout(function () {
                location.reload();
            }, 1500);
        },
        error: function(xhr, status, error) {
            swal("Error updating group!", error, "error");
        }
    });
});