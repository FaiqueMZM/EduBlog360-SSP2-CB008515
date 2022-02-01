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
            <div class="w-4/5 m-auto text-center">
                <div class="py-15 border-b border-gray-200">
                    <h1 class="text-6xl">
                        Blog Requests
                    </h1>
                </div>
            </div>
            
            @if (session()->has('message'))
                <div class="w-4/5 m-auto mt-10 pl-2">
                    <p class="w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4">
                        {{ session()->get('message') }}
                    </p>
                </div>
            @endif
            
            @if (Auth::check() && Auth::user()->user == "Author")
                <div class="pt-15 w-4/5 m-auto mb-10">
                    <a 
                        href="/blog/create"
                        class="bg-blue-500 uppercase bg-transparent text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
                        Create post
                    </a>
                </div>
            @endif
            
            @foreach ($posts as $post)
            @if ($post->status == 0)
                <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
                    <div>
                        <img src="{{ asset('images/' . $post->image_path) }}" alt="">
                    </div>
                    <div>
                        <h2 class="text-gray-700 font-bold text-5xl pb-4">
                            {{ $post->title }}
                        </h2>
            
                        <span class="text-gray-500">
                            By <span class="font-bold italic text-gray-800">{{ $post->user->name }}</span>, Updated on {{ date('jS M Y', strtotime($post->updated_at)) }}
                        </span>
            
                        <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                            {{ $post->description }}
                        </p>
            
                        <a href="/blog/{{ $post->slug }}" class="uppercase bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                            Keep Reading
                        </a>
            
                        @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id || Auth::user()->user == "Moderator")
                            <span class="float-right">
                                <a 
                                    href="/blog/{{ $post->slug }}/edit"
                                    class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">
                                    Edit
                                </a>
                            </span>
            
                            <span class="float-right">
                                 <form 
                                    action="/blog/{{ $post->slug }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
            
                                    <button
                                        class="text-red-500 pr-3"
                                        type="submit">
                                        Delete
                                    </button>
            
                                </form>
                            </span>
            
                            <span class="float-right">
                                <button class="text-green-500 pr-3">
                                    <a href="/published/{{$post->id}}">Publish</a>
                                </button>
                           </span>
            
                        @endif
                    </div>
                </div>
            @endif
            @endforeach
        </div>

        <div>
            <div class="w-4/5 m-auto text-center">
                <div class="py-15 border-b border-gray-200">
                    <h1 class="text-6xl">
                        Verified Blogs
                    </h1>
                </div>
            </div>
            
            @if (session()->has('message'))
                <div class="w-4/5 m-auto mt-10 pl-2">
                    <p class="w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4">
                        {{ session()->get('message') }}
                    </p>
                </div>
            @endif
            
            @foreach ($posts as $post)
            @if ($post->status == 1)
                <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
                    <div>
                        <img src="{{ asset('images/' . $post->image_path) }}" alt="">
                    </div>
                    <div>
                        <h2 class="text-gray-700 font-bold text-5xl pb-4">
                            {{ $post->title }}
                        </h2>
            
                        <span class="text-gray-500">
                            By <span class="font-bold italic text-gray-800">{{ $post->user->name }}</span>, Updated on {{ date('jS M Y', strtotime($post->updated_at)) }}
                        </span>
            
                        <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                            {{ $post->description }}
                        </p>
            
                        <a href="/blog/{{ $post->slug }}" class="uppercase bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                            Keep Reading
                        </a>
            
                        @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id || Auth::user()->user == "Moderator")
                            <span class="float-right">
                                <a 
                                    href="/blog/{{ $post->slug }}/edit"
                                    class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">
                                    Edit
                                </a>
                            </span>
            
                            <span class="float-right">
                                 <form 
                                    action="/blog/{{ $post->slug }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
            
                                    <button
                                        class="text-red-500 pr-3"
                                        type="submit">
                                        Delete
                                    </button>
            
                                </form>
                            </span>
            
                            <span class="float-right">
                                <button class="text-red-500 pr-3">
                                    <a href="/rejected/{{$post->id}}">Reject</a>
                                </button>
                           </span>
            
                        @endif
                    </div>
                </div>
            @endif
            @endforeach
        </div>

        <div>
            @include('layouts.footer')
        </div>
    </div>
</body>
</html>