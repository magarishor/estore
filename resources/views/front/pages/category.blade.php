@extends('front.layout.front')

@section('content')

    <div class="col-12">
        <!-- Main Content -->
        <main class="row">

            <!-- Category Products -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 py-3">
                        <div class="row">
                            <div class="col-12 text-center text-uppercase">
                                <h2>{{ $category->name }}</h2>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($products as $product)
                            <!-- Product -->
                            <div class="col-xl-2 col-lg-3 col-sm-6 my-3">
                                <div class="col-12 bg-white text-center h-100 product-item">
                                    <div class="row h-100">
                                        <div class="col-12 p-0 mb-3">
                                            <a href="product.html">
                                                <img src="{{ url('images/'.$product->thumbnail) }}" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <a href="product.html" class="product-name">{{ $product->name }}</a>
                                        </div>
                                        <div class="col-12 mb-3">
                                            @if(!empty($product->discounted_price))
                                                <span class="product-price-old">
                                                        Rs {{ number_format($product->discounted_price) }}
                                                    </span>
                                                <br>
                                            @endif
                                            <span class="product-price">
                                                       Rs {{ number_format($product->price) }}
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
            <!-- Category Products -->

            <div class="col-12">
                {{ $products->links() }}
            </div>

        </main>
        <!-- Main Content -->
    </div>

@endsection