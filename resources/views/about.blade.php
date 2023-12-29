<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>
</head>
<body>
    @extends('layout/app')
    @section('content')
    <h1>Nama : {{ $nama }}</h1>
    <h1>Nim : {{ $nim }}</h1>
    @endsection
</body>
</html>