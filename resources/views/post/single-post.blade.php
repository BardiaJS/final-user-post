<x-single-post-layout :post="$post">
    <div class="container py-md-5 container--narrow">
        <p class="text-muted small mb-4">
            <a href="/profile/{{ $post->user->id }}"><img class="avatar-tiny" src="{{ $post->user->avatar }}"
                    style="" /></a>
            Posted by <a href="/profile/{{ $post->user->id }}">{{ $post->user->display_name }}</a> on
            {{ $post->created_at->format('n/j/Y') }}
        </p>
        <div class="d-flex justify-content-between">
            <div class="body-content">
                <img src="{{ $post->thumbnail }}">
            </div>

            @can('update', $post)
                <span class="pt-2">
                    <a href="/edit-post-page/{{ $post->id }}" class="text-primary mr-2" data-toggle="tooltip"
                        data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                    <form class="delete-post-form d-inline" action="/delete/{{ $post->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top"
                            title="Delete"><i class="fas fa-trash"></i></button>
                    </form>
                </span>
            @endcan
        </div>

        <div class="body-content">
            <h2>{{ $post->name }}</h2>

        </div>

        <div class="body-content">
            <p>{{ $post->content }}</p>
        </div>

        <div class="body-content">
            <p><strong>Tags: </strong>{{ $post->tags}}</p>
        </div>


    </div>

</x-single-post-layout>
