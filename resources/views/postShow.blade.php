@extends('layout.user')
@section('title','post-show blog website')
@section('container')
<div class="container py-5">
    <!-- Post Card -->
    
    <div class="card mb-4">
         <img src="{{asset('storage/'.$posts->image)}}" class="card-img-top" alt="Post Image">
        <div class="card-body">
            <h3 class="card-title">{{$posts->title}}</h3>
            <p class="card-text">{{$posts->content}}</p>
        </div>
    </div>

    <!-- Comment Section -->
    <div class="comments-section card mb-4" id="comments-section-{{ $posts->id }}">
        <div class="card-header">
            <h5>Comments</h5>
        </div>        
        <div class="comments-list p-2"></div>

    </div>

    <!-- Add Comment Form -->
    <div class="card">
        <div class="card-header">
            <h5>Leave a Comment</h5>
        </div>
        <div class="card-body">
            <form action="{{route('add.comment',$posts->id)}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="comment" class="form-label">Your Comment</label>
                    <textarea class="form-control" id="comment" rows="3" placeholder="Write your comment here..." name="comment"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$(document).ready(function(){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    function showComments(postId) {
        let section = $("#comments-section-" + postId);
        let list = section.find(".comments-list");

        section.show(); // Always show
        list.html("<p>Loading...</p>"); // Feedback while loading

        $.get(`/posts/${postId}/comments`, function (data) {
            list.empty();

            if (!data || data.length === 0) {
                list.append("<p>No comments yet.</p>");
            } else {
                data.forEach(function (comment) {
                list.append(`
                    <div class="d-flex align-items-start mb-3 p-2 border rounded shadow-sm bg-light" data-comment-id="${comment.id}">
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
        }).fail(function () {
            list.html("<p style='color:red;'>Failed to load comments.</p>");
        });
    }
    showComments({{ $posts->id }});

    // Handle form submit via AJAX
    $("form[action='{{ route('add.comment', $posts->id) }}']").on("submit", function(e){
        e.preventDefault();

        let form = $(this);
        let postId = {{ $posts->id }};
        let formData = form.serialize();

        $.post(`/posts/${postId}/comment`, formData, function(response){
            if(response.status === "success") {
                $("#comment").val(""); // clear textarea
                showComments(postId); // reload comments instantly
            } else {
                alert("Something went wrong!");
            }
        }).fail(function(){
            alert("Failed to post comment.");
        });
    });
    $(document).on("click", ".delete-comment-btn", function (e) {
        e.preventDefault();

        let commentDiv = $(this).closest("[data-comment-id]");
        let commentId = commentDiv.data("comment-id");

        if (!confirm("Are you sure you want to delete this comment?")) return;

        $.ajax({
            url: `/comments/${commentId}`,
            type: "DELETE",
            success: function (response) {
                commentDiv.remove();
            },
            error: function () {
                alert("Failed to delete comment.");
            }
        });
    });
});
</script>

@endsection

