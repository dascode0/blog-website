<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\category;
use App\Models\post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostShowController extends Controller
{
    public function index($id){
        $posts=post::findOrFail($id);
        $comments=Comment::with('user')->where('post_id','like',$posts->id)->latest()->get();
        $user=Auth::user();
        if($posts){
            return view('postShow',compact('posts','comments','user'));
        }
    }
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
            'post_id' => 'required|exists:posts,id'
        ]);
        $user=Auth::user();
        $comment = Comment::create([
            'user_id' => $user->id,
            'post_id' => $request->post_id,
            'content' => $request->comment
        ]);

        return response()->json([
            'user' => $comment->user->name,
            'comment' => $comment->content
        ]);
    }
}
