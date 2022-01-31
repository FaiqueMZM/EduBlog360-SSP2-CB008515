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
                                {{ __('Register') }}
                            </header>
            
                            <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST"
                                action="{{ route('register') }}">
                                @csrf
            
                                <div class="flex flex-wrap">
                                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                        {{ __('Name') }}:
                                    </label>
            
                                    <input id="name" type="text" class="form-input w-full @error('name')  border-red-500 @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            
                                    @error('name')
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
            
                                <div class="flex flex-wrap">
                                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                        {{ __('E-Mail Address') }}:
                                    </label>
            
                                    <input id="email" type="email"
                                        class="form-input w-full @error('email') border-red-500 @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
            
                                    @error('email')
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
            
                                <div class="">
                                    <label for="user" class="block text-gray-700 text-sm font-bold">
                                        {{ __('User Type') }}:
                                    </label><br><br>

                                    <label class="radio-inline mr-10"><input type="radio" name="user" value="Reader" checked>Reader</label>
                                    <label class="radio-inline mr-10"><input type="radio" name="user" value="Author">Author</label>
                                    <label class="radio-inline"><input type="radio" name="user" value="Moderator">Moderator</label>
            
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
                                        required autocomplete="new-password">
            
                                    @error('password')
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $message }}
                                    </p>
                                    @enderror
                                </div>
            
                                <div class="flex flex-wrap">
                                    <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                        {{ __('Confirm Password') }}:
                                    </label>
            
                                    <input id="password-confirm" type="password" class="form-input w-full"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
            
                                <div class="flex flex-wrap">
                                    <button type="submit"
                                        class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                                        {{ __('Register') }}
                                    </button>
            
                                    <p class="w-full text-xs text-center text-gray-700 my-6 sm:text-sm sm:my-8">
                                        {{ __('Already have an account?') }}
                                        <a class="text-blue-500 hover:text-blue-700 no-underline hover:underline" href="{{ route('login') }}">
                                            {{ __('Login') }}
                                        </a>
                                    </p>
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