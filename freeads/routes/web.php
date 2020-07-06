<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;


Route::get('/index', function () {
    return view('home');
});

Route::get('profile', function () {
    echo 'page profile';
})->middleware('verified');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/profile', 'ProfileController@profil')->name('profile');
Route::resource('users', 'UserController');
Route::post('/profile_update', 'UserController@update')->name('profile_update');
Route::post('/deleteaccount', 'UserController@destroy')->name('deleteaccount');

Route::get('/', function () {
    return view('home');
});

// Authentication Routes...
Route::prefix('connexion')->group(function () {
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/', 'Auth\LoginController@login');
});
Route::post('deconnexion', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
Route::prefix('enregistrement')->group(function () {
    Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/', 'Auth\RegisterController@register');
});
// Password Reset Routes...
Route::prefix('passe')->group(function () {
    Route::get('change', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('change/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('change', 'Auth\ResetPasswordController@reset')->name('password.update');
});

Route::resource('annonces', 'AdController')
    ->parameters([
        'annonces' => 'ad'
    ])->except([
        'index', 'show', 'destroy'
    ]);

Route::prefix('annonces')->group(function () {
    Route::get('voir/{ad}', 'AdController@show')->name('annonces.show');
    Route::patch('voir/{ad}', 'AdController@edit')->name(' annonces/{ad}/edit');
    Route::get('{region?}/{departement?}/{commune?}', 'AdController@index')->name('annonces.index');
    Route::post('recherche', 'AdController@search')->name('annonces.search')->middleware('ajax');
});


Route::middleware('ajax')->group(function () {
    Route::post('images-save', 'UploadImagesController@store')->name('save-images');
    Route::delete('images-delete', 'UploadImagesController@destroy')->name('destroy-images');
    Route::get('images-server', 'UploadImagesController@getServerImages')->name('server-images');
});

Route::middleware('ajax')->group(function () {
    Route::post('message',
        'UserController@message')->name('message');
});
