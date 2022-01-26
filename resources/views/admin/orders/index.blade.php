@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h2>List Order</h2>
                <div>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Tambah Produk</a>
                </div>
                <br />

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <th>#</th>
                            <th>Harga Total</th>
                            <th>Status</th>
                            <th>Kode Pos</th>
                            <th>Alamat Pengiriman</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->total_harga }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->zip_code }}</td>
                                    <td>{{ $order->shipping_address }}</td>
                                    <td>
                                        <a href="{{ route('orders.show', $order->id) }}">Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection