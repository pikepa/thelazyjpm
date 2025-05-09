<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostDestroyRequest;

class PostDestroyController extends Controller
{
    public function __invoke(PostDestroyRequest $request, Post $post)
    {
        $post->delete();
        return back();
    }
}
