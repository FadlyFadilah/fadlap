@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col">
                        <h2>Alamat Pengiriman</h2>
                        <p>{{ $order->shipping_address }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h2>Kode Pos</h2>
                        <p>{{ $order->zip_code }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h2>Harga Total</h2>
                        <p>{{ $order->total_harga }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col">
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="width: 50%">Product</th>
                            <th style="width: 10%">Harga</th>
                            <th style="width: 8%">Quantity</th>
                            <th style="width: 22%" class="text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $order)
                            <tr>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-3 hidden-xs"><img src="{{ route('products.img', $order->product->img) }}" width="100" height="100" class="img-responsive"></div>
                                        <div class="col-sm-9">
                                            <a class="text-dark" href="{{ route('products.show', $order->product->id) }}">
                                                <h4 class="nomargin">{{ $order->product->name }}</h4>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td data-th="Harga">
                                    {{ $order->harga }}
                                </td>
                                <td data-th="Quantity">
                                    {{ $order->quantity }}
                                </td>
                                <td data-th="Subtotal" class="text-center">
                                    {{ $order->harga * $order->quantity }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection