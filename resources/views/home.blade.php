@include('components.navbar')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gloflow</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/home.css', 'resources/css/app.css'])
    </head>
    <body>
      @yield('navbar')
          <div style="height: 100vh; background-image: url({{ asset('assets/images/hero.svg') }}); background-repeat: no-repeat; background-size: cover;">
            <div class="row align-items-center justify-content-center h-75 w-50">
              <div class="col-md-6 p-5 w-50 rounded-3" style="background-color: #5F00D9">
                <h1 class="fw-bold text-white">Looking for a distributor for your business ?</h1>
                <button class="btn btn-secondary mt-4 fw-bold px-4">Contact Us</button>
              </div>
            </div>
            <div class="fixed-bottom column align-items-center d-flex w-100 justify-content-evenly bg-white py-4">
              <img src="{{ asset('assets/images/unilever_logo.svg') }}" alt="" width="100">
              <img src="{{ asset('assets/images/upfield_logo.svg') }}" alt="" width="150">
              <img src="{{ asset('assets/images/nestle_logo.svg') }}" alt="" width="100">
              <img src="{{ asset('assets/images/fonterra_logo.svg') }}" alt="" width="100">
              <img src="{{ asset('assets/images/cocacola_logo.svg') }}" alt="" width="150">
            </div>
          </div>
    </body>
</html>