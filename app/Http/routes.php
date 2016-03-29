<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
//        Alert::error('There is an error', 'Error')->autoclose(2000);
        return view('home');
    });

    Route::get('/about', 'PagesController@about');
    Route::get('/contact', 'PagesController@contact');
    Route::get('/blog', 'BlogController@index');

    Route::get('login/facebook', 'Auth\AuthController@redirectToFacebook');
    Route::get('login/facebook/callback', 'Auth\AuthController@getFacebookCallback');

    Route::get('users/register', 'Auth\AuthController@getRegister');
    Route::post('users/register', 'Auth\AuthController@postRegister');

    Route::get('users/login', 'Auth\AuthController@getLogin');
    Route::post('users/login', 'Auth\AuthController@postLogin');

    Route::auth();

    Route::post('upload', 'ImagesController@store');
    Route::post('imageupload', 'ImagesController@storeImage');
    Route::post('cropimage', 'ImagesController@storeCroppedImage');

    Route::get('/home', 'HomeController@index');

    Route::get('json', function () {
        return App\Post::paginate();
    });

});



Route::group(['prefix' => 'api/v1', 'middleware' => ['api', 'cors']], function(){
    Route::resource('posts', 'PostsController');
});
