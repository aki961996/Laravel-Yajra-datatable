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
            { data: "id", name: "id" },
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
    //end  data via yajira data table 

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



    //edit button code 
    // Event delegation
    $(document).on('click', '.editCategory', function () {


        var id = $(this).data('id');

        // AJAX request to fetch category details
        $.ajax({
            url: '/categories/' + id + '/edit',
            type: 'GET',
            success: function (data) {

                var response = {
                    id: data.id, // Replace with actual id value
                    name: data.name, // Replace with actual name value
                    type: data.type    // Replace with actual type value
                };

                // Populate the form fields with the fetched data
                $('.categoriesModal').modal('show');
                $('#modal-title').html('Edit Category');
                $('#saveBtn').html('Update Category');
                $('#categoryId').val(response.id);
                $('#categoryName').val(response.name);


                // Append the new option to the select box
                // var newOption = $('<option selected ></option>').val(response.id).text(response.type);
                // $('#categoryType').append(newOption);

                // // Set the selected value of the select box
                // $('#categoryType').val(response.id);

                $('#categoryType').empty().append('<option selected value= "' + response.id + '"> ' + response.type + '</option> ').selectmenu('refresh');





            },
            error: function (xhr, status, error) {

            }
        });
    });



});
