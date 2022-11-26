@extends('front.layout.front')

@section('content')
    <div class="col-12">
        <!-- Main Content -->
        <div class="row">
            <div class="col-12 mt-3 text-center text-uppercase">
                <h2>Login</h2>
            </div>
        </div>

        <main class="row">
            <div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white py-3 mb-4">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" id="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input name="password" type="password" id="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input name="remember" type="checkbox" id="remember" class="form-check-input">
                                    <label for="remember" class="form-check-label ml-2">Remember Me</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-auto me-auto">
                                    <button type="submit" class="btn btn-outline-dark">Login</button>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('password.request') }}">Forget Password</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <!-- Main Content -->
    </div>
@endsection
