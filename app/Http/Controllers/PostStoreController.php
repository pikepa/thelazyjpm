<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;

class PostStoreController extends Controller
{
    public function __invoke(PostStoreRequest $request, Discussion $discussion)
    {
        $post = Post::make($request->validated());
        $post->user()->associate($request->user());
        $post->discussion()->associate($discussion);
        $post->parent()->associate($discussion->post);

        $post->save();

        return redirect(route('discussions.show', $discussion).'?post=' . $post->id);
    }
}
