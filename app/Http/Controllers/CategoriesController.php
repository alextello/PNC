<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    public function show(Category $category)
    {
        return view('pages.home', ['posts' => $category->posts()->paginate(),
                                'title' => "Reportes de la categoria {$category->name}"]);
    }
}
