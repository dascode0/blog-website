<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\category;
use App\Models\post;



class SavePostController extends Controller
{
    public function savePost($id)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Login first'], 401);
        }

        $user->savedPosts()->attach($id);

        return response()->json(['status' => 'success']);
    }

    public function unsavePost($id)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Login first'], 401);
        }

        $user->savedPosts()->detach($id);

        return response()->json(['status' => 'success']);
    }
}
