<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SISTEM INFORMASI SISFO</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="{{ asset('bootstrap-5.3/css/bootstrap.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex flex-column h-100 welcome">
    <div class="container py-3">
        <header>
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <img class="d-block mx-auto mb-4" src="{{ asset('images/logo_rsck_new_resize.png') }}" alt="" height="57">
                <h1 class="display-5 fw-normal text-body-emphasis">SISTEM INFORMASI SISFO</h1>
            </div>
        </header>

        <main class="flex-shrink-0">
            <div class="row row-cols-1 row-cols-md-2 mb-3 text-center">
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">SIPROBLEM</h4>
                        </div>
                        <div class="card-body">
                            <a href="{{ route('siproblem.home') }}" type="button" class="w-100 btn btn-lg btn-outline-primary">Masuk Website</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">SISEKRE</h4>
                        </div>
                        <div class="card-body">
                            <a href="#" type="button" class="w-100 btn btn-lg btn-outline-primary">Masuk Website</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="{{ asset('bootstrap-5.3/js/bootstrap.min.js') }}"></script>
</body>
</html>
