<?php

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
Auth::routes();
Route::get('/', 'HomeController@index');	// Route for index page

Route::group(['prefix' => 'profile'], function () {	// groupe de routes commencant par "profile"
    Route::get('{id}', 'ProfileController@show')->name('about');//route pour /profile/{id}, on récupère l'id, envoie controlr
    Route::get('edit/{id}', 'ProfileController@edit')->name('edit'); //route pour /profile/edit/{id}
    Route::get('photos/{id}', 'ProfileController@photos')->name('profilePhotos');
    Route::get('videos/{id}', 'ProfileController@videos')->name('profileVideos');
    Route::get('events/{id}', 'ProfileController@events')->name('profileEvents');
    Route::get('messages/{id}', 'ProfileController@messages')->name('userMessages');
});

 Route::post('editSubmit/{id}','ProfileController@editSubmit')->name('postEdit'); // route pour validation edit de profil
