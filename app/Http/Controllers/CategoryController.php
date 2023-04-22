<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->orderBy('id', 'desc')->paginate(10);
        return view('categories.show', compact('category', 'posts'));
    }

}
