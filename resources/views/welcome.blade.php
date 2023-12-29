@extends('layout/app')
@section('content')
<style>
    main{
        display: flex;
    }
    .gambar{
        width: 100vw;
    }
</style>
    <main>
        <img class="gambar" src="{{ url('/img/tani.jpg') }}" alt="">
    </main>
@endsection
