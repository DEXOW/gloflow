@section('navbar')

<nav class="navbar navbar-expand-lg navbar-bg-color sticky-top">
    <div class="container-md">
        <a class="navbar-brand" href="/">
        <img src="{{ asset('assets/images/logo.svg') }}" alt="" height="35">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto mx-2">
            <li class="nav-item">
                <a class="nav-link @active('/')" aria-current="page" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @active('product-page')" href="#">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @active('about-page')" href="#">About Us</a>
            </li>
            @guest
                @if (Route::has('login'))
                    <a class="btn btn-primary mx-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                @endif
    
                @if (Route::has('register'))
                    <a class="btn btn-outline-primary mx-2" href="{{ route('register') }}">{{ __('Register')}}</a>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
    
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
    
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
        </div>
    </div>
</nav>
@endsection