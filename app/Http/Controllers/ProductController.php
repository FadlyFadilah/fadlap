<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $productInstance = new Product();
        $products = $productInstance->orderProducts(request('order_by'));
        if ($request->ajax()) {
            return response()->json($products, 200);
        }
        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        if ($product) {
            $reviews = $product->productReviews()->get();
            $star = $reviews->avg('rating');
            return view('products.show', [
                'product' => $product,
                'reviews' => $reviews,
                'star' => $star,
            ]);
        } else {
            return redirect('/products')->with('error', 'Product tidak ditemukan!');
        }
    }

    public function image($image)
    {
        $filePath = storage_path(env('PATH_IMAGE') . $image);
        return Image::make($filePath)->response();
    }
}
