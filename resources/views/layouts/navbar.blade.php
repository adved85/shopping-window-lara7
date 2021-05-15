<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.index') }}">{{ __('Orders') }}</a>
                </li>
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Shopping-cart start -->
                <li class="nav-item dropdown">
                    {{-- <a id="navbarDropdownCart" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Cart
                    </a> --}}
                    @php
                        $count = session()->has('cart') ? count(session()->get('cart')) : 0;
                        // dump($count);
                    @endphp
                    <button type="button" class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Cart <span class="badge badge-light">{{$count}}</span>
                    </button>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownCart" style="width: max-content">
                        @if($count)
                        @foreach (session()->get('cart') as $item)
                            <div class="dropdown-item">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src='{{$item['photo']}}' alt='{{$item['name']}}' width="50" height="65">
                                    </div>
                                    <div class="col-md-9">
                                        <p class="mb-1">{{ Str::limit($item['name'], 32, '...')}}</p>
                                        <span class="text-info">${{$item['price']}}</span>
                                        <span class="">Quantity: {{$item['quantity']}}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class=" dropdown-item text-center">
                            <a class="btn btn-warning" href="{{url('cart')}}">
                                Show all
                            </a>
                        </div>
                        @else
                        <div class=" dropdown-item text-center">
                            <a class="btn btn-warning" href="{{url('cart')}}">
                                Your cart is empty
                            </a>
                        </div>
                        @endif
                        {{-- <a class="dropdown-item" href="#item1">
                            item 1
                        </a> --}}
                    </div>
                </li>

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
