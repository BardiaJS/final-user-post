<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function register(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->is_super_admin == 1) {
                $validated = $request->validate([
                    'first_name' => ['required', 'max:10'],
                    'last_name' => ['required', 'max:30'],
                    'display_name' => ['required', 'max:10', 'regex:/^\S*$/'],
                    'email' => ['required', 'email', Rule::unique('users', 'email')],
                    'password' => ['required', 'min:6'],
                    'is_admin' => ['required', 'in:true,false']
                ]);
                User::create($validated);
                return redirect('/')->with('success', "You successfully create the user!");
            } else if (Auth::user()->is_admin == 1) {
                $validated = $request->validate([
                    'first_name' => ['required', 'max:10'],
                    'last_name' => ['required', 'max:30'],
                    'display_name' => ['required', 'max:10', 'regex:/^\S*$/'],
                    'email' => ['required', 'email', Rule::unique('users', 'email')],
                    'password' => ['required', 'min:6'],
                    'is_admin' => ['sometimes']
                ]);
                User::create($validated);
                return redirect('/welcome-page')->with('success', "You successfully create the user!");
            }
        } else {
            $validated = $request->validate([
                'first_name' => ['required', 'max:10'],
                'last_name' => ['required', 'max:30'],
                'display_name' => ['required', 'max:10', 'regex:/^\S*$/'],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => ['required', 'min:6'],
                'is_admin' => ['sometimes']
            ]);
            $user = User::create($validated);
            auth()->login($user);
            return redirect('/welcome-page')->with('success', "You successfully Sign Up!");
        }
    }

    public function login(request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        if (auth()->attempt($validated)) {
            $request->session()->regenerate();
            return redirect('/welcome-page')->with('success', 'You are logged in successfully!');
        } else {
            return redirect('/')->with('failure', 'Invalid data!');
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect('/')->with('success', 'You successfully logged out!');
    }


    public function change_password(Request $request, User $user)
    {
        $is_super_admin = Auth::user()->is_super_admin;
        $is_admin = Auth::user()->is_admin;
        if ($is_super_admin == true) {
            $validated = $request->validate([
                'password' => 'required',
                'new_password' => 'required_without_all|min:6|different:password'
            ]);
            $validated['password'] = Hash::make($validated['new_password']);
            $user->update($validated);
            return redirect('/welcome-page')->with('success', 'You successfully changed the password!');
        } else if ($is_admin == true) {
            if ($user->is_admin == 0 and $user->is_super_admin == 0) {
                $validated = $request->validate([
                    'password' => 'required',
                    'new_password' => 'required_without_all|min:6|different:password'
                ]);
                $validated['password'] = Hash::make($validated['new_password']);
                $user->update($validated);
                return redirect('/welcome-page')->with('success', 'You successfully changed the password!');
            } else {
                return redirect('/change-password-page')->with('failure', 'You cannot do that!');
            }
        } else {
            if (Auth::user()->id == $user->id) {
                $validated = $request->validate([
                    'password' => 'required',
                    'new_password' => 'required_without_all|min:6|different:password'
                ]);
                $isCheck = (bool) $validated['password'] == Auth::user()->password;
                if ($isCheck) {
                    $validated['password'] = Hash::make($validated['new_password']);
                    $user->update($validated);
                    return redirect('/welcome-page')->with('success', 'You successfully changed the password!');
                }
            } else {
                return redirect('/change-password-page')->with('success', 'You cannot do that!');
            }
        }
    }

    public function profile(User $user)
    {
        $user_related_posts = $user->posts()->latest()->paginate(5);
        return view('user.profile-page', ['user' => $user, 'posts' => $user_related_posts, 'post_count' => $user->posts()->count()]);
    }
    public function user_list()
    {
        if (Auth::user()->is_super_admin == true or Auth::user()->is_admin == true) {
            $users = User::paginate(10);
            return view('user.user-list', ['users' => $users]);
        }
    }

    public function upload_change_avatar(Request $request, User $user)
    {
        if (!empty($request['avatar'])) {
            $user_id = $user->id;
            $request->validate([
                'avatar' => 'nullable|image|max:3000', // Validate image
            ]);
            $fileName = $user->id . '_' . uniqid() . '.jpg';
            $imageData = Image::make($request->file('avatar'))->fit(120)->encode('jpg');
            Storage::put('public/avatars/' . $fileName, $imageData);
            $oldavatar = $user->avatar;
            $user->avatar = $fileName;
            $user->save();

            if ($oldavatar != "/fallback-avatar.jpg") {
                Storage::delete(str_replace("/storage/", "public", $oldavatar));
            }
            return redirect("/profile/$user_id")->with('success', 'avatar successfully uploaded!');
        } else {
            return back()->with("failure", "you cannot upload nothing!");
        }
    }

    public function change_user_information(Request $request, User $user)
    {

        if (Auth::check()) {
            if (Auth::user()->is_super_admin == 1) {
                $validated = $request->validate([
                    'first_name' => ['sometimes', 'max:10'],
                    'last_name' => ['sometimes', 'max:30'],
                    'display_name' => ['sometimes', 'max:10', 'regex:/^\S*$/'],
                    'email' => ['sometimes', 'email', Rule::unique('users', 'email')],
                    'password' => ['sometimes', 'min:6'],
                    'is_admin' => ['sometimes', 'in:true,false']
                ]);
                $user->update($validated);
                return redirect('/welcome-page')->with('success', "You successfully updated the user!");
            } else if (Auth::user()->is_admin == 1) {
                $validated = $request->validate([
                    'first_name' => ['sometimes', 'max:10'],
                    'last_name' => ['sometimes', 'max:30'],
                    'display_name' => ['sometimes', 'max:10', 'regex:/^\S*$/'],
                    'email' => ['sometimes', 'email', Rule::unique('users', 'email')],
                    'password' => ['sometimes', 'min:6'],
                    'is_admin' => ['sometimes']
                ]);
                $user->update($validated);
                return redirect('/welcome-page')->with('success', "You successfully updated the user!");
            } else {
                $validated = $request->validate([
                    'first_name' => ['sometimes', 'max:10'],
                    'last_name' => ['sometimes', 'max:30'],
                    'display_name' => ['sometimes', 'max:10', 'regex:/^\S*$/'],
                    'email' => ['sometimes', 'email', Rule::unique('users', 'email')],
                    'password' => ['sometimes', 'min:6'],
                    'is_admin' => ['sometimes']
                ]);
                $user->update($validated);
                return redirect('/welcome-page')->with('success', "You successfully update!");
            }
        }
    }


    public function delete(User $user)
    {
        if (auth()->user()->cannot('delete', $user)) {
            return 'You cannot do that!';
        } else {
            $user->delete();
            return redirect("/list/users")->with('success', 'You successfully deleted the user');
        }
    }
}
