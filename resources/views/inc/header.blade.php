<header class="border-bottom">

    <div class="container">
            <nav class="navbar navbar-light bg-ligh">
                <a href="{{route("home")}}" class="navbar-brand text-dark text-decoration-none">
                    <span class="fs-4 ">Flori_VRN</span>
                </a>

                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="text-dark nav-link" href="{{route("about")}}">Про нас</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-dark nav-link" href="{{route("contact")}}">Контакты</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-dark nav-link" href="{{route("contact-data")}}">Сообщения</a>
                    </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
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
            </nav>
    </div>
</header>
