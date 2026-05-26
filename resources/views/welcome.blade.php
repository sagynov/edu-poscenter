@extends('layouts.app')
@section('title', 'База знаний')

@section('content')
  <div class="flex items-center sm:px-36 px-6 py-12">
    <div class="grid sm:grid-cols-3 gap-4">
    @foreach ($categories as $category)
      <a href="{{ route('category.show', ['slug' => $category['slug']]) }}" class="flex flex-col gap-4 p-6 border border-gray-200 text-center hover:shadow-md">
        <div class="flex justify-center h-[60px]">
          <img src="{{ asset('storage/'.$category['image']) }}" alt="{{ $category['name'] }}" />
        </div>
        <div class="text-lg font-bold text-sky-600">{{ $category['name'] }}</div>
        <div class="text-base">{{ $category['description'] }}</div>
      </a>
    @endforeach
    </div>
  </div>
@endsection