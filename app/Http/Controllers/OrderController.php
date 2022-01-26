<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', '=', Auth::user()->id)->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order) {
            return view('admin.orders.show', compact('order'));
        } else {
            return redirect('admin.orders')->with('errors', 'Order tidak ditemukan');
        }
    }

    public function create()
    {
        $cart = session()->get('cart');
        if ($cart) {
            return view('admin.orders.create');
        } else {
            return redirect('/')->with('seccess', 'Anda harus belanja terlebih dahulu!');
        }
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'shipping_address' => 'required',
            'zip_code' => 'required'
        ]);

        $cart = session()->get('cart');
        $total_harga = 0;
        foreach ($cart as $id => $product) {
            $total_harga += $product['harga'] * $product['quantity'];
        }

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->status = 'PENDING';
        $order->shipping_address = $request->post('shipping_address');
        $order->zip_code = $request->post('zip_code');
        $order->total_harga = $total_harga;
        $order->save();

        foreach ($cart as $id => $product) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $id;
            $orderItem->quantity = $product['quantity'];
            $orderItem->harga = $product['harga'];
            $orderItem->save();
        }

        session()->forget('cart');

        return redirect('admin/orders/' . $order->id)->with('success', 'Order berhasil di simpan');
    }
}
