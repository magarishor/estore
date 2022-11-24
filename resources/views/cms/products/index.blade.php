@extends('layouts.cms')

@section('content')
    <main class="row">
        <div class="col-12 bg-white my-3 py-3">
            <div class="row">
                <div class="col">
                    <h1>Products</h1>
                </div>
                <div class="col-auto">
                    <a href="{{ route('cms.products.create') }}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-plus me-2"></i>
                        Add Product
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($products->isNotEmpty())
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Discounted Price</th>
                                <th>Thumbnail</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Status</th>
                                <th>Featured Product</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ 'Rs. '.number_format($product->price) }}</td>
                                        <td>{{ !empty($product->discounted_price)? 'Rs. '.number_format($product->discounted_price) : 'n/a' }}</td>
                                        <td><img src="{{ url('images/'.$product->thumbnail) }}" class="img-small"/></td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->brand->name }}</td>
                                        <td>{{ $product->status }}</td>
                                        <td>{{ $product->featured }}</td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>{{ $product->updated_at }}</td>
                                        <td>
                                            <form action="{{route('cms.products.destroy', $product->id)}}" method="post">
                                                @method('Delete')
                                                @csrf
                                            <a href="{{route('cms.products.edit', $product->id)}}" class="btn btn-outline-success btn-sm">
                                                <i class="fa-solid fa-edit me-2"></i>
                                                Edit
                                            </a>
                                                <button type="submit" class="btn btn-outline-danger btn-sm delete">
                                                    <i class="fa-solid fa-times me-2"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    @else
                        <h4 class="text-muted fst-italic">No data added.</h4>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection

@section('nav')
    @include('cms.includes.nav')
@endsection
