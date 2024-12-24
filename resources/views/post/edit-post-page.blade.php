<x-edit-post-layout :post="$post">
    <div class="container py-md-5">
        <div class="row align-items-center">

            <div class="col-lg-5 pl-lg-5 pb-3 py-lg-5">
                <form action="/update-post/{{$post->id}}" method="POST" id="registration-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name-register" class="text-muted mb-1"><small>Name</small></label>
                        <input value="{{old('name' , $post->name)}}" name="name" id="name-register" class="form-control" type="text"
                            placeholder="Post Name" autocomplete="off" />

                        @error('name')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content-register" class="text-muted mb-1"><small>Content</small></label>
                        <input value="{{old('content' , $post->content)}}" name="content" id="content-register" class="form-control" type="text"
                            placeholder="Post Content" autocomplete="off" />

                        @error('content')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="tags-register" class="text-muted mb-1"><small>Tags</small></label>
                        <input value="{{old('tags' , $post->tags)}}" name="tags" id="tags-register" class="form-control" type="text"
                            placeholder='tages (seprated by ",")' autocomplete="off" />

                        @error('tags')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="is_visible-register" class="text-muted mb-1"><small>Is Visible</small></label>
                        <input value="{{old('is_visible' , $post->is_visible)}}" name="is_visible" id="is_visible-register" class="form-control" type="text"
                            placeholder="Is Visible?" />
                        @error('is_visible')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-outline-primary" >Save Changes</button>

                </form>
            </div>
        </div>
    </div>
</x-edit-post-layout>
