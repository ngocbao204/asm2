<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listProduct = Product::query()->get();

        return view('admin.product.listProduct', compact('listProduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = DB::table('categories')->get();
        return view('admin.product.createProduct', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $url = Storage::put('product', $request->file('image'));
        } else {
            $url = "";
        }
        DB::table('Products')->insert([
            'name_product' => $request->name,
            'price_new' => $request->price_new,
            'price_old' => $request->price_old,
            'image' => $url,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'status' => $request->status
        ]);
        return redirect()->route('Product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DB::table('categories')->get();
        $model =  DB::table('products')->where('id', $id)->first();
        return view('admin.product.editProduct', compact('model', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->hasFile('image')) {
            $url = Storage::put('product', $request->file('image'));
        } else {
            $url = "";
        }
        $model =  DB::table('products')->where('id', $id)->first();
        $img = $model->image;
        // dd($img);
        DB::table('Products')->where('id', $id)->update([
            'name_product' => $request->name,
            'price_new' => $request->price_new,
            'price_old' => $request->price_old,
            'image' => $img,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'status' => $request->status
        ]);
        return redirect()->route('Product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_Product)
    {
        DB::table('products')->where('id', $id_Product)->delete();
        return back();
    }
}
