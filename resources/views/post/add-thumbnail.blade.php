<x-add-thumbnail-layout>
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


            <img data-toggle="tooltip" data-placement="bottom"
                style="width:200px; height: 200px; clip-path:circle(); margin-top:30px; margin-bottom:30px"
                src="{{ $post->thumbnail }}" />

        <form method="POST" action="/upload-thumbnail/{{ $post->id }}" enctype="multipart/form-data">
            @csrf
            <input type="file" class="form-control" name="thumbnail" />
            <button type="submit" class="btn btn-success" style="margin-top: 30px">Upload</button>
        </form>
        <form method="GET" action="/upload-thumbnail/{{ $post->id }}" enctype="multipart/form-data">
            <button type="submit" class="btn btn-success" style="margin-top: 30px; margin-bottom:30px">Next</button>
        </form>
    </div>
</x-add-thumbnail-layout>
