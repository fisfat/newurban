<?php
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Pusher\Pusher;

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
Route::view('show', 'test');

Route::get('test', function () {
    
        //Remember to change this with your cluster name.
        $options = array(
            'cluster' => 'eu', 
            'encrypted' => true
        );
 
       //Remember to set your credentials below.
        $pusher = new Pusher(
            '312f996ef161d2be5d75',
            'b4e966827288a0099e13',
            '673239',
            $options
        );
        
        // $message= "Hello User";
        
        // //Send a message to notify channel with an event name of notify-event
        // $pusher->trigger('notify', 'notify-event', $message);  
        $data['message'] = 'hello world';
        $pusher->trigger('my-channel', 'my-event', $data);
    
});

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

Route::get('/arrayinput', 'ArticlesController@arrayinputget');
Route::post('/arrayinput/post', 'ArticlesController@arrayinput');
