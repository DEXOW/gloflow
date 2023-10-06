@section('navbar')
    <nav class="navbar navbar-expand-lg navbar-bg-color sticky-top">
        <div class="container-md">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('assets/images/logo.svg') }}" alt="" height="35">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @if (str_contains(Route::currentRouteName(), 'dashboard') == true)
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto mx-2">
                        <li class="nav-item">
                            <a class="nav-link @active('dashboard')" aria-current="page" href="{{ route('dashboard') }}">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @active('product_manager')" href="{{ route('dashboard.products_manager') }}">Product Manager</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @active('posts-page')" href="#">Poster</a>
                        </li>
                        @if (Auth::check())
                            @if (Auth::user()->role == 'admin')
                                <li class="nav-item">
                                    <a class="nav-link @active('users-page')" href="#">Manage Users</a>
                                </li>
                            @endif
                        @endif
                    @else
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto mx-2">
                                <li class="nav-item">
                                    <a class="nav-link @active('/')" aria-current="page"
                                        href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @active('products')" href="{{ route('products') }}">Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @active('about-page')" href="#">About Us</a>
                                </li>
            @endif
            @guest
                @if (Route::has('login'))
                    <a class="btn btn-primary mx-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                @endif

                @if (Route::has('register'))
                    <a class="btn btn-outline-primary mx-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            @else
                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    <img src="{{ asset('assets/images/profile_icon.svg') }}" alt="" height="25">
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <p class="dropdown-item text-muted border-bottom">{{ Auth::user()->name }}</p>
                    @if (str_contains(Route::currentRouteName(), 'dashboard') == true)
                        <a class="dropdown-item  @active('home')" href="{{ route('home') }}">Home</a>
                    @else
                        <a class="dropdown-item  @active('dashboard')" href="{{ route('dashboard') }}">Dashboard</a>
                    @endif
                    <a class="dropdown-item @active('profile')" href="#">Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @endguest
            </ul>
        </div>
        </div>
    </nav>
@endsection
