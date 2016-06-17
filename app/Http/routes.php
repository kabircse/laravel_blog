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

/*Route::get('/','BlogController@index');
Route::get('/singlePost/{id}','BlogController@singlePost');*/
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
Route::group(['middleware' => 'web'], function () {
  Route::auth();
  Route::get('/', 'HomeController@index');
  Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);
  Route::get('/singlePost/{id}',['as'=>'home.singlePost', 'uses'=>'HomeController@post']);
  Route::controller('home','HomeController');
  Route::group(['middleware'=>'admin'],function(){
    Route::get('/admin',function(){
      return view('admin.index');
    });
    Route::resource('admin/users','AdminUsersController');
    Route::resource('admin/posts','AdminPostsController');
    Route::resource('admin/category','AdminCategoriesController');
    Route::resource('admin/comment','PostCommentsController');
    Route::resource('admin/comment/reply','CommentRepliesController');
  });
  Route::group(['middleware'=>'auth'],function(){
    Route::post('comment/reply','CommentRepliesController@createReply');
  });
});
