<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
//Route::get('/', 'App\HTTP\Controllers\BlogController@Index');
Route::get('/contact', 'App\Http\Controllers\ContactController@index')->name('contact');
Route::get('/users', 'App\Http\Controllers\TestController@index');
Route::get('/about', 'App\Http\Controllers\AboutController@index',['as'=>'sveta']);
Route::get('/admin', 'App\Http\Controllers\Admin\DashboardController')->name('lele');

Route::redirect('old-about', 'about', 301);

Route::group(['prefix'=>'blog'], function(){
Route::get('','App\Http\Controllers\BlogController@index' )->name('blog');
// Route::get('user/{id}', 'App\HTTP\Controllers\BlogController@postsByUser')->name('user');
// Route::get('show/{id}', 'App\Http\Controllers\BlogController@show')->name('show');
// Route::get('resent','App\Http\Controllers\BlogController@resent')->name('resent');
});
Route::get('user/{id}', 'App\Http\Controllers\BlogController@postsByUser')->name('user');
Route::get('/{slug}','App\Http\Controllers\BlogController@show')->name('show');
Route::get('like/{id}', 'App\Http\Controllers\BlogController@like')->name('like');
Route::get('category/{id}', 'App\Http\Controllers\BlogController@postByCategory')->name('category');
// Route::namespace('App\Http\Controllers')->name('blog.')->prefix('blog')->group(function(){
// // Route::get('','BlogController@index' )->name('blog');
// // Route::get('show/{id}', 'BlogController@show')->name('show');
// Route::get('resent','BlogController@resent')->name('resent');
// Route::resource('', 'BlogController')->only(['index','show']);
// });
// Route::get('blog','App\Http\Controllers\BlogController@index')->name('blog');
// Route::get('blog/{id}','App\Http\Controllers\BlogController@show')->name('blog.show');

// Route::name('admin.')->prefix('cms')->group(function(){
//     Route::get('','App\Http\Controllers\Admin\DashboardController')->name('index');
// });

// Route::namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('cms')->group(function(){
//     Route::get('','DashboardController')->name('index');
//     Route::resource('posts', 'PostController');
//     Route::resource('categories', 'CategoryController');

// });
Route::get('admin/categories', 'App\Http\Controllers\Admin\CategoryController@index')->name("categories");
Route::get('admin/categories/create', 'App\Http\Controllers\Admin\CategoryController@create')->name('category.create');
Route::post('admin/categories/create', 'App\Http\Controllers\Admin\CategoryController@store')->name('category.store');
Route::get('admin/categories/show/{id}', 'App\Http\Controllers\Admin\CategoryController@show')->name('category.show');
Route::get('admin/categories/edit/{id}', 'App\Http\Controllers\Admin\CategoryController@edit')->name('category.edit');
Route::put('admin/categories/update/{id}', 'App\Http\Controllers\Admin\CategoryController@update')->name('category.update');
// Route::get('admin.categories/trashed', 'App\Http\CategoryController@trashed')->name('categories.trashed');
Route::delete('admin/categories/delete/{id}', 'App\Http\Controllers\Admin\CategoryController@destroy')->name('category.delete');
Route::get('admin/categories/trashed', 'App\Http\Controllers\Admin\CategoryController@trashed')->name('category.trashed');
Route::post('admin/categories/restore/{id}', 'App\Http\Controllers\Admin\CategoryController@restore')->name('category.restore');
Route::delete('admin/categories/force/{id}', 'App\Http\Controllers\Admin\CategoryController@force')->name('category.force');

//Posts
Route::get('admin/posts', 'App\Http\Controllers\Admin\PostController@index')->name('posts');
Route::get('admin/posts/create', 'App\Http\Controllers\Admin\PostController@create')->name('post.create');
Route::post('admin/posts/create', 'App\Http\Controllers\Admin\PostController@store')->name('post.store');
Route::get('admin/posts/show/{id}', 'App\Http\Controllers\Admin\PostController@show')->name('post.show');
Route::get('admin/posts/edit/{id}', 'App\Http\Controllers\Admin\PostController@edit')->name('post.edit');
Route::put('admin/posts/update/{id}', 'App\Http\Controllers\Admin\PostController@update')->name('post.update');
Route::delete('admin/posts/delete/{id}', 'App\Http\Controllers\Admin\PostController@destroy')->name('post.delete');
Route::get('admin/posts/trashed', 'App\Http\Controllers\Admin\PostController@trashed')->name('post.trashed');
Route::post('admin/posts/restore/{id}', 'App\Http\Controllers\Admin\PostController@restore')->name('post.restore');
Route::delete('admin/posts/force/{id}', 'App\Http\Controllers\Admin\PostController@force')->name('post.force');

//Tags
Route::get('admin/tags', 'App\Http\Controllers\Admin\TagController@index')->name("tags");
Route::get('admin/tags/create', 'App\Http\Controllers\Admin\TagController@create')->name('tags.create');
Route::post('admin/tags/create', 'App\Http\Controllers\Admin\TagController@store')->name('tags.store');
Route::get('admin/tags/show/{id}', 'App\Http\Controllers\Admin\TagController@show')->name('tags.show');
Route::get('admin/tags/edit/{id}', 'App\Http\Controllers\Admin\TagController@edit')->name('tags.edit');
Route::put('admin/tags/update/{id}', 'App\Http\Controllers\Admin\TagController@update')->name('tags.update');
// Route::get('admin/tags/trashed', 'App\Http\TagController@trashed')->name('tags.trashed');
Route::delete('admin/tags/delete/{id}', 'App\Http\Controllers\Admin\TagController@destroy')->name('tags.delete');
Route::get('admin/tags/trashed', 'App\Http\Controllers\Admin\TagController@trashed')->name('tags.trashed');
Route::post('admin/tags/restore/{id}', 'App\Http\Controllers\Admin\TagController@restore')->name('tags.restore');
Route::delete('admin/tags/force/{id}', 'App\Http\Controllers\Admin\TagController@force')->name('tags.force');



Route::get('admin/users', 'App\Http\Controllers\Admin\UserController@index')->name('users');
Route::get('admin/users/create', 'App\Http\Controllers\Admin\UserController@create')->name('user.create');
Route::post('admin/users/create', 'App\Http\Controllers\Admin\UserController@store')->name('user.store');
Route::get('admin/users/show/{id}', 'App\Http\Controllers\Admin\UserController@show')->name('user.show');
Route::get('admin/users/edit/{id}', 'App\Http\Controllers\Admin\UserController@edit')->name('user.edit');
Route::put('admin/users/update/{id}', 'App\Http\Controllers\Admin\UserController@update')->name('user.update');
Route::delete('admin/users/delete/{id}', 'App\Http\Controllers\Admin\UserController@destroy')->name('user.delete');
Route::get('admin/users/trashed', 'App\Http\Controllers\Admin\UserController@trashed')->name('user.trashed');
Route::post('admin/users/restore/{id}', 'App\Http\Controllers\Admin\UserController@restore')->name('user.restore');
Route::delete('admin/users/force/{id}', 'App\Http\Controllers\Admin\UserController@force')->name('user.force');


//Route::get('/contact','App\Http\Controllers\ContactController@index')->name('contact');

Route::get('profiles', 'App\Http\Controllers\ProfileController@index')->name('profiles');

Route::match(['get', 'post'], '/foo', function () {
    return "this is Foo";

});

Route::any('/bar', function () {
    return "this is Bar";

});





Route::fallback(function () {
    return "<h2>oooops... How you have trapped here?</h>";
});

