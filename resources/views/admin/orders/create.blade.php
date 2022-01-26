@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h2>Menambahkan Alamat</h2>
                <br />

                @if (count($errors))
                    <div class="from-group">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <br />

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="shipping_address">Alamat Pengiriman</label>
                        <input type="text" class="form-control" id="shipping_address" name="shipping_address" placeholder="Jl. Sirnarasa no.IV">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Alamat 2</label>
                        <input type="text" class="form-control" id="inputAddress2" placeholder="RT/RW 03/21">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputKota">Kota</label>
                            <input type="text" class="form-control" id="inputKota" >
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputProvince">Province</label>
                            <input type="text" class="form-control" id="inputProvince" >
                        </div>
                        <div class="form-group col-md-2">
                            <label for="zip_code">Kode Pos</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </form>
            </div>
        </div>
    </div>
@endsection