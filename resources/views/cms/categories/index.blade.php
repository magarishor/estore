@extends('layouts.cms')

@section('content')
    <main class="row">
        <div class="col-12 bg-white my-3 py-3">
            <div class="row">
                <div class="col">
                    <h1>Categories</h1>
                </div>
                <div class="col-auto">
                    <a href="{{ route('cms.categories.create') }}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-plus me-2"></i>
                        Add Category
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($categories->isNotEmpty())
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->status }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>{{ $category->updated_at }}</td>
                                        <td>
                                            <form action="{{route('cms.categories.destroy', $category->id)}}" method="post">
                                                @method('Delete')
                                                @csrf
                                            <a href="{{route('cms.categories.edit', $category->id)}}" class="btn btn-outline-success btn-sm">
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
                        {{ $categories->links() }}
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
