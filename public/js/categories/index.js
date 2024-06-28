$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });


    //data via jajira data table 
    var table = $(".data-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: indexUrl,
            type: 'GET'
        },
        columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex" },
            { data: "name", name: "name" },
            { data: "type", name: "type" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],



    });
    //end  data via jajira data table 




    //name changing jquery
    $('#modal-title').html('Create Category');
    $('#saveBtn').html('Save Category');
    //name end changing jquery


    //add new category
    var formElement = $('#categoriesAdd')[0];
    $('#saveBtn').click(function () {
        var formData = new FormData(formElement);
        // Clear previous error messages
        // $('#nameError').text('');
        // $('#typeError').text('');
        $('.error-messages').html('');

        // // Debugging: Iterate over the formData entries
        // for (var pair of formData.entries()) {
        //     console.log(pair[0] + ': ' + pair[1]);
        // }

        $.ajax({
            url: storeUrl, // Ensure this route exists in your web.php
            method: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            success: function (response) {
                $('#categoriesAdd')[0].reset();
                $('.categoriesModal').modal('hide');
                $('.data-table').DataTable().ajax.reload(function () {
                    // Set a timeout to reload the entire page after a delay (e.g., 2 seconds)
                    setTimeout(function () {
                        location.reload();
                    }, 2000); // 2000 milliseconds = 2 seconds
                });

                if (response) {
                    swal("success", response.message, "success");
                }
                // Reload the DataTable

            },
            error: function (xhr, status, error) {
                if (xhr.responseJSON) {
                    var errors = xhr.responseJSON.errors;

                    if (errors && errors.name) {
                        $('#nameError').text(errors.name[0]);
                    }

                    if (errors && errors.type) {
                        $('#typeError').text(errors.type[0]);
                    }
                }
                // Handle error response
            }
        });
    });


});
