<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        $request->validate([
            'post_id' => 'required',
            'body' => 'required'
        ]);

        $comment = Comment::create([
            'post_id' => $request->post_id,
            'body' => $request->body,
            'user_id' => Auth()->user()->id,
            'like_count' => $request->like_count
        ]);

        return response($comment);
    }
}
