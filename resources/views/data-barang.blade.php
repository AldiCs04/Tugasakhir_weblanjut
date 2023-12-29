@extends('layout.app')
@section('content')
    <style>
        main {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            width: 100%;
            height: 100%;
            margin-top: 20px;
        }

        .card {
            background-color: springgreen;
            border-style: solid;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 50vh;
            height: 60vh;
            border-radius: 10px;
        }

        img {
            width: 200px;
            height: 200px;
            padding-top: 20px;
        }

        .namabarang {
            font-size: 25px;
            font-weight: bold;
            padding-top: 20px;
        }

        .harga {
            font-size: 20px;
            padding-top: 20px;
        }

        .btnaction {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        button {
            width: 10vw;
        }

        button a {
            color: black;
        }
    </style>
    @if (Session::has('sukses'))
    <div class="alert alert-success d-flex align-items-center" style="width: 50%; margin-left: 25%;" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
        <div>
            {{ Session::get('sukses') }}
        </div>
    </div>
    @endif
    @if (Session::has('fail'))
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
            {{ Session::get('fail') }}
        </div>
      </div>
    @endif
    <main>
        @foreach ($data as $data)
            <div class="card">
                <img src="{{ asset('foto_barang/' .$data->foto_barang) }}" alt="fotobrang">
                <p class="namabarang">{{ $data->nama_barang }}</p>
                <p class="harga">RP. {{ $data->harga_barang }}</p>
                <div class="btnaction">
                    <a href="/update-barang/{{ $data->id_barang }}"><button>Edit</button></a>
                    <a href="/barang/hapus/{{ $data->id_barang }}"><button>Delete</button></a>
                </div>
            </div>
        @endforeach
    </main>
@endsection
