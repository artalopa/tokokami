<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc'
    ];

    // tampilkan semua kategori
    public static function getAllCategory()
    {
        return self::all('id', 'name');
    }

    // cari kategori berdasarkan id
    public static function getCategory($category)
    {
        return self::find($category);
    }

    // buat kategori baru
    public static function createCategory($data)
    {
        return self::create([
            'name' => $data['name'],
        ]);
    }

    // update kategori
    public function updateCategory($data)
    {
        $this->name = $data['name'];
        $this->save();
    }

    // hapus kategori
    public static function deleteCategory($category)
    {
        self::destroy($category);
    }

    // relasi
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
