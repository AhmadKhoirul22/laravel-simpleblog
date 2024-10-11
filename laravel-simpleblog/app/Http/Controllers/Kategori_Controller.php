<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class Kategori_Controller extends Controller
{
    public function index(){
        $kategori = Kategori::all();
        return view('kategori',[
            'title' => 'Kategori',
            'kategori' => $kategori
        ]);
    }
    public function store(Request $request){
        $validasi = request()->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        if($validasi == false){
            return redirect()->back()->withErrors($validasi)->withInput();
        }
        $kategori = new Kategori();
        $kategori->nama_kategori = $request->input('nama_kategori');

        $kategori->save();

        return redirect()->route('kategori')->with('notifikasi', 'Kategori berhasil ditambahkan.');
    }

    public function destroy($id){
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect()->route('kategori')->with('notifikasi', 'Kategori berhasil dihapus.');
    }
    public function update(Request $request, $id) {
        $validasi = request()->validate([
            'nama_kategori' => 'required|string|max:255' . $id,
        ]);

        if($validasi == false){
            return redirect()->back()->withErrors($validasi)->withInput();
        }

        // Jika validasi berhasil, lanjutkan dengan update
        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $request->input('nama_kategori');

        $kategori->save();

        return redirect()->route('kategori')->with('notifikasi', 'Kategori berhasil diupdate.');
    }
}
