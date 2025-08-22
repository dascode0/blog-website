<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\post;


class LikePostController extends Controller
{
    public function likePost($id)
    {
        /** @var User $user */
        $user = Auth::user();
        if(!$user){
            return response()->json(['status' => 'error', 'message' => 'Login first'], 401);
        }

        $user->likedPosts()->attach($id);
        $likesCount = \App\Models\Post::find($id)->likedByUser->count();

        return response()->json(['status' => 'success', 'likes_count' => $likesCount]);
    }

    public function unlikePost($id)
    {
        /** @var User $user */
        $user = Auth::user();
        if(!$user){
            return response()->json(['status' => 'error', 'message' => 'Login first'], 401);
        }

        $user->likedPosts()->detach($id);
        $likesCount = \App\Models\Post::find($id)->likedByUser->count();

        return response()->json(['status' => 'success', 'likes_count' => $likesCount]);
    }

}
