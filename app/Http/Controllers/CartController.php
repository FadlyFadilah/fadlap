<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('carts.index');
    }

    public function add(Product $product)
    {
        if(!$product){
            abort(404);
        }
        
        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [
                $product['id'] => [
                    "name" => $product->name,
                    "quantity" => 1,
                    "harga" => $product->harga,
                    "img" => $product->img
                ]
            ];

            session()->put('cart', $cart);

            return redirect('/carts')->with('success', 'Product added to cart successfully');
        }

        if (isset($cart[$product['id']])) {
            $cart[$product['id']]['quantity']++;

            session()->put('cart', $cart);

            return redirect('/carts')->with('success', 'Product added to cart successfully');
        }

        $cart[$product['id']] = [
            "name" => $product->name,
            "quantity" => 1,
            "harga" => $product->harga,
            "img" => $product->img
        ];
        
        session()->put('cart', $cart);

        return redirect('/carts')->with('success', 'Product added to cart successfully');
    }

    public function update()
    {
        if (request('id') and request('quantity')) {
            $cart = session()->get('cart');
            
            $cart[request('id')]['quantity'] = request('quantity');

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove()
    {
        if (request('id')) {
            $cart = session()->get('cart');

            if (isset($cart[request('id')])) {
                
                unset($cart[request('id')]);

                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
