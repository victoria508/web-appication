<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')
     ->get('/user', function (Request $request) {
         return $request->user();
     });

Route::name('profiles.')
     ->prefix('/profiles')
     ->group(function () {

         Route::get('/', 'ProfileController@index')
              ->name('index');
         Route::post('/', 'ProfileController@store')
              ->name('store');

         Route::prefix('/{profile}')
              ->group(function () {

                  Route::get('/', 'ProfileController@show')
                       ->name('show');
                  Route::patch('/', 'ProfileController@update')
                       ->name('update');
                  Route::delete('/', 'ProfileController@destroy')
                       ->name('destroy');

                  Route::prefix('/files')
                      ->name('files.')
                      ->group(function () {
                          Route::get('/', 'FileController@index')
                              ->name('show');

                          Route::post('/store', 'FileController@store')
                              ->name('store');

                          Route::post('/{file}/delete', 'FileController@delete')
                              ->name('delete');
                      });

              });
     });
