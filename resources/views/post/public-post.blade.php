<x-public-post-layout>
    <div class="container py-md-5 container--narrow">


        <div class="list-group">
            @foreach ($posts as $post)
                <a href="/post/{{ $post->id }}" class="list-group-item list-group-item-action">
                    <p>
                    <img class="avatar-small" src="https://gravatar.com/avatar/b9408a09298632b5151200f3449434ef?s=128" />
                    <strong>{{$post->user->display_name}}</strong>
                    </p>
                    {{ $post->user->first_name }} {{ $post->user->last_name }}
                    <strong>{{ $post->name }}</strong> on {{ $post->created_at->format('n/j/Y') }}

                </a>
            @endforeach

        </div>
    </div>
</x-public-post-layout>
