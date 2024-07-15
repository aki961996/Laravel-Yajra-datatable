<!DOCTYPE html>
<html>

<head>
    <title>View Data</title>
</head>

<body>
    <h1>Fetched json Data</h1>
    @if(!empty($jsonData))
    <ul>
        @foreach($jsonData as $data)
        <li>
            <strong>Name:</strong> {{ $data['name'] }}<br>
            <strong>Image:</strong><br><img src="{{ asset('images/'.$data['image']) }}" alt="{{ $data['name'] }}"
                width="100">
        </li>
        @endforeach
    </ul>
    @else
    <p>No data found.</p>
    @endif
</body>

</html>