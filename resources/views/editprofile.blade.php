@extends('layout.user')
@section('title','edit profile- blog website')
@section('styles')
  <style>
    .edit-profile-container {
      max-width: 600px;
      margin: 50px auto;
      background-color: #fff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
    }

    .profile-pic {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 20px;
    }

    .form-label {
      font-weight: 500;
    }
  </style>
@endsection
@section('container')

<div class="edit-profile-container">
  <h3 class="mb-4 text-center">Edit Profile</h3>

  <form action="{{route('updateprofile.save')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Profile Image -->
    <div class="text-center">
        @if(!Auth::user()->image)
            <span class="text-dark fs-4">
                  <i class="fas fa-user-circle" style="font-size: 70px" ></i>
            </span>
        @else
            <img src="{{asset('storage/'.Auth::user()->image)}}" alt="User Profile Picture" class="rounded-circle" height="70" width="70">
        @endif
      <div class="mb-3 mt-2">
        <label for="profile_image" class="btn btn-outline-primary">
            <i class="bi bi-upload me-2"></i> change profile image
        </label>

        <input type="file" class="form-control d-none" name="image" id="profile_image">
      </div>
    </div>

    <!-- Name -->
    <div class="mb-3">
      <label for="name" class="form-label">Full Name</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Enter your full name" value="{{Auth::user()->name}}">
    </div>

    <!-- Bio -->
    <div class="mb-3">
      <label for="bio" class="form-label">Bio</label>
      <textarea class="form-control" name="bio" id="bio" rows="3" placeholder="Write something about yourself..." class="text-black" >
        {{old('bio',Auth::user()->bio)}}
      </textarea>
    </div>

    <!-- Submit Button -->
    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
  </form>
</div>
@endsection
