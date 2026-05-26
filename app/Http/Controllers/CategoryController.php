<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, string $slug)
    {
      $category = Category::where('slug', $slug)->first();
      return view('category.show', [
        'category' => new CategoryResource($category)->resolve()
      ]);
    }
}
