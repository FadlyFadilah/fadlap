@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $product->name }}</h2>
        <img src="{{ url('admin/'.$product->img) }}" style="max-width: 100%;height: 300px;">
        <p class="text-secondary mt-2">Informasi</p>
        <div class="row">
            <div class="col-md-9">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                        <td>Harga</td>
                        <td>Rp. {{ $product->harga }}</td>
                        </tr>
                        <tr>
                        <td>Deskripsi</td>
                        <td>{!! $product->desc !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>    
@endsection