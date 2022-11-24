@extends('layouts.cms')

@section('content')
    <main class="row">
        <div class="col-12 bg-white my-3 py-3">
            <div class="row">
                <div class="col-5 mx-auto">
                    <h1>Edit Profile</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-5 mx-auto">
                    <form action="{{ route('cms.profile.update') }}" method="post">
                        @method('patch')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control-plaintext" value="{{ $user->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Phone</label>
                            <input type="text" name="phone" id="name" class="form-control" value="{{ old('phone', $user->phone) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control" required>{{ old('address', $user->address) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fa-solid fa-save me-2"></i>
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('nav')
    @include('cms.includes.nav')
@endsection
