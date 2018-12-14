<?php
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

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

Route::get('/', 'HomeController@index');

Route::get('/check', function(){
    return FisfatUser::get_username(1);
})->middleware('isAdmin');

Auth::routes();
Route::get('/mail', 'Admincontroller@send');

//Route::get('/home', 'HomeController@index')->name('home');
Route::resource('articles', 'ArticlesController')->middleware('isActive');
Route::resource('/admin/user', 'AdminController');
Route::resource('comments', 'CommentsController');
Route::Post('/articles/get', function(Request $request){
    return FisfatUser::get_request($request);
})->middleware('auth');


Route::get('/search', function(){
     $querys = Input::get('req');
     return FisfatUser::find_user($querys);
})->middleware('isAdmin');

Route::get('/find', function(){
    $querys = Input::get('req');
    return FisfatUser::find_post($querys);
});
