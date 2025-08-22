<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\category;
use App\Models\post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function index()
    {
        $categories = category::all();
        return view('createpost', compact('categories'));
    }
    public function insert(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        $categoryname = strtolower(trim($request->input('category')));
        $category = category::where('name', 'like', $categoryname)->first();
        if (!$category) {
            $category = category::firstOrCreate([
                'name' => $categoryname
            ]);
        }
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }
        $user = Auth::user();
        if ($user) {
            Post::create([
                'user_id' => Auth::id(),
                'title' => $request->input('title'),
                'category_id' => $category->id,
                'image' => $imagePath,
                'content' => $request->input('content'),
            ]);

            return redirect()->route('home')->with('success', 'Post created successfully.');
        } else {
            return redirect()->route('login.index')->with(['errors' => 'before post login plese!']);
        }
    }
    public function editpost($id)
    {
        $pos = post::findOrFail($id);
        return view('editpost', compact('pos'));
    }


    public function editpostsave(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // ✅ Fetch the post
        $post = Post::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }

            $imagePath = $request->file('image')->store('posts', 'public');
            $post->image = $imagePath;
        }
        $post->title = $request->title;
        $post->content = $request->content;
        if ($post->save()) {
            return redirect()->route('profile.show', $post->id)->with('success', 'Post updated successfully.');
        } else {
            return redirect()->route('profile.show', $post->id)->with('error', 'Post update failed.');
        }
    }

    public function deletepost($id)
    {
        $post = post::findOrFail($id);
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }
        if ($post->delete()) {
            return redirect()->route('profile.show', $post->id)->with('succes', 'post is delete!');
        } else {
            return redirect()->route('profile.show', $post->id)->with('errors', 'post iis not delete, come some problem!');
        }
    }
}
