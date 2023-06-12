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

    public static function getAllCategory()
    {
        return self::all('id', 'name');
    }

    public static function getCategory($category)
    {
        return self::find($category);
    }

    public static function createCategory($data)
    {
        return self::create([
            'name' => $data['name'],
        ]);
    }

    public function updateCategory($data)
    {
        $this->name = $data['name'];
        $this->save();
    }

    public static function deleteCategory($category)
    {
        self::destroy($category);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
