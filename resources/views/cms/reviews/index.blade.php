@extends('layouts.cms')

@section('content')
    <main class="row">
        <div class="col-12 bg-white my-3 py-3">
            <div class="row">
                <div class="col">
                    <h1>Reviews</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($reviews->isNotEmpty())
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Product</th>
                                <th>Comment</th>
                                <th>Rating</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($reviews as $review)
                                    <tr>
                                        <td>{{ $review->user->name }}</td>
                                        <td>{{ $review->product->name }}</td>
                                        <td>{{ $review->comment }}</td>
                                        <td>{{ $review->rating }} <i class="fa-solid fa-star ms-2"></i></td>
                                        <td>{{ $review->created_at }}</td>
                                        <td>{{ $review->updated_at }}</td>
                                        <td>
                                            <form action="{{route('cms.reviews.destroy', $review->id)}}" method="post">
                                                @method('Delete')
                                                @csrf
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
                        {{ $reviews->links() }}
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
