@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <a href="{{ route("create") }}" class="btn btn-primary mb-2">Tambah Buku</a>
      <table class="table">
        <tr>
          <td>NO</td>
          <td>Judul</td>
          <td>Author</td>
          <td>Description</td>
          <td>Action</td>
        </tr>

        @php
            $no=1
        @endphp
        @foreach ($books as $book)
            <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $book->judul }}</td>
              <td>{{ $book->author }}</td>
              <td>{{ $book->desc }}</td>
              <td>
                <a href="{{ route('edit', $book->_id) }}" class="btn btn-success">Update</a>
                <form action="{{ route('destroy', $book->_id) }}" method="POST">
                  @csrf
                  @method("delete")
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              </td>
            </tr>
        @endforeach
      </table>
    </div>
  </div>
@endsection
