@extends('layout.user')
@section('title', 'home page - blog website')

@section('styles')
    <style>
        body {
            background-color: #f8f9fa;
        }

        /* Fix sidebars */
        .sidebar,
        .rightbar {
            position: sticky;
            top: 20px;
        }

        /* Sidebar Styling */
        .sidebar,
        .rightbar {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        /* .sidebar .nav-link {
                            color: #333;
                            font-weight: 500;
                            padding: 10px 15px;
                            border-radius: 8px;
                            transition: all 0.2s;
                        }

                        .sidebar .nav-link:hover {
                            background-color: #0d6efd;
                            color: white;
                        } */
        /* Sidebar box */
        .sidebar {
            background: #ffffff;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .sidebar:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        /* Nav Links */
        .sidebar-link {
            color: #444;
            font-weight: 500;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .sidebar-link:hover {
            background: linear-gradient(90deg, #0d6efd, #0dcaf0);
            color: #fff !important;
            transform: translateX(5px);
        }

        /* Categories */
        .category-item {
            padding: 8px 12px;
            margin-bottom: 6px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .category-item:hover {
            background: #f1f8ff;
            color: #0d6efd;
            transform: translateX(5px);
        }

        .category-list li {
            list-style: none;
            padding: 8px 10px;
            border-radius: 6px;
            transition: background 0.2s;
            cursor: pointer;
        }

        .category-list li:hover {
            background: #f1f1f1;
        }

        /* Blog Card */
        .blog-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.2s ease-in-out;
        }

        .blog-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        /* Suggested Users */
        .user-item {
            display: flex;
            align-items: center;
            /* padding: 8px 0; */
        }

        .user-item img {
            border-radius: 50%;
            width: 36px;
            height: 36px;
            margin-right: 10px;
            object-fit: cover;
        }

        .user-item:hover {
            background: #f8f9fa;
            border-radius: 8px;
            padding-left: 5px;
        }
    </style>
@endsection

@section('container')
    <div class="container-fluid py-4">
        <div class="row g-4">

            <!-- Left Sidebar -->
            <div class="col-lg-3">
                <div class="sidebar p-3 rounded shadow-sm bg-white">

                    <!-- Navigation -->
                    <h5 class="mb-3 text-primary fw-bold">Navigation</h5>
                    <nav class="nav flex-column mb-4">
                        <a class="nav-link sidebar-link" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-2"></i> Home
                        </a>
                        @auth
                            <a class="nav-link sidebar-link" href="{{ route('profile.show', Auth::user()->id) }}">
                                <i class="bi bi-person me-2"></i> Profile
                            </a>
                            <a class="nav-link sidebar-link text-danger" href="{{ route('user.logout') }}">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </a>
                        @endauth
                        @guest
                            <a class="nav-link sidebar-link" href="{{ route('login.index') }}">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Login
                            </a>
                        @endguest
                    </nav>

                    <!-- Categories -->
                    <h5 class="mb-3 text-primary fw-bold">Categories</h5>
                    <ul class="category-list list-unstyled">
                        @foreach ($categories as $category)
                            <li class="category-item"
                                onclick="window.location='{{ route('home', ['category_id' => $category->id]) }}'">
                                <i class="bi bi-tag me-2 text-secondary"></i> {{ $category->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Main Feed -->
            <div class="col-lg-6">
                <!-- Search -->
                <!-- Search & Filter -->
                <div class="row mb-4">
                    <div class="col-md-12 mx-auto">
                        <form class="d-flex justify-content-between gap-3" action="{{ route('home') }}" method="get">
                            <input type="text" id="search" class="form-control" name="searchtext"
                                placeholder="Search blog posts..." autocomplete="off">
                            <div id="searchResults" class="list-group mt-5 position-absolute"
                                style="width: 25%; z-index: 1000;"></div>

                            <select class="form-select" style="max-width: 200px;" name="category_id">
                                <option value="" {{ request('category_id') == null ? 'selected' : '' }}>All Categories
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary"><i class="bi bi-search"></i></button>
                        </form>
                    </div>
                </div>

                <div class="row justify-content-center">
                    @if ($posts->isEmpty())
                        <p class=" col-md-8 mb-4 text-center card card-body bg-secondary text-white">No posts are available!
                        </p>
                    @endif
                    @foreach ($posts as $post)
                        <!-- Post Card -->
                        <div class="col-md-12 mb-4">
                            <div class="card blog-card shadow-sm">
                                <a href="{{ route('post.show', $post->id) }}"><img
                                        src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Post Image"
                                        style="max-height: 300px; object-fit: cover;"></a>
                                <div class="card-body">
                                    <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none text-dark">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                    </a>
                                    <p class="card-text text-muted">{{ $post->content }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="author-info d-flex align-items-center">
                                            <a href="{{ route('profile.show', $post->user->id) }}"
                                                class="d-flex align-items-center text-decoration-none text-dark">
                                                @if (!$post->user->image)
                                                    <span class="text-dark fs-4 me-2">
                                                        <i class="fas fa-user-circle" style="font-size: 32px"></i>
                                                    </span>
                                                @else
                                                    <img src="{{ asset('storage/' . $post->user->image) }}"
                                                        class="rounded-circle me-2" width="32" height="32"
                                                        alt="Author">
                                                @endif
                                                <small class="text-muted">{{ $post->user->name }}</small>
                                            </a>
                                            <small class="text-muted ms-4">
                                                {{ $post->created_at->format('F j, Y') }}</small>
                                        </div>
                                        <div class="post-actions text-end d-flex align-items-center">
                                            <!-- If user liked the post -->
                                            @if (Auth::check() && Auth::user()->likedPosts->contains($post->id))
                                                <button class="btn-like text-danger" data-id="{{ $post->id }}"
                                                    data-action="unlike" style="border: none;background:none;">
                                                    <i class="bi bi-heart-fill"></i>
                                                </button>
                                            @else
                                                <button class="btn-like text-dark" data-id="{{ $post->id }}"
                                                    data-action="like" style="border: none; background:none">
                                                    <i class="bi bi-heart"></i>
                                                </button>
                                            @endif

                                            <!-- Likes count -->
                                            <span class="like-count me-2">{{ $post->likedByUser->count() }}</span>

                                            <!-- Comment toggle button -->
                                            <button class="btn btn-link btn-none border-0 show-comments text-dark"
                                                data-post-id="{{ $post->id }}">
                                                <i class="bi bi-chat-left-text me-1"></i><span
                                                    class="text-decoration-none text-dark"
                                                    id="comment-count">{{ $post->comment->count() }}</span>
                                            </button>

                                            @if (Auth::check() && Auth::user()->savedPosts->contains($post->id))
                                                <button class="btn-save text-dark" data-id="{{ $post->id }}"
                                                    data-action="unsave" style="border: none;background:none;">
                                                    <i class="bi bi-bookmark-fill"></i>
                                                </button>
                                            @else
                                                <button class="btn-save text-dark" data-id="{{ $post->id }}"
                                                    data-action="save" style="border: none; background:none">
                                                    <i class="bi bi-bookmark"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Comment section (hidden by default) -->
                                    <div id="comments-section-{{ $post->id }}"
                                        class="comments-section border-top mt-2 pt-2" style="display:none;">
                                        <div class="comments-list p-2"></div>

                                        <!-- add comment form -->
                                        @auth
                                            <form class="add-comment-form mt-2" data-post-id="{{ $post->id }}">
                                                <div class="input-group">
                                                    <input name="comment" class="form-control"
                                                        placeholder="Write a comment..." required>
                                                    <button class="btn btn-primary" type="submit">Post</button>
                                                </div>
                                            </form>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- Repeat more post cards below if needed -->

                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-3">
                <div class="rightbar">
                    <h5 class="mb-2">Suggested Users</h5>
                    @auth
                        @foreach ($users as $user)
                            <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">
                                <div class="user-item">
                                    @if ($user->image)
                                        <img src="{{ asset('storage/' . $user->image) }}" alt="User">
                                    @else
                                        <span class="text-secondary fs-1 me-1">
                                            <i class="fas fa-user-circle"></i>
                                        </span>
                                    @endif
                                    <div>
                                        <strong>{{ $user->name }}</strong>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endauth
                    @guest
                        <strong>plese login to show the the user.</strong>
                    @endguest
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                let query = $(this).val();

                if (query.length > 1) {
                    $.ajax({
                        url: "{{ route('search.posts') }}",
                        type: "GET",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            $('#searchResults').empty();

                            if (data.length > 0) {
                                data.forEach(function(post) {
                                    $('#searchResults').append(`
                                <a href="#" class="list-group-item list-group-item-action search-item" data-title="${post.title}">
                                    ${post.title}
                                </a>
                            `);
                                });
                            } else {
                                $('#searchResults').append(
                                    `<div class="list-group-item text-muted">No results found</div>`
                                );
                            }
                        }
                    });
                } else {
                    $('#searchResults').empty();
                }
            });

            // When clicking on a suggestion
            $(document).on('click', '.search-item', function(e) {
                e.preventDefault();
                let title = $(this).data('title');
                $('#search').val(title); // Put clicked title in search box
                $('#searchResults').empty(); // Hide suggestions
            });

            // Make sure Laravel CSRF token is sent with every request
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btn-like').click(function() {
                let button = $(this); // the clicked button
                let postId = button.data('id'); // post ID
                let action = button.data('action'); // like or unlike

                $.post(`/` + action + `-post/` + postId, function(response) {
                    if (response.status === 'success') {
                        // Change button style instantly
                        if (action === 'like') {
                            button.html('<i class="bi bi-heart-fill"></i>');
                            button.removeClass('text-dark').addClass('text-danger');
                            button.data('action', 'unlike');
                        } else {
                            button.html('<i class="bi bi-heart"></i>');
                            button.removeClass('text-danger').addClass('text-dark');
                            button.data('action', 'like');
                        }

                        // Update like count
                        button.next('.like-count').text(response.likes_count);
                    }
                }).fail(function() {
                    alert('Please log in to like posts.');
                });
            });

            $('.btn-save').click(function() {
                let button = $(this); // the clicked button
                let postId = button.data('id'); // post ID
                let action = button.data('action'); // like or unlike

                $.post(`/` + action + `-post/` + postId, function(response) {
                    if (response.status === 'success') {
                        // Change button style instantly
                        if (action === 'save') {
                            button.html('<i class="bi bi-bookmark-fill"></i>');
                            button.data('action', 'unsave');
                        } else {
                            button.html('<i class="bi bi-bookmark"></i>');
                            button.data('action', 'save');
                        }
                    }
                }).fail(function() {
                    alert('Please log in to like posts.');
                });
            });


            $(".show-comments").click(function() {
                let postId = $(this).data("post-id");
                let section = $("#comments-section-" + postId);

                if (section.is(":visible")) {
                    section.hide();
                } else {
                    showComments(postId);
                }
            });


            function showComments(postId) {
                let section = $("#comments-section-" + postId);
                let list = section.find(".comments-list");

                section.show(); // Always show
                list.html("<p>Loading...</p>"); // Feedback while loading

                $.get(`/posts/${postId}/comments`, function(data) {
                    list.empty();

                    if (!data || data.length === 0) {
                        list.append("<p>No comments yet.</p>");
                    } else {
                        data.forEach(function(comment) {
                            list.append(`
                  <div class="d-flex align-items-start mb-3 p-2 border rounded shadow-sm bg-light"  data-comment-id="${comment.id}">
                      ${comment.user.image 
                          ? `<img src="/storage/${comment.user.image}" alt="${comment.user.name}" class="rounded-circle me-3" width="45" height="45" style="object-fit: cover;">`
                          : `<div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; font-size: 22px;">
                                                                      <i class="fas fa-user"></i>
                                                                </div>`
                      }
                      <div>
                          <h6 class="mb-1">${comment.user.name}</h6>
                          <p class="mb-0 text-muted">${comment.body}</p>
                      </div>
                      <div class="dropdown ms-2 ms-auto">
                            <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item delete-comment-btn" href="#">Delete</a></li>
                            </ul>
                        </div>
                  </div>
              `);
                        });
                    }
                }).fail(function() {
                    list.html("<p style='color:red;'>Failed to load comments.</p>");
                });
            }

            // Handle add comment form submit
            $(document).on("submit", ".add-comment-form", function(e) {
                e.preventDefault();

                let form = $(this);
                let postId = form.data("post-id");
                let commentText = form.find("input[name='comment']").val();

                $.ajax({
                    url: `/posts/${postId}/comment`,
                    method: "POST",
                    data: {
                        comment: commentText
                    },
                    success: function(response) {
                        if (response.status === "success") {
                            let countElement = $(
                                '#comment-count'); // Example: span id="comment-count"
                            let currentCount = parseInt(countElement.text());
                            countElement.text(currentCount + 1);
                            form.find("input[name='comment']").val(""); // clear input
                            showComments(postId); // refresh comment list
                        } else {
                            alert(response.message || "Failed to add comment.");
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            alert("Please log in to comment.");
                        } else {
                            alert("Something went wrong.");
                        }
                    }
                });
            });
            $(document).on("click", ".delete-comment-btn", function(e) {
                e.preventDefault();

                let commentDiv = $(this).closest("[data-comment-id]");
                let commentId = commentDiv.data("comment-id");

                if (!confirm("Are you sure you want to delete this comment?")) return;

                $.ajax({
                    url: `/comments/${commentId}`,
                    type: "DELETE",
                    success: function(response) {
                        commentDiv.remove();
                        let countElement = $(
                            '#comment-count'); // Example: span id="comment-count"
                        let currentCount = parseInt(countElement.text());
                        countElement.text(currentCount - 1);
                    },
                    error: function() {
                        alert("Failed to delete comment.");
                    }
                });
            });

        });
    </script>
@endsection
