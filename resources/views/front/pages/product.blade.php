@extends('front.layout.front')

@section('content')

    <div class="col-12">
        <!-- Main Content -->
        <main class="row">
            <div class="col-12 bg-white py-3 my-3">
                <div class="row">

                    <!-- Product Images -->
                    <div class="col-lg-5 col-md-12 mb-3">
                        <div class="col-12 mb-3">
                            <div class="img-large border" style="background-image: url('{{ url('images/'.$product->thumbnail) }}')"></div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                @foreach($product->images as $image)
                                    <div class="col-sm-2 col-3">
                                        <div class="img-small border" style="background-image: url('{{ url('images/'.$image) }}')" data-src="{{ url('images/'.$image) }}"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Product Images -->

                    <!-- Product Info -->
                    <div class="col-lg-5 col-md-9">
                        <div class="col-12 product-name large">
                            {{ $product->name }}
                            <small>By <a href="{{ route('front.pages.brand', $product->brand_id) }}">{{ $product->brand->name }}</a></small>
                        </div>
                        <div class="col-12 px-0">
                            <hr>
                        </div>
                        <div class="col-12">
                            {{ $product->summary }}
                        </div>
                    </div>
                    <!-- Product Info -->

                    <!-- Sidebar -->
                    <div class="col-lg-2 col-md-3 text-center">
                        <div class="col-12 sidebar h-100">
                            <div class="row">

                                <div class="col-12">

                                        <span class="detail-price">
                                            Rs {{ number_format($product->price) }}
                                        </span>

                                    @if(!empty($product->discounted_price))
                                        <span class="detail-price-old">
                                            Rs {{ number_format($product->discounted_price) }}
                                    @endif
                                </div>
                                <div class="col-xl-5 col-md-9 col-sm-3 col-5 mx-auto mt-3">
                                    <div class="mb-3">
                                        <label for="qty">Quantity</label>
                                        <input type="number" id="qty" min="1" value="1" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-outline-dark" type="button"><i class="fas fa-cart-plus me-2"></i>Add to cart</button>
                                </div>
                                <div class="col-12 mt-3">
                                    <button class="btn btn-outline-secondary btn-sm" type="button"><i class="fas fa-heart me-2"></i>Add to wishlist</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar -->

                </div>
            </div>

            <div class="col-12 mb-3 py-3 bg-white text-justify">
                <div class="row">

                    <!-- Details -->
                    <div class="col-md-7">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 text-uppercase">
                                    <h2><u>Details</u></h2>
                                </div>
                                <div class="col-12" id="details">
                                    {{ $product->details }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Details -->

                    <!-- Ratings & Reviews -->
                    <div class="col-md-5">
                        <div class="col-12 px-md-4 sidebar h-100">

                            <!-- Rating -->
                            <div class="row">
                                <div class="col-12 mt-md-0 mt-3 text-uppercase">
                                    <h2><u>Ratings & Reviews</u></h2>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-4 text-center">
                                            <div class="row">
                                                <div class="col-12 average-rating">
                                                    {{ round($reviews->avg('rating'), 1) }}
                                                </div>
                                                <div class="col-12">
                                                    of {{ $reviews->count() }} reviews
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <ul class="rating-list mt-3">
                                                @for($i = 5; $i >= 1; $i-- )
                                                    @php
                                                        if($reviews->count() > 0){
                                                            $value = round($reviews->where('rating', $i)->count()/$reviews->count() * 100, 2);
                                                        }else{
                                                            $value = 0;
                                                        }
                                                    @endphp
                                                    <li>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-dark" role="progressbar" style="width: 45%;" aria-valuenow="{{ $value }}" aria-valuemin="0" aria-valuemax="100">{{ $value }}%</div>
                                                        </div>
                                                        <div class="rating-progress-label">
                                                            {{ $i }}<i class="fas fa-star ms-1"></i>
                                                        </div>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Rating -->

                            <div class="row">
                                <div class="col-12 px-md-3 px-0">
                                    <hr>
                                </div>
                            </div>

                            <!-- Add Review -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>Add Review</h4>
                                </div>
                                <div class="col-12">
                                    @auth()
                                        <form action="{{ route('front.pages.comment', $product->id) }}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <textarea name="comment" id="comment" class="form-control" placeholder="Give your review"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <div class="d-flex ratings justify-content-end flex-row-reverse">
                                                    <input type="radio" value="5" name="rating" id="rating-5"><label
                                                        for="rating-5"></label>
                                                    <input type="radio" value="4" name="rating" id="rating-4"><label
                                                        for="rating-4"></label>
                                                    <input type="radio" value="3" name="rating" id="rating-3"><label
                                                        for="rating-3"></label>
                                                    <input type="radio" value="2" name="rating" id="rating-2"><label
                                                        for="rating-2"></label>
                                                    <input type="radio" value="1" name="rating" id="rating-1" checked><label
                                                        for="rating-1"></label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button class="btn btn-outline-dark">Add Review</button>
                                            </div>
                                        </form>
                                    @else
                                        <div class="col-12 text-justify py-2 px-3 mb-3 bg-gray">
                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    Please <a href="{{ route('login') }}"> login </a> to add a review.
                                                </div>
                                            </div>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                            <!-- Add Review -->

                            <div class="row">
                                <div class="col-12 px-md-3 px-0">
                                    <hr>
                                </div>
                            </div>

                            <!-- Review -->
                            <div class="row">
                                <div class="col-12">
                                    @if($reviews->isNotEmpty())
                                        @foreach($reviews as $review)
                                            <!-- Comments -->
                                            <div class="col-12 text-justify py-2 px-3 mb-3 bg-gray">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <strong class="me-2">{{ $review->user->name }}</strong>
                                                        <small>
                                                            @for($i = 1; $i<=5; $i++)
                                                                <i class="{{ $i <= $review->rating ? 'fas' : 'far' }} fa-star"></i>
                                                            @endfor
                                                        </small>
                                                    </div>
                                                    <div class="col-12">
                                                       {{ $review->comment }}
                                                    </div>
                                                    <div class="col-12">
                                                        <small>
                                                            <i class="fas fa-clock me-2"></i>{{ $review->review_time }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Comments -->
                                        @endforeach
                                    @else
                                        <div class="col-12 text-center py-2 px-3 mb-3 bg-gray">
                                            No review given for this product.
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <!-- Review -->

                        </div>
                    </div>
                    <!-- Ratings & Reviews -->

                </div>
            </div>

            <!-- Similar Product -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 py-3">
                        <div class="row">
                            <div class="col-12 text-center text-uppercase">
                                <h2>Similar Products</h2>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($similarProducts as $similarproduct)
                                <!-- Product -->
                                <div class="col-lg-3 col-sm-6 my-3">
                                    <div class="col-12 bg-white text-center h-100 product-item">
                                        <div class="row h-100">
                                            <div class="col-12 p-0 mb-3">
                                                <a href="{{ route('front.pages.product', $similarproduct->id) }}">
                                                    <img src="{{ url('images/'.$similarproduct->thumbnail) }}" class="img-fluid">
                                                </a>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <a href="{{ route('front.pages.product', $similarproduct->id) }}" class="product-name">{{ $similarproduct->name }}</a>
                                            </div>
                                            <div class="col-12 mb-3">
                                                @if(!empty($similarproduct->discounted_price))
                                                    <span class="product-price-old">
                                                        Rs {{ number_format($similarproduct->discounted_price) }}
                                                    </span>
                                                @endif
                                                <span class="product-price">
                                                        Rs {{ number_format($similarproduct->price) }}
                                                    </span>
                                            </div>
                                            <div class="col-12 mb-3 align-self-end">
                                                <button class="btn btn-outline-dark" type="button"><i class="fas fa-cart-plus me-2"></i>Add to cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Similar Products -->

        </main>
        <!-- Main Content -->
    </div>

@endsection
