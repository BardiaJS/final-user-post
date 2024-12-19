<x-single-post-layout :post="$post">
    <div class="container py-md-5 container--narrow">
        <div class="d-flex justify-content-between">
            <h2>{{ $post->name }}</h2>
            @can('update', $post)
                <span class="pt-2">
                    <a href="/edit-post-page/{{$post->id}}" class="text-primary mr-2" data-toggle="tooltip" data-placement="top" title="Edit"><i
                            class="fas fa-edit"></i></a>
                    <form class="delete-post-form d-inline" action="/delete/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top"
                            title="Delete"><i class="fas fa-trash"></i></button>
                    </form>
                </span>
            @endcan
        </div>

        <p class="text-muted small mb-4">
            <a href="#"><img class="avatar-tiny"
                    src="https://gravatar.com/avatar/f64fc44c03a8a7eb1d52502950879659?s=128" /></a>
            Posted by <a href="/profile/{{$post->user->id}}">{{ $post->user->display_name }}</a> on {{ $post->created_at->format('n/j/Y') }}
        </p>

        <div class="body-content">
            <p>{{ $post->content }}</p>
        </div>

        <div class="body-content" style="background: #f0eeeb">
            <p><strong style="background: #b6b5b4">Is Visible? </strong>{{ $post->is_visible }}</p>
        </div>

        <div class="body-content" style="background: #f0eeeb">
            <p><strong style="background: #b6b5b4">Tags: </strong>{{ $post->tags }}</p>
        </div>

        <div class="body-content">

        </div>
    </div>

</x-single-post-layout>
