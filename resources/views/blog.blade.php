<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>   
<body>
    <h1>ini halaman blog</h1>
    <p>
        @foreach ($data as $item )
            {{$item['id']}} : {{$item['title']}} : {{$item ['description']}} <br>
        
        @endforeach
    </p>
</body>
</html>