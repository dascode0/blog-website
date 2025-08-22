<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login.index')->withErrors(['error' => 'Please login first.']);
        }
        $savedPosts = DB::table('saves')
            ->where('saves.user_id', Auth::id())
            ->join('posts', 'saves.post_id', '=', 'posts.id')
            ->select('posts.*')
            ->get();

        $user = User::findOrFail($id);
        $pos = post::where('user_id',$user->id)->latest()->get();
        return view('profile', compact('pos','savedPosts', 'user'));
    }

    public function logout()
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }

        Auth::logout();
        return redirect()->route('home');
    }

    public function editprofile()
    {
        return view('editprofile');
    }

    public function updateprofile(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'bio'   => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        $authUser = Auth::user();
        if (!$authUser) {
            return redirect()->route('home')->withErrors(['error' => 'User not authenticated']);
        }
        $user = User::find($authUser->id);
        if (!$user) {
            return redirect()->route('home')->withErrors(['error' => 'User not found']);
        }

        // Update image if uploaded
        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $imagePath = $request->file('image')->store('user', 'public');
            $user->image = $imagePath;
        }

        // Update name and bio
        $user->name = $request->name;
        $user->bio  = $request->bio;
        
        // Save changes
        if ($user->save()) {
            return redirect()->route('profile.show',$user->id)->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->route('profile.show',$user->id)->withErrors(['error' => 'Update failed. Please try again.']);
        }
    }
}
