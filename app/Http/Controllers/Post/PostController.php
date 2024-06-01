<?php

namespace App\Http\Controllers\Post;

use \App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post\Like;
use \App\Models\Post\Post;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function addPost(Request $request)
    {

        $request->validate([
            'image_url' => 'required',
            'description' => 'required'
        ]);

        $post = Post::create([
            'image_url' => $request->image_url,
            'description' => $request->description,
            'user_id' => Auth()->user()->id
        ]);

        return response($post);

    }

    public function getAllPost()
    {
        $post = Post::all();
        // return response([
        //     "data" => $post,
        //     "message" => true
        // ], );
        return response()->json($post, 200);
    }

    public function UpdatePost(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->update($request->all());
            $updated = Post::find($id);
            return response([
                "message" => $updated,
                "sucsess" => true
            ]);
        }
        return response([
            "message" => "Post not found...",
            "sucsess" => false
        ]);
    }

    public function DeletePost($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            return response([
                "message" => "Post delete successfully",
                "success" => true
            ], );
        }
        return response([
            "message" => "Post not found...",
            "success" => false
        ], );
    }
    public function addLike(Request $request)
    {
        $request->validate([
            'post_id' => 'required'
        ]);
        //Check like or Not yet like
        $liked = Like::where('post_id', $request->post_id)->where('user_id', Auth()->user()->id)->first();
        if ($liked) {
            //if like changes respones to unlike and delete 1 like
            $liked->delete();
            return response("Unlike");
        }
        Like::create([
            'post_id' => $request->post_id,
            'user_id' => Auth()->user()->id
        ]);
        return response('Liked');
    }
    public function getPost($id)
    {
        $post = Post::find($id);
        // return response($post);
        return response([new PostResource($post)]);
    }
}
