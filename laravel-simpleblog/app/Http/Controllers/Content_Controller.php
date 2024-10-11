<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Kategori;
use App\Models\Content;
// use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use League\Flysystem\UrlGeneration\PublicUrlGenerator;
class Content_Controller extends Controller{
    public function index(){
        $kategori = Kategori::all();
        $content = Content::all();
        return view('content',[
            'title' => 'Content',
            'kategori' => $kategori,
            'content' => $content
        ]);
    }
    // public function show($id){
    // $user = User::find($id);
    // return view('user.profile', compact('user'));
    // cara menggunakan function pada model
    // }
    public function store(Request $request){
        $validasi = request()->validate([
            'judul' => 'required|string|max:100',
            'keterangan' => 'required|string|max:200|min:5',
            'image' => 'required|image'
        ]);

        if(request()->has('image')){
            $imagePath = request()->file('image')->store('contents','public');
            $validasi['image'] = $imagePath;

            // Storage::disk('public')->delete($user->image ?? '');
        }
        $content = new Content();
        $content->judul = $request->input('judul');
        $content->keterangan = $request->input('keterangan');
        $content->id_kategori = $request->input('id_kategori');
        $content->image = $validasi['image'];
        $content->save();
        return redirect()->route('content')->with('notifikasi', 'Content berhasil ditambahkan.');
    }

    public function destroy($id){
        $content = Content::find($id);

        if ($content) {
            // Cek apakah image ada dan file fisiknya ada di storage
            if ($content->image && Storage::disk('public')->exists($content->image)) {
                // Hapus image dari storage
                Storage::disk('public')->delete($content->image);
            }

            // Hapus data dari database
            $content->delete();

            return redirect()->route('content')->with('notifikasi', 'Content dan gambar berhasil dihapus.');
        } else {
            return redirect()->route('content')->with('notifikasi', 'Content tidak ditemukan.');
        }
    }
    public function update(Request $request, $id){
    // Validasi input
    $validasi = request()->validate([
        'judul' => 'required|string|max:100',
        'keterangan' => 'required|string|max:200|min:5',
        'image' => 'sometimes|image', // Gambar hanya wajib jika diupload
    ]);

    // Cari content berdasarkan id
    $content = Content::find($id);

    if (!$content) {
        // !content = tidak content
        return redirect()->route('content')->with('notifikasi', 'Content tidak ditemukan.');
    }

    // Update data judul, keterangan, dan kategori
    $content->judul = $request->input('judul');
    $content->keterangan = $request->input('keterangan');
    $content->id_kategori = $request->input('id_kategori');

    // Jika ada gambar baru, ganti gambar lama
    if ($request->hasFile('image')) {
        // Hapus gambar lama dari storage
        if ($content->image && Storage::disk('public')->exists($content->image)) {
            Storage::disk('public')->delete($content->image);
        } else {
            // Upload gambar baru dan simpan path-nya
            $imagePath = $request->file('image')->store('contents', 'public');
            $content->image = $imagePath;
        }
    }
    // Simpan perubahan ke database
    $content->save();
    return redirect()->route('content')->with('notifikasi', 'Content berhasil diperbarui.');
    }
    public function konten(){
    // Mengurutkan konten berdasarkan tanggal terbaru
    $content = Content::orderByDesc('created_at');
    $kategori = Kategori::all();
    $title = 'Konten';

    // Memeriksa apakah ada query pencarian
    if (request()->has('search')) {
        $content = $content->where('judul', 'like', '%' . request()->get('search', '') . '%');
    }

    // Eksekusi query untuk mendapatkan data konten
    $content = $content->get();

    // Mengirim data ke view
    return view('aa', compact('content', 'kategori', 'title'));
}
    public function detail_konten(Request $request,$id){
        $content = Content::find($id);
        $kategori = Kategori::all();
        $title = 'Detail Konten';
        return view('detail_aa',compact('content','kategori','title'));
    }
}
