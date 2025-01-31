<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{asset('css/index.css')}}" rel="stylesheet">

    {{--
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> --}}
</head>

<body>
    <!-- Modal -->
    @include('categories/addModal/categories_modal')
    {{-- model end --}}

    <!-- Modal -->
    @include('categories/viewModal/viewModal')
    {{-- model end --}}

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-3" style="margin-top: 100px">
                <div class="card-wrap">
                    <a href="javascript:void(0)" class="btn btn-dark mb-3" data-bs-toggle="modal"
                        data-bs-target="#categoriesModalAdd" id="addCategorie">Add
                        Categories</a>
                    <div class="comman-table table-responsive">
                        <table class="table table-bordered data-table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be populated by DataTables via AJAX -->
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>


        </div>
    </div>

    {{-- scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script>
        var storeUrl = '{{ route("categories.store") }}';
    </script>

    <script>
        var indexUrl = '{{ route("categories.index") }}';
    </script>

    {{-- <script>
        var editUrl = '{{ route("categories.edit") }}';
    </script> --}}


    <script src="{{asset('js/categories/index.js')}}"></script>
</body>

</html>