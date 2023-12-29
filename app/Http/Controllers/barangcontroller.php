<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class barangcontroller extends Controller
{
    public function data()
    {
        $data = DB::table('tani_store')->get();
        return view('data-barang', ['data' => $data]);

    }
    public function form(?int $id_barang = null)
    {
        if ($id_barang) {
            $data = DB::table('tani_store')->where('id_barang', $id_barang)->first();
            return view('tambah-barang', ['data' => $data]);
        }
        return view('tambah-barang', ['data' => null]);
    }
    public function tambah(Request $request)
    {
        try {
            // dd($request->all());
            $data = DB::table('tani_store')->insert([
                'id_barang' => $request->id_barang,
                'nama_barang' => $request->nama_barang,
                'harga_barang' => $request->harga_barang,
                'foto_barang' => $request->foto_barang,
            ]);
            if ($data) {
                if ($request->hasFile('foto_barang')) {
                    $request->file('foto_barang')->move('foto_barang/', $request->file('foto_barang')->getClientOriginalName());
                    DB::table('tani_store')
                        ->where('id_barang', $request->id_barang)
                        ->update(['foto_barang' => $request->file('foto_barang')->getClientOriginalName()]);
                }
            }

            return redirect('/data-barang')->with('sukses', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect('/data-barang')->with('fail', 'Data Gagal Ditambahkan');
        }

    }
    public function edit(Request $request, $id_barang)
    {
        $oldfotobarang = DB::table('tani_store')->where('id_barang', $id_barang)->value('foto_barang');
        $updated = DB::table('tani_store')->where('id_barang', $id_barang)->update([
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'foto_barang' => $request->foto_barang,
        ]);
        if ($updated) {
            // Jika pembaruan berhasil, tangani pengunggahan file
            if ($request->hasFile('foto_barang')) {
                // Hapus foto lama jika ada
                if (!empty($oldFoto)) {
                    $oldFotoPath = public_path('foto_barang/') .$oldFoto;
                    if (file_exists($oldFotoPath)) {
                        unlink($oldFotoPath);
                    }
                }
                if ($request->hasFile('foto_barang')) {
                    $request->file('foto_barang')->move('foto_barang/', $request->file('foto_barang')->getClientOriginalName());
                    // Perbarui kolom "foto" dengan nama file
                    DB::table('tani_store')
                        ->where('id_barang', $id_barang)
                        ->update(['foto_barang' => $request->file('foto_barang')->getClientOriginalName()]);
                }

                return redirect('/data-barang')->with(
                    'success',
                    'Data Berhasil Diperbarui'
                );
            } else {
                return redirect()->back()->with('fail', 'Gagal update data');
            }
        }
    }
    public function delete($id_barang)
    {
        DB::table('tani_store')->where('id_barang', $id_barang)->delete();
        return redirect('/data-barang')->with('status', 'Data Berhasil Dihapus');
    }
}
