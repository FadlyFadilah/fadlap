@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col">
                <h2>Product</h2>
                <div class="d-flex align-items-center">
                    <div class="col-md-3">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Tambah Produk</a>
                    </div>
                    <div class="col-md-3 offset-6">
                        <div class="form-group">
                            <select name="order_field" id="order_field" class="form-control">
                                <option value="" disabled selected>Urutkan</option>
                                <option value="best_seller">Best Seller</option>
                                <option value="terbaik">Terbaik (Berdasarkan Rating)</option>
                                <option value="termurah">Termurah</option>
                                <option value="termahal">Termahal</option>
                                <option value="terbaru">Terbaru</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Name</td>
                                <td>Price</td>
                                <td>Created at</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody id="product-list">
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->harga }}</td>
                                    <td>{{ $product->created_at }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('admin.products.show', $product->id) }}"
                                            class="btn btn-primary btn-sm mr-2">Show</a>
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="btn btn-success btn-sm mr-2">Edit</a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
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
@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#order_field').change(function() {
                // window.location.href = '/?order_by=' + $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '/',
                    data: {
                        order_by: $(this).val(),
                    },
                    dataType: 'json',
                    success: function(data) {
                        var products = '';
                        $.each(data, function(idx, product) {

                            products += '<tr>' +
                                '<td>' + product.id + '</td>' +
                                '<td>' + product.name + '</td>' +
                                '<td>' + product.harga + '</td>' +
                                '<td>' + product.created_at + '</td>' +
                                '<td class="d-flex">' +
                                '<a href="/admin/products/show/' + product.id + '"' +
                                'class="btn btn-primary btn-sm mr-2">Show</a>' +
                                '<a href="/admin/products/edit/' + product.id + '"' +
                                'class="btn btn-success btn-sm mr-2">Edit</a>' +
                                '<form method="POST" action="/admin/products/delete/' +
                                product.id + '">' +
                                '@csrf' +
                                '@method("DELETE")' +
                                '<button type="submit" class="btn btn-sm btn-danger">Hapus</button>' +
                                '</form>'+
                                '</td>' +
                                '</tr>'
                        });

                        $('#product-list').html(products);
                    },
                    error: function(data) {
                        alert('Unable to handle request');
                    }
                });
            });
        });
    </script>
@endsection
