@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ route('products.img', $product->img) }}" class="card-img-top">  
            </div>
            <div class="col-md-9">
                <h3>{{ $product->name }}</h3>
                <p>Total Rating <strong>{{ $star ? $star : '0' }}</strong></p>
                <h4>{{ $product->price }}</h4>
                <div class="mt-4">
                    <a href="{{ route('carts.add', $product->id) }}" class="btn btn-primary">Beli</a>
                </div>
                <div class="mt-3">
                    <p>Share Product</p>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('products.show', $product->id) }}"
                        class="social-button" target="_blank">
                        <i class="fab fa-facebook fa-2x"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text=my share text&amp;url={{ route('products.show', $product->id) }}"
                        class="social-button" target="_blank">
                        <i class="fab fa-twitter fa-2x"></i>
                    </a>
                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('products.show', $product->id) }}&amp;title=my share text&amp;summary=it is the linkedin summary "
                        class="social-button" target="_blank">
                        <i class="fab fa-linkedin fa-2x"></i>
                    </a>
                    <a href="https://wa.me/?text={{ route('products.show', $product->id) }}" class="social-button"
                        target="_blank">
                        <i class="fab fa-whatsapp fa-2x"></i>
                    </a>
                </div>
                <div class="mt-4">
                    <ul role="tablist" class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" role="tab" data-toggle="tab" href="#desc">Deskripsi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" role="tab" data-toggle="tab" href="#review">Review</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-1">
                        <div role="tabpanel" id="desc" class="tab-pane fade in active show">
                            {!! $product->desc !!}
                        </div>
                        <div role="tabpanel" id="review" class="tab-pane fade">
                            Product review

                            <div class="col">

                                <form action="{{ route('products.store', $product->id) }}" method="POST">
                                    @csrf
                                    <div class="rating">
                                        <input value="5" type="radio" name="rating" id="star1"><label for="star1"></label>
                                        <input value="4" type="radio" name="rating" id="star2"><label for="star2"></label>
                                        <input value="3" type="radio" name="rating" id="star3"><label for="star3"></label>
                                        <input value="2" type="radio" name="rating" id="star4"><label for="star4"></label>
                                        <input value="1" type="radio" name="rating" id="star5"><label for="star5"></label>
                                    </div>
                                    <textarea name="desc" id="desc"></textarea>
                                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                </form>

                                @foreach ($reviews as $review)
                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="text-center col-2">
                                                    <img src="{{ asset("user.png") }}" alt="">
                                                    <p class="mt-2">{{ $review->created_at->diffForHumans() }}</p>
                                                </div>
                                                <div class="col">
                                                    <p class="text-capitalize">{{ $review->user->name }}</p>
                                                    <p>{!! $review->desc !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{ asset("tinymce/js/tinymce/jquery.tinymce.min.js") }}"></script>
<script src="{{ asset("tinymce/js/tinymce/tinymce.min.js") }}"></script>
<script>
    tinymce.init({
        selector: 'textarea'
    });
</script>
@endsection