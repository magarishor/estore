@extends('layouts.cms')

@section('content')
    <main class="row">
        <div class="col-12 bg-white my-3 py-3">
            <div class="row">
                <div class="col">
                    <h1>Users</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($users->isNotEmpty())
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->status }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->updated_at }}</td>
                                        <td>
                                            <form action="{{route('cms.users.destroy', $user->id)}}" method="post">
                                                @method('Delete')
                                                @csrf
                                            <a href="{{route('cms.users.edit', $user->id)}}" class="btn btn-outline-success btn-sm">
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
                        {{ $users->links() }}
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
