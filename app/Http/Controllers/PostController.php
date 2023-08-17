<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function deletePost(Post $post){
        if(auth()->user()->id === $post["user_id"]){
           $post->delete();
        }
         return redirect("/");
    }

    public function UpdatePost(Post $post, Request $request){
        if(auth()->user()->id != $post["user_id"]){
            return redirect("/");
        }
        $incomingFields = $request->validate([
            "title" => "required",
            "body" => "required"
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);
        return redirect("/");
    }

    public function showEditScreen(Post $post){
        if(auth()->user()->id != $post["user_id"]){
            return redirect("/");
        }     
        return view('edit-post', ['post' => $post]);
    }

    public function createPost(Request $request){
        $incomingFields = $request->validate([
            'title' =>'required',
            'body' =>'required'
        ]);
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();
        Post::create($incomingFields);
        // laravel doesnt have a built in model for a Post, only for a user
        // in cmd  (php artisan make:model Post) dont mistake "post" for "Post"
        //check models folder
        return redirect("/");
    }
}
