<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use function Laravel\Prompts\password;

class PostCommentsController extends Controller
{
    public function storeComment(Post $post, Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $request->input('body'),
        ]);

        return back();
    }
}
