<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productInstance = new Product();
        $products = $productInstance->orderProducts(request('order_by'));
        if ($request->ajax()) {
            return response()->json($products, 200);
        }
        return view('admin.products.index', compact('products'));
    }

    public function viewImages($fileImage)
    {
        $filePath = storage_path(env('PATH_IMAGE') . $fileImage);
        return Image::make($filePath)->response();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->all();
        $file = $request->file('img');
        $ext = $file->getClientOriginalExtension();

        $dateTime = date('Ymd_his');
        $newName = 'image_' . $dateTime . '.' . $ext;

        $file->move(storage_path(env('PATH_IMAGE')), $newName);
        $attr['img'] = $newName;

        $product = auth()->user()->products()->create($attr);

        return redirect('admin/products')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ($file = request()->file('img')) {
            $ext = $file->getClientOriginalExtension();

            $dateTime = date('Ymd_his');
            $new = 'image_' . $dateTime . '.' . $ext;

            $file->move(storage_path(env('PATH_IMAGE')), $new);
        } else {
            $new = $product->img;
        }

        $attr = $request->all();
        $attr['img'] = $new;

        $product->update($attr);

        return redirect('admin/products')->with('success', 'Produk berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('admin/products')->with('success', 'Produk berhasil di hapus');
    }
}
