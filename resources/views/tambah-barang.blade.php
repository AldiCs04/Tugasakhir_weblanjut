@extends('layout/app')
@section('content')
    @if (empty($data))
        <h1>Tambah Data Barang</h1>
        <form action="/barang/tambah" method="POST" enctype="multipart/form-data">
            @csrf
            <table>
                <tr>
                    <td><label for="id_barang">ID Barang</label></td>
                    <td><input type="number" name="id_barang" id="id" required></td>
                </tr>
                <tr>
                    <td><label for="nama_barang">Nama Barang</label></td>
                    <td><input type="text" name="nama_barang" id="nama_barang" required></td>
                </tr>
                <tr>
                    <td><label for="harga_barang">Harga Barang</label></td>
                    <td><input type="number" name="harga_barang" id="harga_barang" required></td>
                </tr>
                <tr>
                    <td><label for="foto_barang">Masukkan Foto Barang</label></td>
                    <td><input type="file" name="foto_barang" id="foto_barang" required></td>
                </tr>
                <tr colspan=2>
                    <td><button type="submit">Tambah Data</button></td>
                </tr>
            </table>
        </form>
    @else
        <h1>Update Data Barang</h1>
        <form action="/barang/edit/{{ $data->id_barang }}" method="POST" enctype="multipart/form-data">
            @csrf

            <table>
                <tr>
                    <td><label for="id_barang">Perbarui ID Barang</label></td>
                    <td><input type="number" name="id_barang" id="id" value="{{ $data->id_barang }}" required></td>
                </tr>
                <tr>
                    <td><label for="nama_barang">Perbarui Nama Barang</label></td>
                    <td><input type="text" name="nama_barang" id="nama_barang" value="{{ $data->nama_barang }}" required></td>
                </tr>
                <tr>
                    <td><label for="harga_barang">Perbarui Harga Barang</label></td>
                    <td><input type="text" name="harga_barang" id="harga_barang" value="{{ $data->harga_barang }}" required></td>
                </tr>
                <tr>
                    <td><label for="foto_barang">Perbarui Foto Barang</label></td>
                    <td><input type="file" name="foto_barang" id="foto_barang" required></td>
                    <img src="{{ asset('foto_barang/' .$data->foto_barang) }}" alt="fotobrang" width="150px">
                </tr>
                <tr colspan=2>
                    <td><button type="submit">Simpan Data</button></td>
                </tr>
            </table>
        </form>
        
    @endif
@endsection
