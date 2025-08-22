@extends('layout.user')

@section('title', 'Create Post')

@section('styles')
<style>
  .create-container {
      max-width: 700px;
      margin-top: 50px;
      background-color: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  }
</style>
@endsection

@section('container')
<div class="container my-5 create-container">
  <h2 class="mb-4">Create New Post</h2>

  <form action="{{ route('post.create') }}" method="POST" enctype="multipart/form-data" onsubmit="mergeCategory()">
    @csrf

    <!-- Title -->
    <div class="mb-3">
      <label for="title" class="form-label">Post Title</label>
      <input type="text" name="title" id="title" class="form-control" placeholder="Enter title" required>
    </div>

    <!-- Category -->
    <div class="mb-3">
      <label class="form-label">Category</label>
      <div class="input-group">
        <select id="category_select" class="form-select">
          <option value="">Select Category</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->name }}">{{ $cat->name }}</option>
          @endforeach
        </select>
        <input type="text" id="category_input" class="form-control" placeholder="Or type new category">
      </div>
      <!-- Hidden field that will be submitted -->
      <input type="hidden" name="category" id="category_final">
    </div>

    <!-- Image Upload -->
    <div class="mb-3">
      <label for="image" class="form-label">Post Image</label>
      <input type="file" name="image" id="image" class="form-control">
    </div>

    <!-- Content -->
    <div class="mb-3">
      <label for="content" class="form-label">Content</label>
      <textarea name="content" id="content" class="form-control" rows="6" placeholder="Write your post..." required></textarea>
    </div>

    <!-- Submit -->
    <button type="submit" class="btn btn-primary">Publish Post</button>
  </form>
</div>
@endsection

@section('scripts')
<script>
  function mergeCategory() {
    const selected = document.getElementById('category_select').value.trim();
    const typed = document.getElementById('category_input').value.trim();
    const finalInput = document.getElementById('category_final');

    // Prefer new typed value, fallback to selected one
    finalInput.value = typed || selected;
  }
</script>
@endsection
