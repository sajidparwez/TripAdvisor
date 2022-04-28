<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [HomeController::class, 'index'])->name('index');


// Route::get('/loggeninpage', function () {

//     if (session('user_id')) {
//         return view('loggeninpage', ['user' => User::where('user_id', session('user_id'))
//             ->first()]);
//     }
//     return redirect('/');
// });



Route::get('/profile', function () {
    return view('profile');
});

//activate account
Route::get('/activate', [LoginController::class, 'activate'])->name('activate');
Route::get('/get-trips', [TripController::class, 'getTrips'])->name('getTrips');
Route::post('/add-trips', [TripController::class, 'addtrips'])->name('addtrips');
Route::get('/mytrips', [TripController::class, 'getTrips'])->name('mytrips');
// login

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/search', [SearchController::class, 'search'])->name('search');
Route::get('/query', [SearchController::class, 'query'])->name('query');
Route::post('/updatepicture', [ProfileController::class, 'updatepicture'])->name('updatepicture');
Route::post('/updateusername', [ProfileController::class, 'updateusername'])->name('updateusername');
Route::post('/updateemail', [ProfileController::class, 'updateemail'])->name('updateemail');
Route::post('/forgot-password', [LoginController::class, 'forgotPassword'])->name('forgotPassword');


Route::get('/logout', function () {

    if (session()->has('user_id')) {
        session()->flush();
        setcookie("rememberme", "", time() - 3600);
        return redirect('/');
    }
})->name('logout');

Route::post('/signup', [LoginController::class, 'signup'])->name('signup');