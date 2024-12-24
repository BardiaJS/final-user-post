<x-add-thumbnail-layout :user="$user">
    <div id="contact" class="container"
        style="text-align: center; display:block; justify-content:center; align-items:center">

        <h1 class="text-center" style="margin-top: 100px">Image Upload</h1>
        @error('avatar')
            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
        @enderror
        {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
            </div>
        @endif --}}

        @if ($user->avatar)
            <img data-toggle="tooltip" data-placement="bottom"
                style="width:200px; height: 200px; clip-path:circle(); margin-top:30px; margin-bottom:30px"
                src="{{ $user->avatar }}" />
        @endif
        <form method="POST" action="/upload-avatar/{{ $user->id }}" enctype="multipart/form-data">
            @csrf
            <input type="file" class="form-control" name="avatar" />
            <button type="submit" class="btn btn-outline-primary" style="margin-top: 30px">Upload</button>
        </form>
        <form method="GET" action="/profile/{{ $user->id }}" enctype="multipart/form-data">
            <button type="submit" class="btn btn-outline-primary" style="margin-top: 30px; margin-bottom:30px">Next</button>

        </form>
    </div>
</x-add-thumbnail-layout>
