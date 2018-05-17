<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Photo;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function store(Post $post)
    {
        $this->validate(request(), [
            'photo' => 'image|max:2048'
        ]);
        
        $photo = request()->file('photo')->store('public');

        Photo::create([
            'url' => Storage::url($photo),
            'post_id' => $post->id
        ]);
    }

    public function destroy(Photo $photo)
    {
        $path = str_replace('storage', 'public', $photo->url);
        Storage::delete($path);
        $photo->delete();
        return back()->with('flash', 'Foto eliminada');
    }
}
