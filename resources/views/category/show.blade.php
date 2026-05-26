@extends('layouts.app')
@section('title', $category['name'])

@section('content')
  {{ Breadcrumbs::render('category', $category) }}
  <div class="sm:px-24 px-6 mt-6 grid grid-cols-2 gap-4 divide-x divide-gray-200">
    <div class="h-full">
      <x-sidebar :category="(int)$category['id']" />
    </div>
    <div class="h-full">
      <div class="text-2xl font-bold">{{ $category['name'] }}</div>
    </div>
  </div>
@endsection