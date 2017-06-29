<?php

use App\Events\MessagePosted;
use Illuminate\Support\Facades\Log;

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

Route::get('/chat', function () {
    return view('chat');
});

// Route::resource('user','UserController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('user/register', 'UserController@register');
// get stored messages
Route::get('/messages/{userId}', function($userId) {
	$authUserId = Auth::user()->id;
	$output = DB::table('messages')
		->leftJoin('users','users.id',	'=',	'messages.user_id')
		->join('receivers','receivers.message_id','=','messages.id')
		->where('messages.user_id','=',$authUserId)
		->where('receivers.user_id','=',$userId)
		->orWhere('messages.user_id','=',$userId)
		->where('receivers.user_id','=',$authUserId)
		->select('users.name as user','users.image','users.image_path','users.id as userId','messages.message','messages.file_path','messages.file_name','messages.type','messages.created_at as time','receivers.user_id as r_user_id')
		->orderBy("messages.id","asc")
		->get();
	return $output;
})->middleware('auth');


// post new messages
Route::post('/messages/{userId}', function($userId) {
	$user = Auth::user();
	$message = $user->messages()->create([
		'message'=>request()->get('message'),
		'type'=>request()->get('type'),
	]);

	$message->receivers()->create([
			'user_id'=>$userId
		]);
	// // new message has beed posted
	broadcast(new MessagePosted($message,$user,$userId))->toOthers();
	$output['message'] = $message;
	$output['user'] = $user;
	return ['output'=> $output];
})->middleware('auth');


Route::post('/fileUpload/{userId}',function($userId) {
	$file = request('file');
	$user = Auth::user();
	if (!empty($file)) {
        $fileName = $file->getClientOriginalName();
        // file with path
        $filePath = url('uploads/chats/'.$fileName);
        //Move Uploaded File
        $destinationPath = 'uploads/chats';
        if($file->move($destinationPath,$fileName)) {
            $request['file_path'] = $filePath;
            $request['file_name'] = $fileName;
            $request['message'] = 'file';
            $request['type'] = request('type');
        }

        $message = $user->messages()->create($request);

		$message->receivers()->create([
				'user_id'=>$userId
			]);

		$output = [];
		broadcast(new MessagePosted($message,$user,$userId))->toOthers();

		$output['message'] = $message;
		$output['user'] = $user;
		return ['output'=> $output];

    }

})->middleware('auth');

Route::get('/users', function() {
	$authUserId = Auth::user()->id;
	$users = DB::table('users')
			->where('users.id','!=',$authUserId)
			->get();
	return $users;
})->middleware('auth');
