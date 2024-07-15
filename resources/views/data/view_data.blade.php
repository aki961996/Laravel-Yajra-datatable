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



    <script src="{{asset('js/categories/validation.js')}}"></script>

    {{--
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script> --}}
</head>

<body>
    <div class="container mt-5">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <h1 style="color: #fff">Fetched JSON Data</h1>
        @if(!empty($jsonData))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jsonData as $data)
                <tr>
                    <td>{{ $data['name'] }}</td>
                    <td><img src="{{ asset('images/'.$data['image']) }}" alt="{{ $data['name'] }}" width="100"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>No data found.</p>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>

</html>