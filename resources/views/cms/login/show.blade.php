@extends('layouts.cms')

@section('content')
    <main class="row">
        <div class="col-3 bg-white mx-auto my-5 py-3">
            <div class="row">
                <div class="col text-center">
                    <h1>Login</h1>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('cms.login.check') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input" value="yes">
                        <label for="remember" class="form-check-label">Remember me</label>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-outline-primary">
                           <i class="fa-solid fa-arrow-right-to-bracket me-2"></i> Log In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
