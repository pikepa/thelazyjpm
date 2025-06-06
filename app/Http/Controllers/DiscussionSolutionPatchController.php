<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscussionSolutionPatchRequest;
use App\Models\Discussion;
use App\Models\Post;

class DiscussionSolutionPatchController extends Controller
{
    public function __invoke(
        DiscussionSolutionPatchRequest $request,
        Discussion $discussion
    ) {
        //Make sure post_id is within this topic
        $discussion
            ->solution()
            ->associate($discussion->posts()->find($request->post_id));
        $discussion->save();
    }
}
