<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'gambar',
        'id_kategori',
    ];

    public function kategoris()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function pesanans()
    {
        return $this->belongsToMany(Pesanan::class);
    }
}
