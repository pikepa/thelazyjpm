<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Resources\DiscussionResource;

class DiscussionShowController extends Controller
{
    public function __invoke(Discussion $discussion)
    {
        return inertia()->render('Forum/Show',[
            'discussion' =>DiscussionResource::make($discussion)
        ]);
    }
}
