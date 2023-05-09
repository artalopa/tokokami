<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $title = 'Produk';

        // mengambil data dari tabel produks
        $produk = DB::table('kategoris')->join('produks', 'kategoris.id', '=', 'produks.kategori_id')->get();
        $kategori = Kategori::all();  

        // mengirim data ke view admin->produk
        return view('admin.produk', ['dataProduk' => $produk, 'dataKategori' => $kategori, 'title' => $title]);
    }

    public function store(Request $request)
    {
        // simpan file gambar ke folder storage
        $fileGambar = $request->file('gambar')->store('uploads');

        // insert data ke tabel produks
        $produk = new Produk;
        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;
        $produk->gambar = $fileGambar;
        $produk->kategori_id = $request->kategori_id;
        $produk->save();

        // alihkan halaman ke halaman produk
        return redirect('/admin/produk');
    }

    public function update(Request $request)
    {
        $produk = Produk::where('id', $request->id)->first();
      
        if($request->file('gambar')) {
          $fileGambar = $request->file('gambar')->store('uploads');
        
          $produk->gambar = $fileGambar;
        }
      
        // update data tabel produks
        $produk->nama_produk = $request->nama_produk;
        $produk->deskripsi = $request->deskripsi;
        $produk->harga = $request->harga;
        $produk->kategori_id = $request->kategori_id;
        $produk->save();

        // alihkan halaman ke halaman produk
        return redirect('/admin/produk');
    }

    public function delete(Request $request)
    {
        // hapus data tabel produks
        Produk::where('id', $request->id)->delete();

        // alihkan halaman ke halaman produk
        return redirect('/admin/produk');
    }
}
