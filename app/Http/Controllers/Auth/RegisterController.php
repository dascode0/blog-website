<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }
    public function addUser(Request $request){
        // print_r($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'image'=>'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'password' => 'required|string|min:4|confirmed',
        ]);
        $imagepath=NULL;
        if($request->hasFile('image')){
            $imagepath=$request->file('image')->store('user','public');
        }
        $sql=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'image'=>$imagepath,
            'password'=>$request->password
        ]);
        if($sql)
        {
            Auth::login($sql);
            $user=Auth::user();
            Mail::to($user->email)->send(new WelcomeEmail($user));
            return redirect()->route('home');
        }
        else{
            return redirect()->back()->withErrors(['errors'=>'registration failed plese try again;']);
        }
    }

    public function accountdelete()
    {
        /** @var User $user */
        $user=Auth::user();
        foreach ($user->posts as $post) {
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete(); // delete each post
    }
         if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
        Auth::logout();
        $user->delete();
        return redirect()->route("home");
        
    }
}
