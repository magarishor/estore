<!doctype html>
<html lang="en">
<head>
    <base href="{{ url('/') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} CMS</title>
    <link rel="stylesheet" href="{{ url('/css/cms.css') }}">
</head>
<body>
<div class="container-fluid">
    @yield('nav')

    @yield('content')
</div>

<div class="position-fixed bottom-0 start-0 mx-3 my-4">
    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ $error }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        @endforeach
    @endif
    @include('flash::message ')
</div>

<script src="{{ asset('/js/cms.js') }}"></script>
</body>
</html>
