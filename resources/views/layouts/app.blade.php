<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

        @fonts

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body>
        @section('header')
          <header>
            <div class="px-6 py-4 bg-white">
              @foreach (config('app.languages') as $code => $language)
                <a href="/{{ $code }}">{{$language}}</a>
              @endforeach
            </div>
            <div class="px-6 py-4 flex justify-between items-center">
              <a href="{{ route('welcome') }}" class="text-2xl font-bold">Poscenter</a>
              <div>
                <a href="https://poscenter.kz" class="py-2 px-6 bg-sky-600 text-white rounded-lg">Перейти на сайт</a>
              </div>
            </div>
            <div class="h-[200px] flex items-center sm:px-36 px-6">
              <div class="space-y-4">
                <div class="font-bold text-2xl">Как мы можем вам помочь?</div>
                <div>
                  <input type="text" placeholder="Искать ответы" class="bg-white py-2 px-4 sm:min-w-[500px] w-full rounded-lg"/>
                </div>
              </div>
            </div>
          </header>
        @show
        @yield('content')
    </body>
</html>
