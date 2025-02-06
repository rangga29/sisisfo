<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SISTEM INFORMASI SYSTEM PROBLEM REPORT ONLINE</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="{{ asset('assets/Figtree-font.css') }}" rel="stylesheet" />
    <link href="{{ asset('bootstrap-5.3/css/bootstrap.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary login">
    <main class="form-signin w-100 m-auto">
        <form method="POST" action="{{ route('siproblem.auth.authenticate') }}">
            @csrf
            <img class="mb-4" src="{{ asset('images/logo_rsck_new_resize.png') }}" alt="" height="57">
            <h1 class="h2 mb-3 fw-bolder text-center">SISTEM INFORMASI SYSTEM PROBLEM REPORT ONLINE</br> (SPR ONLINE)</h1>

            @if (sizeof($errors) > 0)
                <ul class="list-group list-group-flush">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="form-floating">
                <input type="text" class="form-control" name="nik" id="nik" placeholder="NIK" required>
                <label for="nik">NIK</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-body-secondary text-center">&copy; {{ date('Y') }} SISFO RSCK</p>
        </form>
    </main>
    <script src="{{ asset('bootstrap-5.3/js/bootstrap.min.js') }}"></script>
</body>
</html>
