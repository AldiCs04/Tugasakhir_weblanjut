<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class barangcontroller extends Controller
{
    public function data()
    {
        $user = auth()->user();
        $data = DB::table('tani_store')->get();
        return view('data-barang', [
            'data' => $data,
            'name' => $user->name,
            'avatar' => $user->avatar,
        ]);

    }
    public function form(?int $id_barang = null)
    {
        $user = auth()->user();
        if ($id_barang) {
            $data = DB::table('tani_store')->where('id_barang', $id_barang)->first();
            return view('tambah-barang', [
                'data' => $data,
                'name' => $user->name,
                'avatar' => $user->avatar,
        ]);
        }
        return view('tambah-barang', [
            'data' => null,
            'name' => $user->name,
            'avatar' => $user->avatar,
    ]);
    }
    public function tambah(Request $request)
    {
        $user = auth()->user();
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
            $name = $user->name;
            $avatar = $user->avatar;
            // return redirect('/data-barang')->with('sukses', 'Data Berhasil Ditambahkan');
            return redirect()->route('data-barang', compact('name', 'avatar'))->with('sukses', 'Data Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('data-barang', compact('name', 'avatar'))->with('fail', 'Data Gagal Ditambahkan');
            // return redirect('/data-barang')->with('fail', 'Data Gagal Ditambahkan');
        }

    }
    public function edit(Request $request, $id_barang)
    {
        $user = auth()->user();
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

            $name = $user->name;
            $avatar = $user->avatar;
                // return redirect('/data-barang')->with(
                //     'success',
                //     'Data Berhasil Diperbarui'
                // );
                return redirect()->route('data-barang', compact('name', 'avatar'))->with('success', 'Data Berhasil Diperbarui');
            } else {
                return redirect()->back()->compact('name', 'avatar')->with('fail', 'Gagal update data');
            }
        }
    }
    public function delete($id_barang)
    {
        $user = auth()->user();
        $name = $user->name;
        $avatar = $user->avatar;
        DB::table('tani_store')->where('id_barang', $id_barang)->delete();
        return redirect('/data-barang')->with('status', 'Data Berhasil Dihapus');
    }
}
