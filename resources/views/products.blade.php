@include('components.navbar')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Products | Gloflow</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body>
        @yield('navbar')
        <div class="container row justify-content-center mt-5 mb-3 mx-auto">
            <h2 class="display-6 text-center">Our Products</h2>
            <p class="text-center text-body-secondary w-50">High-quality consumer products for distribution agents. We offer a wide range of products, competitive pricing, fast shipping, and support services to help you succeed.</p>
        </div>
        <div class="container row mt-4 mx-auto">
            @if(session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div> 
            @endif
            @foreach($products as $product)
            <div class="col-md-3 col-6 mb-4">
                <div class="card">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="card-img-top">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product->name }}</h4>
                        <p>{{ $product->author }}</p>
                        <p class="card-text"><strong>Price: </strong> ${{ $product->price }}</p>
                        <p class="btn-holder"><a href="" class="btn btn-outline-danger">Add to cart</a> </p>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </body>
</html>