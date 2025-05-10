<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DiscussionDestroyRequest;
use App\Models\Discussion;

class DiscussionDestroyController extends Controller
{
    public function __invoke(DiscussionDestroyRequest $request, Discussion $discussion)
    {
        $discussion->delete();

        return redirect()->route('home');
    }
}
