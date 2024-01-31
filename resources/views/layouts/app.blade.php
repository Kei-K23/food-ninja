@php
$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove the leading slash if present
$url_path = ltrim($url_path, '/');

// Split the path into an array
$path_array = explode('/', $url_path);
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}


    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.1/maps/maps.css'>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/owl.autoplay.js') }}"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Food-Ninja') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="{{ $path_array[0] == '' ? 'nav-link active text-primary' : 'nav-link' }}"
                                href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="{{ $path_array[0] == 'category' ? 'nav-link active text-primary' : 'nav-link' }}"
                                href="{{ route('category') }}">{{ __('Category') }} </a>
                        </li>

                        <li class="nav-item">
                            <a class="{{ $path_array[0] == 'menu' ? 'nav-link active text-primary' : 'nav-link' }}"
                                href="{{ route('menu') }}">{{ __('Menu') }} </a>
                        </li>

                        <li class="nav-item">
                            <a class="{{ $path_array[0] == 'restaurant' ? 'nav-link active text-primary' : 'nav-link' }}"
                                href="{{ route('restaurant') }}">{{ __('Restaurant') }} </a>
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}"><i
                                        class="fa-solid fa-user me-2 "></i>{{ __('Profile') }}</a>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                        class="fa-solid fa-right-from-bracket me-1 "></i>
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

        <main class="py-4">
            @yield('content')
        </main>
        <footer class="border-top-1  w-100 ">
            <div class="my-4 d-flex justify-content-between align-items-center w-100  container">
                <div>
                    <a href="{{ url('/') }}" class="text-primary fs-2 link-style-hide fw-bolder ">{{ config('app.name',
                        'Laravel') }}</a>
                    <p class="text-muted ">Food for you</p>
                    <p class="text-center ">CopyRight© {{ date('Y') }} Food-Ninja. All rights reserved.</p>
                    <a class="link-style-hide " href="https://github.com/Kei-K23" target="__blank">Created with
                        💙
                        by kei-k </a>
                </div>
                <ul class="p-0 m-0">
                    <li class="list-unstyled"><a class="link-style-hide text-muted" href="{{ route('home') }}">{{
                            __('Home') }}</a></li>
                    <li class="list-unstyled"><a class="link-style-hide text-muted " href="{{ route('category') }}">{{
                            __('Category') }}</a></li>
                    <li class="list-unstyled"><a class="link-style-hide text-muted " href="{{ route('menu') }}">{{
                            __('Menu') }}</a></li>
                </ul>
            </div>
        </footer>
    </div>

    {{-- carousel --}}
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            loop: true,
            nav: true,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                },
                1260: {
                    items: 4
                }
            }
        })
    </script>

    {{-- map integration --}}
    <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.25.1/maps/maps-web.min.js'></script>
    <script src="{{ asset('js/responsive-map.js') }}"></script>
    <script>
        const latitudeInput = document.querySelector('#latitude-input');
        const longitudeInput = document.querySelector('#longitude-input');

        // Define default center coordinates
        let defaultCenter;

        @if (Auth::check() && Auth::user()->longitude !== null && Auth::user()->latitude !== null)
            defaultCenter = [{{ Auth::user()->longitude }}, {{ Auth::user()->latitude }}];
        @else
            defaultCenter = [96.1951, 16.8661];
        @endif

        let baseUrl = "{{ asset('storage/images/') }}/";
        let userImageUrl = "{{ Auth::check() ? addslashes(Auth::user()->image_url) : '' }}";

        if (!userImageUrl) {
            userImageUrl = "{{ asset('images/profile-picture.png') }}"; // Default image
        } else {
            userImageUrl = baseUrl + userImageUrl; // Append base URL if provided
        }

        let border = document.createElement('div');
        border.className = "marker-border";

        let icon = document.createElement('div');
        icon.className = 'marker-icon';
        icon.style.backgroundImage = `url('${userImageUrl}')`;

        border.appendChild(icon);

        let defaultMarker = null; // Variable to hold the default marker
        let previousClickMarker = null;
        const size = 50;

        const map = tt.map({
            key: "{{ config('services.tomtom_map_api_key') }}",
            container: 'map',
            dragPan: !isMobileOrTablet(),
            center: defaultCenter,
        });

        // Add controls
        map.addControl(new tt.FullscreenControl());
        map.addControl(new tt.NavigationControl());

        // Add default marker on load
        map.on('load', () => {
            defaultMarker = new tt.Marker({
                element: border
            }).setLngLat(defaultCenter).addTo(map);
        });

        // Listen for click events on the map
        map.on('click', (event) => {

            // Get the coordinates of the clicked location
            const clickedCoordinates = [event.lngLat.lng, event.lngLat.lat];
            latitudeInput.value = event.lngLat.lat;
            longitudeInput.value = event.lngLat.lng;
            // Remove the default marker if it exists
            if (defaultMarker) {
                defaultMarker.remove();
                defaultMarker = null; // Reset the default marker variable
            }

            if (previousClickMarker) {
                previousClickMarker.remove();
                previousClickMarker = null;
            }

            // Add a new marker at the clicked location
            previousClickMarker = new tt.Marker({
                element: border
            }).setLngLat(clickedCoordinates).addTo(map);
        });
    </script>
</body>

</html>