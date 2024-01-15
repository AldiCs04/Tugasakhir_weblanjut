<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body>
       <h1>Halo,</h1>
       <h2>Nama : {{ $user->name }}</h2>
       <h2>Email : {{ $user->email }}</h2>
       <h2>Google ID : {{ $user->google_id }}</h2>
       <h2>Photo Profile</h2>
       <img src="{{ $user->avatar }}">
    </body>
</html>
