<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class SubcategoryController extends Controller
{
    public function subs($id)
    {
        $category = Category::find($id);
       return $category->subcategories()->get();
    }

    public function subDinamicos($val)
    {
        $category = Category::find($val);
        $tags = $category->tags()->get();
        return response()->json([
            'tags' => $tags
        ]);
    }
}
