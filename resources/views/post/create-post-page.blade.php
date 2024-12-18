<x-create-post-layout>
    <div class="container py-md-5">
        <div class="row align-items-center">

            <div class="col-lg-5 pl-lg-5 pb-3 py-lg-5">
                <form action="/create-post" method="POST" id="registration-form">
                    @csrf
                    <div class="form-group">
                        <label for="name-register" class="text-muted mb-1"><small>Name</small></label>
                        <input name="name" id="name-register" class="form-control" type="text"
                            placeholder="Post Name" autocomplete="off" />

                        @error('name')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content-register" class="text-muted mb-1"><small>Content</small></label>
                        <input name="content" id="content-register" class="form-control" type="text"
                            placeholder="Post Content" autocomplete="off" />

                        @error('content')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="tags-register" class="text-muted mb-1"><small>Tags</small></label>
                        <input name="tags" id="tags-register" class="form-control" type="text"
                            placeholder='tages (seprated by ",")' autocomplete="off" />

                        @error('tags')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="is_visible-register" class="text-muted mb-1"><small>Is Visible</small></label>
                        <input name="is_visible" id="is_visible-register" class="form-control" type="password"
                            placeholder="Create a password" />
                        @error('is_visible')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    @auth
                        @if (auth()->user()->is_super_admin == true)
                            <div class="form-group">
                                <label for="is_admin" class="text-muted mb-1"><small>Is Admin?</small></label>
                                <input name="is_admin" id="is_admin-register-confirm" class="form-control" type="text"
                                    placeholder="Is Admin" />
                                @error('is_admin')
                                    <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                    @endauth
                    <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">Post</button>
                </form>
            </div>
        </div>
    </div>
</x-create-post-layout>
