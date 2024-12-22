<x-post-list-layout>
    <div class="list-group">
        @foreach ($posts as $post)
            <a href="/post/{{ $post->id }}" class="list-group-item list-group-item-action">
                <img class="avatar-tiny" src="{{$post->user->avatar}}" />
                <strong>{{ $post->name }}</strong> on {{ $post->created_at->format('n/j/Y') }}
                @can('update', $post)
                    <span class="pt-2" style="display: flex; justify-content:center; align-items:center; ">
                        <form style="margin-right:10px;" class="delete-post-form d-inline" action="/edit-post-page/{{ $post->id }}" method="GET">
                            <button class="delete-post-button text-primary" data-toggle="tooltip" data-placement="top"
                                title="Edit"><i class="fas fa-edit"></i></button>
                        </form>
                        <form style="margin-right:10px; class="delete-post-form d-inline" action="/delete/{{ $post->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="delete-post-button text-danger" data-toggle="tooltip" data-placement="top"
                                title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </span>
                @endcan
                <h5 style="color:#929292; font-size:14px">is visible? {{ $post->is_visible }}</h5>
            </a>
        @endforeach


    </div>

</x-post-list-layout>
