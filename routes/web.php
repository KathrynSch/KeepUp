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
Route::post('search/', 'HomeController@search')->name('search'); //Route for search bar

Route::group(['prefix' => 'profile'], function () {	// groupe de routes commencant par "profile"
    Route::get('{id}', 'ProfileController@show')->name('about');//route pour /profile/{id}, on récupère l'id, envoie controler
    Route::get('edit/{id}', 'ProfileController@edit')->name('edit'); //route pour /profile/edit/{id}
    Route::get('photos/{id}', 'ProfileController@photos')->name('profilePhotos');
    Route::get('videos/{id}', 'ProfileController@videos')->name('profileVideos');
    Route::get('events/{id}', 'ProfileController@events')->name('profileEvents');
    Route::get('messages/{id}', 'ProfileController@messages')->name('userMessages');
    Route::get('photos/add/{id}', 'PostController@addPhoto')->name('addPhoto');
    Route::get('videos/add/{id}', 'PostController@addVideo')->name('addVideo');
    Route::get('event/add/{id}', 'PostController@addEvent')->name('addEvent');

    Route::get('unfollow/{id}','ProfileController@unfollow')->name('unfollow');
    Route::get('follow/{id}','ProfileController@follow')->name('follow');

    //reactions
    Route::get('likes/{id}', 'PostController@likes')->name('likes');	//envoie id post
    Route::get('loves/{id}', 'PostController@loves')->name('loves');
    Route::get('laughs/{id}', 'PostController@laughs')->name('laughs');
    Route::get('hates/{id}', 'PostController@hates')->name('hates');
    Route::get('deletePhoto/{id}','PostController@deletePhoto')->name('deletePhoto');
    Route::get('deleteVideo/{id}','PostController@deleteVideo')->name('deleteVideo');
    Route::get('deleteEvent/{id}','PostController@deleteEvent')->name('deleteEvent');







});

Route::post('editSubmit/{id}','ProfileController@editSubmit')->name('postEdit'); // route pour validation edit de profil
Route::post('addPhotoSubmit/{id}','PostController@addPhotoSubmit')->name('postAddPhoto'); 
Route::post('addVideoSubmit/{id}','PostController@addVideoSubmit')->name('postAddVideo');
Route::post('addEventSubmit/{id}', 'PostController@addEventSubmit')->name('postAddEvent'); 
Route::post('photos/comment/{id_post}', 'PostController@addComment')->name('postComment');