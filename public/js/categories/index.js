$(document).ready(function () {

    //header need csrf token laravel
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    // end header need csrf token laravel



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
                data: 'action',
                name: 'action',
                orderable: true,
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

        $('#saveBtn').attr('disabled', true);
        var formData = new FormData(formElement);
        // Clear previous error messages
        // $('#nameError').text('');
        // $('#typeError').text('');
        $('.error-messages').text('');
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
                table.draw();
                // $('#categoriesAdd')[0].reset();
                $('#saveBtn').attr('disabled', false);
                $('#categoryName').val('');
                $('#categoryType').val('');
                $('#category_id').val('');
                $('.categoriesModal').modal('hide');
                if (response) {
                    swal("success", response.message, "success");
                }

                // Reload the DataTable
            },
            error: function (xhr, status, error) {
                $('#saveBtn').attr('disabled', false);
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
    // end add new category

    //edit button code 
    // Event delegation
    $(document).on('click', '.editCategory', function () {

        var id = $(this).data('id');
        // AJAX request to fetch category details
        $.ajax({
            url: '/categories/' + id + '/edit',
            type: 'GET',
            success: function (data) {

                // Populate the form fields with the fetched data
                var response = {
                    id: data.id,
                    name: data.name,
                    type: data.type
                };
                // Populate the form fields with the fetched data
                $('.categoriesModal').modal('show');
                $('#modal-title').html('Edit Category');
                //values appending vai jquery  edit modal
                $('#saveBtn').html('Update Category');
                $('#category_id').val(response.id);
                $('#categoryName').val(response.name);
                var firstLetterCapitalName = capitalizeFirstLetter(response.type);
                $('#categoryType').empty().append('<option selected value= "' + response.type + '"> ' + firstLetterCapitalName + '</option> ');


            },
            error: function (xhr, status, error) {

            }
        });
    });
    // end edit  button code




    //delete function
    $(document).on('click', '.deleteCategory', function () {
        var id = $(this).data('id');
        $.ajax({
            url: '/categories/' + id + '/delete',
            type: 'POST',
            success: function (data) {

                if (data) {
                    swal("success", data.message, "success");
                }
                table.draw();

            },
            error: function (xhr, status, error) {

            }
        });

    });
    //delete  end function




    //view functinality
    $(document).on('click', '.viewCategory', function () {
        $('.categoriesViewModal').modal('show');
        $('#viewTitle').html('View Category');
        var id = $(this).data('id');
        $.ajax({
            url: '/categories/' + id + '/view',
            type: 'GET',
            success: function (data) {

                var response = {
                    id: data.id,
                    name: data.name,
                    type: data.type
                };
                // Populate the form fields with the fetched data

                $('#viewCategoryId').text(response.id);  //view category id
                $('#viewCategoryName').text(response.name);
                $('#viewCategoryType').text(response.name);
                var firstLetterCapitalName = capitalizeFirstLetter(response.type);
                $('#viewCategoryType').text(firstLetterCapitalName);

            },
            error: function (xhr, status, error) {

            }
        });
    });
    //view  end functinality

    //next button clicked time show trashed datas
    $(document).on('click', '#nextBtn', function () {
        $.ajax({
            url: '/categories/next_page',
            type: 'GET',
            success: function (data) {
                $('#viewTitle').html('OnlyTrashed Data View');
                if (data.success) {
                    // Assuming #rowContainer is the ID of the element where you want to append the HTML
                    $("#rowContainer").append(data.html);
                    $('#table_hide').hide();
                    $('#nextBtn').hide();

                } else {
                    console.error('Failed to fetch data');
                }
            },
            error: function (xhr, status, error) {

            }
        });
    })

    //end next button clicked time show trashed datas




    //additinal n
    $(document).on('click', '#addCategorie', function () {
        $('#modal-title').html('Create Category');
        $('#saveBtn').html('Save Category');
        $('.error-messages').text('');
    });

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);

    }



    $(document).on('click', '#closeBtn', function () {

        $('#categoryName').val('');
        $('#categoryType').val('');
        $('#category_id').val('');
        $('.categoriesModal').modal('hide');

    });

    $(document).on('click', '.btn-close', function () {
        $('#categoryName').val('');
        $('#categoryType').val('');
        $('#category_id').val('');
        $('.categoriesModal').modal('hide');
    });



    $(document).on('click', '.closeBtn_view', function () {
    });


    // Function to check input values and enable/disable the button
    // function checkInputValues() {
    //     let allInputsFilled = false;

    //     $('input').each(function () {
    //         if ($(this).val() !== '') {
    //             allInputsFilled = true;
    //             return false; // break out of the loop
    //         }
    //     });

    //     if (allInputsFilled) {
    //         $('#saveBtn').attr('disabled', true);
    //         $('#saveBtn').attr('disabled', false);
    //     } else {
    //         $('#saveBtn').attr('disabled', true);
    //         $('#saveBtn').attr('disabled', false);
    //     }
    // }

    // // Check input values on page load
    // checkInputValues();

    // // Check input values on input change
    // $('input').on('input', function () {
    //     checkInputValues();
    // });
    // Function to check input values and enable/disable the button




});
