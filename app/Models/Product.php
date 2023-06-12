<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'desc',
        'image',
        'category_id'
    ];

    public function getAllProduct()
    {
        return $this->all();
    }

    public function getProduct($product)
    {
        return $this->find($product);
    }

    public function createProduct($data, $imageName)
    {
        // $this = new Product;
        $this->name = $data['name'];
        $this->desc = $data['desc'];
        $this->price = $data['price'];
        $this->image = $imageName;
        $this->category_id = $data['category_id'];
        $this->save();
    }

    public function updateProduct($data, $imageName)
    {
        $this->name = $data['name'];
        $this->desc = $data['desc'];
        $this->price = $data['price'];
        $this->image = $imageName;
        $this->category_id = $data['category_id'];
        $this->save();
    }

    public function deleteProduct($product)
    {
        return $this->destroy($product);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
