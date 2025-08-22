@extends('layout.user')
@section('title','edit post- brog website')
@section('styles')
  <style>
    .edit-post-card {
      max-width: 700px;
      margin: 40px auto;
      padding: 30px;
      border-radius: 16px;
      background-color: white;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    .edit-post-card h3 {
      font-weight: 600;
      color: #343a40;
    }
    .form-label {
      font-weight: 500;
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    .preview-img {
      width: 150px;
      height: auto;
      border-radius: 10px;
      object-fit: cover;
    }
  </style>
@endsection
@section('container')

  <div class="edit-post-card">
    <h3 class="mb-4 text-center">Edit Your Post ✍️</h3>

    <form action="{{route('editpost.save',$pos->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
      <div class="mb-3">
        <label for="title" class="form-label">Post Title</label>
        <input type="text" id="title" name="title" class="form-control" placeholder="Enter a catchy title..." value="{{$pos->title}}" required>
      </div>

      <div class="mb-3">
        <label for="content" class="form-label">Post Content</label>
        <textarea id="content" name="content" rows="6" class="form-control" placeholder="Start writing something amazing..." required>
            {{old('content',$pos->content)}}
        </textarea>
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Update Post Image</label>
        <input type="file" id="image" name="image" class="form-control">
        <div class="mt-3">
          <span class="text-muted">Current Image:</span><br>
          <img src="{{asset('storage/'.$pos->image)}}" alt="Current Post Image" class="preview-img mt-2">
        </div>
      </div>

      <div class="d-flex justify-content-between mt-4">
        <button type="submit" class="btn btn-primary">💾 Update Post</button>
        <a href="{{route('profile.show',$pos->user->id)}}" class="btn btn-outline-secondary">Cancel</a>
      </div>
    </form>
  </div>
@endsection
