<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::get('/tasks', function(Request $request){ 

// in postmain http://localhost:8000/api/tasks 

	$tasks = DB::select('SELECT * FROM tasks');

	//$json = [
	//	'message' => 'hello JSON' // dictionary 
		// 'message' is the key and 'hello JSON' is the values
	//];
	
	return response()->json($tasks); 

});


Route::post('/tasks', function(Request $request){
	//String content = request.input("tasks_content"); java 
	$content = $request -> input('tasks_content');

	$value = DB::insert('INSERT INTO tasks(content, finished) VALUES (?,?)', [$content, false]); 
	$json = ['message' => $value];
	return response() ->json($json);

});

Route::patch('/tasks/{id}/finished', function(Request $request, $id){
	DB::update('UPDATE tasks SET finished = 1 WHERE id = ?', [$id]);
	return response() -> json(['id' => $id]);

});


Route::delete('/tasks/{id}', function(Request $request, $id){
	DB::delete('DELETE FROM tasks WHERE id = ?', [$id]);
	return response() -> json(['message' => 'Deleted']);
});











