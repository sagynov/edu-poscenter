<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
      $categories = Category::where('is_active', true)->whereNull('parent_id')->with('translation')->get();
      return view('welcome', [
        'categories' => CategoryResource::collection($categories)->resolve()
      ]);
    }
}
