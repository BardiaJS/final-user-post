<x-layout>
    <div class="container py-md-5">
        <div class="row align-items-center">
            <div class="col-lg-7 py-3 py-md-5">
                <img src="register.gif">
            </div>
            <div class="col-lg-5 pl-lg-5 pb-3 py-lg-5">
                <form action="/register" method="POST" id="registration-form">
                    @csrf
                    <div class="form-group">
                        <label for="first_name-register" class="text-muted mb-1"><small>First Name</small></label>
                        <input value="{{old('first_name')}}" name="first_name" id="first_name-register" class="form-control" type="text"
                            placeholder="First Name" autocomplete="off" />

                        @error('first_name')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="last_name-register" class="text-muted mb-1"><small>Last Name</small></label>
                        <input value="{{old('last_name')}}" name="last_name" id="last_name-register" class="form-control" type="text"
                            placeholder="Last Name" autocomplete="off" />

                        @error('last_name')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="display_name-register" class="text-muted mb-1"><small>Display Name</small></label>
                        <input value="{{old('display_name')}}" name="display_name" id="display_name-register" class="form-control" type="text"
                            placeholder="Display Name" autocomplete="off" />

                        @error('display_name')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email-register" class="text-muted mb-1"><small>Email</small></label>
                        <input value="{{old('email')}}" name="email" id="email-register" class="form-control" type="text"
                            placeholder="you@example.com" autocomplete="off" />
                        @error('email')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-register" class="text-muted mb-1"><small>Password</small></label>
                        <input name="password" id="password-register" class="form-control" type="password"
                            placeholder="Create a password" />
                        @error('password')
                            <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    @auth
                        @if (auth()->user()->is_super_admin == true)
                            <div class="form-group">
                                <label for="is_admin" class="text-muted mb-1"><small>Is Admin?</small></label>
                                <input value="{{old('is_admin')}}" name="is_admin" id="is_admin-register-confirm" class="form-control" type="text"
                                    placeholder="Is Admin" />
                                @error('is_admin')
                                    <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                    @endauth
                    <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">Register</button>
                </form>
            </div>
        </div>
    </div>


</x-layout>
