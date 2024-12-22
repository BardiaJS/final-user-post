<x-user-list-layout>
    <div class="container py-md-5 container--narrow">



        <div class="list-group">
            @foreach ($users as $user)
                <div style="justify-content: center; " class="profile-nav nav  pt-2 mb-4">
                    <a href="/profile/{{ $user->id }}" class="profile-nav-link nav-item nav-link active">
                        <h2 style="justify-content: center;">
                            <img class="avatar-small" src="{{ $user->avatar }}" />
                            {{ $user->first_name }} {{ $user->last_name }}
                        </h2>
                        <h4 style="display:flex; align-items:center; justify-content: center;">
                            {{ $user->display_name }}
                        </h4>

                    </a>
                    <div class="d-flex justify-content-between">

                        @can('update', $user)
                            <span class="pt-2">
                                @if (Auth::user() != $user)
                                    <a href="/change-user-information/{{ $user->id }}" class="text-primary mr-2"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fas fa-edit"></i></a>
                                @endif
                                <form class="delete-post-form d-inline" action="/delete/user/{{ $user->id }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @if (Auth::user() != $user)
                                        <button class="delete-post-button text-danger" data-toggle="tooltip"
                                            data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                                    @endif
                                </form>
                            </span>
                        @endcan
                    </div>
                </div>
            @endforeach

            <div class="mt-4">
                {{ $users->links() }}
            </div>


        </div>
</x-user-list-layout>
