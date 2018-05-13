<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class PhotosController extends Controller
{
    public function store(Post $post)
    {
        return 'subiendo';
    }
}
