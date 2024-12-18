<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use PHPUnit\Framework\Attributes\PostCondition;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home-page');
})->name('login');

//register
//  route for send data for REGISTER
Route::post('/register', [UserController::class, 'register'])->middleware('guest');


//login
//  Route for get the login form
Route::get('/login', function () {
    return view('user.login-page');
})->middleware('guest');
// Route for send data for LOGIN
Route::post('/login', [UserController::class, 'login'])->middleware('guest');



// Route for logged in user
Route::get('/welcome-page', function () {
    return view('user.home-logged-in-no-results');
})->middleware('mustBeLoggedIn');


// Route for changing password form
Route::get('/change-password-page' , function(){
    return view('user.change-password');
})->middleware('mustBeLoggedIn');
// Route for change the password data
Route::post('/change-password/{user}' , [UserController::class , 'change_password'])->middleware('mustBeLoggedIn');


// Route for create post form
Route::get('/create-post-page' , function(){
    return view('post.create-post-page');
})->middleware('mustBeLoggedIn');
// Route for create post data
Route::post('create-post' , [PostController::class , 'store_post'])->middleware('mustBeLoggedIn');

// Route for add thumbnail form
Route::get('/add-thumbnail/{post}' , function(){
    return view('ok-page');
})->middleware('mustBeLoggedIn');


// show a single post
Route::get('/post/{post}' , [PostController::class , 'single_post']);
// Route for get the profile page of the user
Route::get('/profile/{user}' , [UserController::class , 'profile']);










// Route for singing out
Route::post('/logout', [UserController::class, 'logout'])->middleware('mustBeLoggedIn');
