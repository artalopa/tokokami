<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $product, $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Produk';
        $products = $this->product->getAllProduct();
        $categories = $this->category->getAllCategory();
        return view('admin.product.index', compact(['products', 'categories', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('storage/uploads'), $imageName);
        } else {
            $imageName = null;
        }

        $this->product->createProduct($request->all(), $imageName);

        return redirect(route('products.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $prod, $product)
    {
        if ($request->file('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $imageName = time() . '.' . $request->image->extension();

            // simpan gambar baru
            $request->image->move(public_path('storage/uploads'), $imageName);

            // hapus gambar llama
            $oldImageName = $prod->getProduct($product)->image;
            if (Storage::disk('public')->exists('uploads/' . $oldImageName)) {
                Storage::disk('public')->delete('uploads/' . $oldImageName);
            }
        } else {
            $imageName = $request->currentImage;
        }

        $prod->updateProduct($request->all(), $imageName);

        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $imageName = $this->product->getProduct($product)->image;
        // dd(Storage::disk('public')->delete('uploads/' . $imageName));

        $this->product->deleteProduct($product);

        if (Storage::disk('public')->exists('uploads/' . $imageName)) {
            Storage::disk('public')->delete('uploads/' . $imageName);
        }

        return redirect(route('products.index'));
    }
}
