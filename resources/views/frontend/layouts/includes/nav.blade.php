<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('/') }}">Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('/') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach (App\Models\Category::all() as $category)
                            <li class="nav-item"><a class="nav-link"
                                    href="{{ route('category', $category->id) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">Brands</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach (App\Models\Brand::all() as $brand)
                            <li class="nav-item"><a class="nav-link"
                                    href="{{ route('brand', $brand->id) }}">{{ $brand->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">{{ auth()->user()->name }}</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}">Profile</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('orderdeatils', auth()->user()->id) }}">Orders</a>
                            </li>
                            @if (auth()->user()->is_admin == 1)
                                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                            @endif
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="nav-link" type="submit">Logout</button>
                                </form>
                            </li>

                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page"
                            href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
                <form class="d-flex" role="search" action="{{ route('search') }}" method="GET">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </ul>

            <form class="d-flex">
                <a class="btn btn-outline-dark" href="{{ route('cart.list') }}">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">{{ Cart::getTotalQuantity() }}</span>
                </a>
            </form>
        </div>
    </div>
</nav>
