<?php

use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/noticias', NoticiaController::class);

Route::resource('/roles', RoleController::class);

Route::resource('/permissions', PermissionController::class);

Route::resource('/users', UserController::class);

Route::get('/auth/redirect', function () {
return Socialite::driver('google')->redirect();
})->name('google.login');

Route::get('/auth/callback', function () {
$googleUser = Socialite::driver('google')->user();
dd($googleUser);
$user = User::firstOrCreate([
"email" => $googleUser->email
],[
"name" => $googleUser->name,
"admin" => 0
]);
Auth::login($user);

return redirect('/dashboard');
})->name('google.callback');
require __DIR__.'/auth.php';