@extends('layout.user')
@section('title','register page')
@section('styles')
  <style>
    body {
      background-color: #f1f5f9;
    }
    .card {
      border-radius: 1rem;
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #0d6efd;
    }
    .btn-success {
      width: 100%;
    }
  </style>
@section('styles')
@section('container')
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card shadow p-4">
          <h3 class="text-center mb-4">Register to MyBlog</h3>
          @if ($errors->any())
              <script>
                  let errorMessages = "";
                  @foreach ($errors->all() as $error)
                      errorMessages += "{{ $error }}\n";
                  @endforeach
                  alert(errorMessages);
              </script>
          @endif
          <form action="{{route('register.save')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="image" class="form-label"> your pic</label>
              <input type="file" name="image" accept="image/*">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
              <label for="confirm_password" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="confirm_password" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-dark w-100">Register</button>
          </form>
          <p class="text-center mt-3">Already have an account? <a href="{{Route('login.index')}}">Login here</a></p>
        </div>
      </div>
    </div>
  </div>
@endsection
