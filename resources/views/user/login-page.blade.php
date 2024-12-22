<x-login-layout>
    <div class="row align-items-center">

        <div class="col-lg-5 pl-lg-5 pb-3 py-lg-5">
            <form action="/login" method="POST" id="registration-form">
                @csrf
                <div class="form-group">
                    <label for="email-register" class="text-muted mb-1"><small>Email</small></label>
                    <input name="email" id="email-register" class="form-control" type="text"
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

                <button type="submit" class="py-3 mt-4 btn btn-lg btn-success btn-block">Login</button>
            </form>
        </div>
        <div class="col" style="display: flex; justify-content:center; align-items:center;">
            <img style="width: 400px; height:400px" src="login.gif">
        </div>
    </div>

</x-login-layout>
