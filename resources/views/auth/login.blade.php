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
                    {{-- <a class="no-underline hover:underline" href="/">Home</a>
                    <a class="no-underline hover:underline" href="/blog">Blogs</a> --}}
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
            <main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
                <div class="flex">
                    <div class="w-full">
                        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">
            
                            <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                                {{ __('Login') }}
                            </header>
            
                            <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST" action="{{ route('login') }}">
                                @csrf
            
                                <div class="flex flex-wrap">
                                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                        {{ __('E-Mail Address') }}:
                                    </label>
            
                                    <input id="email" type="email"
                                        class="form-input w-full @error('email') border-red-500 @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
            
                                    @error('email')
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
            
                                <div class="flex flex-wrap">
                                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                        {{ __('Password') }}:
                                    </label>
            
                                    <input id="password" type="password"
                                        class="form-input w-full @error('password') border-red-500 @enderror" name="password"
                                        required>
            
                                    @error('password')
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
            
                                <div class="flex items-center">
                                    <label class="inline-flex items-center text-sm text-gray-700" for="remember">
                                        <input type="checkbox" name="remember" id="remember" class="form-checkbox"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <span class="ml-2">{{ __('Remember Me') }}</span>
                                    </label>
            
                                    @if (Route::has('password.request'))
                                    <a class="text-sm text-blue-500 hover:text-blue-700 whitespace-no-wrap no-underline hover:underline ml-auto"
                                        href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                </div>
            
                                <div class="flex flex-wrap">
                                    <button type="submit"
                                    class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                                        {{ __('Login') }}
                                    </button>
            
                                    @if (Route::has('register'))
                                    <p class="w-full text-xs text-center text-gray-700 my-6 sm:text-sm sm:my-8">
                                        {{ __("Don't have an account?") }}
                                        <a class="text-blue-500 hover:text-blue-700 no-underline hover:underline" href="{{ route('register') }}">
                                            {{ __('Register') }}
                                        </a>
                                    </p>
                                    @endif
                                </div>
                            </form>
            
                        </section>
                    </div>
                </div>
            </main>
        </div>

        <div>
            @include('layouts.footer')
        </div>
    </div>
</body>
</html>