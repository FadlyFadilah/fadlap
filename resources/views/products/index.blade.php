@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex mt-4">


            <div class="col-md-3">
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

            <div id="product-list" class="col-md">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-3">
                            <div class="card mb-3">
                                <img src="{{ route('products.img', $product->img) }}" class="card-img-top">
                                <div class="card-body">
                                    <div class="card-title">
                                        <a class="text-dark"
                                            href="{{ route('products.show', $product->id) }}">{{ Str::limit($product->name, 30) }}</a>
                                    </div>
                                    <div>
                                        Rp. {{ $product->harga }}
                                    </div>

                                    <a href="{{ route('carts.add', $product->id) }}" class="btn btn-primary">Beli</a>
                                </div>
                            </div>

                        </div>
                    @endforeach
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
                            if (idx == 0 || idx % 4 == 0) {
                                products += '<div class = "row">'
                            }

                            products += '<div class="col-md-3">' +
                                '<div class="card mb-3">' +
                                '<img src="/product/img/' + product.img +
                                '" class="card-img-top">' +
                                '<div class="card-body">' +
                                '<div class="card-title">' +
                                '<a class="text-dark" href="/products/' + product.id +
                                '">' +
                                product.name +
                                '</a>' +
                                '</div>' +
                                '<div>' +
                                product.harga +
                                '</div>' +

                                '<a href="/carts/add/' + product.id +
                                '" class="btn btn-primary">Beli</a>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            if (idx > 0 && idx % 4 == 3) {
                                products += '</div>';
                            }
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
