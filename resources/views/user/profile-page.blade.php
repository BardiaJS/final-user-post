<x-profile-page-layout>
    <div class="container py-md-5 container--narrow">
        <h2>
            <img class="avatar-small" src="https://gravatar.com/avatar/b9408a09298632b5151200f3449434ef?s=128" />
            {{ $user->first_name }} {{ $user->last_name }}
        </h2>

        <div class="profile-nav nav nav-tabs pt-2 mb-4">
            <a class="profile-nav-link nav-item nav-link active">Posts: {{$post_count}}</a>
        </div>

        <div class="list-group">
            @foreach ($posts as $post)
                <a href="/post/{{$post->id}}" class="list-group-item list-group-item-action">
                    <img class="avatar-tiny" src="https://gravatar.com/avatar/b9408a09298632b5151200f3449434ef?s=128" />
                    <strong>{{$post->name}}</strong> on {{$post->created_at->format('n/j/Y')}}

                    <h5 style="color:#929292; font-size:14px">is visible? {{$post->is_visible}}</h5>
                </a>

            @endforeach

        </div>
    </div>


</x-profile-page-layout>
