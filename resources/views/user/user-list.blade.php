<x-user-list-layout>
    <div class="container py-md-5 container--narrow">



        <div class="list-group">
            @foreach ($users as $user)
                <div style="justify-content: center; " class="profile-nav nav nav-tabs pt-2 mb-4">
                    <a href="/profile/{{$user->id}}" class="profile-nav-link nav-item nav-link active">
                        <h2 style="justify-content: center;">
                            <img class="avatar-small"
                                src="https://gravatar.com/avatar/b9408a09298632b5151200f3449434ef?s=128" />
                            {{ $user->first_name }} {{ $user->last_name }}
                        </h2>
                        <h4 style="display:flex; align-items:center; justify-content: center;">
                            {{ $user->display_name }}
                        </h4>

                    </a>
                </div>

            @endforeach

        </div>
    </div>
</x-user-list-layout>
