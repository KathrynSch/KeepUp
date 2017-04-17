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
    Route::get('{id}', 'ProfileController@show')->name('profile');	//route pour /profile/{id}, on récupère l'id, envoie controlr
    Route::get('edit/{id}', 'ProfileController@edit')->name('edit'); //route pour /profile/edit/{id}
});

 Route::post('editSubmit/{id}','ProfileController@editSubmit')->name('postEdit'); // route pour validation edit de profil
