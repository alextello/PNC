<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Involucrado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvolucradoController extends Controller
{
    public function destroy($id, $postid)
    {
        $inv = Involucrado::find($id);
        $inv->posts()->detach($postid);
        if($inv->posts()->count() == 0){
            $inv->delete();
        }
        return back();
    }
}
