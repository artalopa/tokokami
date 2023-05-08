<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        $title = 'Kategori';

        // mengambil data dari tabel produks
        // $produk = DB::table('kategoris')->join('produks', 'kategoris.id', '=', 'produks.kategori_id')->get();
        $kategori = DB::table('kategoris')->get();

        // mengirim data ke view admin->kategori
        return view('admin.kategori', ['dataKategori' => $kategori, 'title' => $title]);
    }

    public function store(Request $request)
    {
        // insert data ke tabel kategori
        DB::table('kategoris')->insert([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        // alihkan halaman ke halaman kategori
        return redirect('/admin/kategori');
    }

    public function update(Request $request)
    {
        // insert data ke tabel kategori
        DB::table('kategoris')->where('id', $request->id)->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        // alihkan halaman ke halaman kategori
        return redirect('/admin/kategori');
    }

    public function delete(Request $request)
    {
        // hapus data tabel kategoris
        DB::table('kategoris')->where('id', $request->id)->delete();

        // alihkan halaman ke halaman kategori
        return redirect('/admin/kategori');
    }
}
