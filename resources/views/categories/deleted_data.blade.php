<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    @foreach ($deleted_data as $category)
    <div id="row{{ $category->id }}">
        <p>ID: {{ $category->id }}</p>
        <p>Name: {{ $category->name }}</p>
        <p>Deleted At: {{ $category->deleted_at }}</p>
    </div>
    @endforeach

</body>

</html>