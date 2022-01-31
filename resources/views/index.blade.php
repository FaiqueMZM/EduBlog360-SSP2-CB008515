<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'EduBlog360') }}</title> --}}
    <title>EduBlog360</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="bg-gray-800 py-6">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div>
                    <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                        EduBlog360
                    </a>
                </div>
                <nav class="space-x-4 text-gray-300 text-sm sm:text-base">
                    <a class="no-underline hover:underline" href="/">Home</a>
                    <a class="no-underline hover:underline" href="/blog">Blogs</a>
                    @if (Auth::check() && Auth::user()->user == "Author")
                    <a class="no-underline hover:underline" href="/myblog">My Blogs</a>   
                    @endif
                    @if (Auth::check() && Auth::user()->user == "Moderator")
                    <a class="no-underline hover:underline" href="/blogrequest">Blog Requests</a>   
                    @endif
                    @guest
                        <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <span>{{ Auth::user()->name }}</span>

                        <a href="{{ route('logout') }}"
                           class="no-underline hover:underline"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endguest
                </nav>
            </div>
        </header>

        <div>
            <div class="background-image grid grid-cols-1 m-auto">
                <div class="flex text-gray-100 pt-10">
                    <div class="m-auto pt-4 pb-16 sm:m-auto w-4/5 block text-center">
                        <h1 class="sm:text-white text-5xl font-bold text-shadow-md pb-5">
                            Explore the destination of Articles
                        </h1>
                        <h1 class="sm:text-white text-5xl font-bold text-shadow-md pb-14">
                            EduBlog360
                        </h1>
                        <a 
                            href="/login"
                            class="text-center bg-gray-50 text-gray-700 py-2 px-4 font-bold text-xl uppercase">
                            View Articles
                        </a>
                    </div>
                </div>
            </div>
        
            <div class="text-center p-15 bg-black text-white">
                <h2 class="text-2xl pb-5 text-l"> 
                    EduBlog360
                </h2>
        
                <span class="font-extrabold block text-4xl py-1">
                    User Friendly
                </span>
                <span class="font-extrabold block text-4xl py-1">
                    Unlimited Contents
                </span>
                <span class="font-extrabold block text-4xl py-1">
                    Availability
                </span>
            </div>  
        </div>

        <div>
            @include('layouts.footer')
        </div>
    </div>
</body>
</html>