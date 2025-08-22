<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\category;
use App\Models\post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    public function fetch(post $post)
    {
        $comments = Comment::with('user')->where('post_id',$post->id)->latest()->get();
        return response()->json($comments);
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);
        $comment = $post->comment()->create([
            'user_id' => Auth::id(),
            'body' => $request->comment
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Comment added'
        ]);
    }
    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['status' => 'success', 'message' => 'Comment deleted']);
    }

}
