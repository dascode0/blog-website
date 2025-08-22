@extends('layout.user')
@Section('title','profile page - brog website')
@Section('styles')
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .profile-header {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }
        .profile-header img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #0d6efd;
        }
        .tab-section {
            background: #fff;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }
        .post-card, .save-card {
            margin-bottom: 1rem;
            border-radius: 10px;
        }
    </style>
@endsection
@section('container')
<div class="container py-5">
    <div class="row">
        <!-- Left Side: Profile Info -->
        <div class="col-md-4 mb-4">
            <div class="profile-header text-center">
                @if(!$user->image)
                    <span class="text-dark fs-4">
                        <i class="fas fa-user-circle" style="font-size: 70px"></i>
                    </span>
                @else
                    <img src="{{asset('storage/'.$user->image)}}" alt="User Profile Picture" class="rounded-circle mb-2" width="120" height="120">
                @endif
                <h4>{{$user->name}}</h4>
                <p class="text-muted">{{$user->email}}</p>
                @if(!$user->bio)
                    <p class="text-muted">// bio</p>
                @else
                    <pre class="text-muted">{{$user->bio}}</pre>
                @endif
                @if(Auth::user()->id === $user->id)
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <a href="{{route('editprofile.page')}}" class="btn btn-outline-dark btn-sm">edit profile</a>
                    </div>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{route('user.logout')}}" class="btn btn-outline-secondary btn-sm">Logout</a>
                        <a href="{{route('account.delete')}}" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete your profile?')">Delete Account</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Side: Tabs -->
        <div class="col-md-8">
            <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="my-posts-tab" data-bs-toggle="tab" data-bs-target="#my-posts" type="button" role="tab">My Posts</button>
                </li>
                @if(Auth::user()->id === $user->id)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="saved-posts-tab" data-bs-toggle="tab" data-bs-target="#saved-posts" type="button" role="tab">Saved Posts</button>
                    </li>
                @endif
            </ul>

            <div class="tab-content mt-3">
                <div class="tab-pane fade show active tab-section" id="my-posts" role="tabpanel">
                    @if($pos->isEmpty())
                        <p class="text-muted">No posts available.</p>
                    @endif
                    @foreach($pos as $post)
                    <a href="{{route('post.show',$post->id)}}" class="text-decoration-none text-dark">
                        <div class="post-card p-3 border bg-light">
                            <h5>{{$post->title}}</h5>
                            <p class="mb-1">{{Str::limit($post->content,30)}}</p>
                            <span>Date: {{$post->created_at->format('F j,Y')}}</span>
                            @if(Auth::user()->id === $user->id)
                                <a href="{{route('edit.post',$post->id)}}" class="btn btn-sm btn-primary">Edit Post</a>
                                <a href="{{route('delete.post',$post->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</a>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>

                @if(Auth::user()->id === $user->id)
                    <div class="tab-pane fade tab-section" id="saved-posts" role="tabpanel">
                        @if($savedPosts->isEmpty())
                            <p class="text-muted">No saved posts available.</p>
                        @endif
                        @foreach($savedPosts as $post)
                            <div class="save-card p-3 border bg-light">
                                <h5>{{$post->title}}</h5>
                                <p class="mb-1">{{Str::limit($post->content,30)}}</p>
                                <span class="text-muted">Author: {{$user->name}}</span>
                                <a href="{{route('post.unsave',$post->id)}}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to remove this post from saved posts?')">Remove</a>
                                <a href="{{route('post.show',$post->id)}}" class="btn btn-sm btn-secondary">View Post</a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection


