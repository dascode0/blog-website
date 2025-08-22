<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\category;
use App\Models\post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = post::query();
        if ($request->filled('searchtext')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->searchtext . '%')
                    ->orwhere('content', 'like', '%' . $request->searchtext . '%');
            });
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $posts = $query->latest()->get();
        $categories = category::all();
        $users = User::where('id', '!=', Auth::id())->inRandomOrder()->limit(5)->get();
        return view('homepage', compact('posts', 'categories', 'users'));
    }
    public function search(Request $request)
    {
        $query = $request->get('query');

        $posts = Post::where('title', 'LIKE', "%{$query}%")
            ->select('id', 'title')
            ->limit(5)
            ->get();

        return response()->json($posts);
    }
}
