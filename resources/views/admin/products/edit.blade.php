@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h2>Tambah Product</h2>
                <hr>

                <form action="{{ route('admin.products.update', $product->id) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Produk</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nama Produk" value="{{ $product->name }}">
                        @error('name')
                            <div class="mt-2 text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control" placeholder="Harga" value="{{ $product->harga }}">
                        @error('harga')
                            <div class="mt-2 text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="desc">Deskripsi</label>
                        <textarea name="desc" id="desc" class="form-control" placeholder="Deskripsi">{{ $product->desc }}</textarea>
                        @error('desc')
                            <div class="mt-2 text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mb-2 mt-2">
                        <label for="img">Image</label>
                        <input type="file" name="img" id="img" class="form-control-file">
                        @error('img')
                            <div class="mt-2 text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection