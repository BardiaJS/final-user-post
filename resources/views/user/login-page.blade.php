<x-login-layout>
    <form action="/login" method="POST" id="registration-form">
        @csrf
        <div class="form-group">
            <label for="email-register" class="text-muted mb-1"><small>Email</small></label>
            <input name="email" id="email-register" class="form-control" type="text" placeholder="you@example.com"
                autocomplete="off" />
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
</x-login-layout>
