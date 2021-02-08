<?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//})
//     ->name('welcome');

Route::get('{url}', function () {
    return view('spa');
})
     ->where('url', '.*');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')
     ->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')
     ->name('logout');

// Registration Routes...
if (config('auth.allow_register')) {
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')
         ->name('register');
    Route::post('register', 'Auth\RegisterController@register');
}

// Password Reset Routes...
if (config('auth.allow_reset')) {
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
         ->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
         ->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
         ->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')
         ->name('password.update');
}

// Password Confirmation Routes...
if (config('auth.confirm_password')) {
    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')
         ->name('password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');
}

// Email Verification Routes...
if (config('auth.confirm_email')) {
    Route::get('email/verify', 'Auth\VerificationController@show')
         ->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')
         ->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend')
         ->name('verification.resend');
}

Route::get('/home', 'HomeController@index')
     ->name('home');

Route::name('collections.')
     ->group(function () {

         Route::get('/collections/', 'CollectionController@index')
              ->name('index');

         Route::get('/collections/create', 'CollectionController@create')
              ->name('create');
         Route::post('/collections/create', 'CollectionController@store')
              ->name('store');

         Route::get('/collections/{collection}', 'CollectionController@show')
              ->name('show');
         Route::get('/collections/{collection}/edit', 'CollectionController@edit')
              ->name('edit');
         Route::put('/collections/{collection}/edit', 'CollectionController@update')
              ->name('update');
         Route::delete('/collections/{collection}/delete', 'CollectionController@destroy')
              ->name('destroy');
     });

Route::name('profiles.')
     ->group(function () {

         Route::prefix('/profiles/{profile}')
              ->group(function () {
                  Route::get('/create', 'ProfileController@create')
                       ->name('create');
                  Route::post('/create', 'ProfileController@store')
                       ->name('store');

                  Route::get('/', 'ProfileController@show')
                       ->name('show');
                  Route::put('/update', 'ProfileController@update')
                       ->name('update');
                  Route::delete('/delete', 'ProfileController@destroy')
                       ->name('destroy');

                  Route::prefix('/relations')
                       ->name('relations.')
                       ->group(function () {

                           Route::get('/create', 'ProfileRelationController@create')
                                ->name('create');
                           Route::post('/create', 'ProfileRelationController@store')
                                ->name('store');

                           Route::get('/{relation}', 'ProfileRelationController@edit')
                                ->name('edit');
                           Route::put('/{relation}/update', 'ProfileRelationController@update')
                                ->name('update');
                           Route::delete('/{relation}/delete', 'ProfileRelationController@destroy')
                                ->name('destroy');
                       });
              });
     });
