<x-change-password-layout>
    <div class="container">
        <form action="/change-password/{{ auth()->user()->id }}" method="POST" id="registration-form">
            @csrf
            <div class="form-group">
                <label for="email-register" class="text-muted mb-1"><small>Current Password</small></label>
                <input name="password" id="email-register" class="form-control" type="password"
                    placeholder="Current Password" autocomplete="off" />
                @error('password')
                    <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-register" class="text-muted mb-1"><small>New Pasasword</small></label>
                <input name="new_password" id="password-register" class="form-control" type="New Password"
                    placeholder="New password" />
                @error('new_password')
                    <p class="m-0 small alert alert-danger shadow-sm">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="btn btn-outline-primary">Change Password</button>

        </form>
    </div>

</x-change-password-layout>
