<?php 

Route::group(['prefix' => 'users',], function(){

Route::get('/add-user',[
	'as'=> 'users.add-user',
	'uses' => 'UserController@addUser'
]);

Route::post('/save-user',[
	'as' => 'users.save-user.post',
	'uses' => 'UserController@saveUser',
]);

Route::get('/view-user',[
	'as' => 'users.view-user',
	'uses' => 'UserController@viewUser',
]);

//Active Inactive route
Route::get('update-status/{modelReference}/{action}/{id}',[
	'as' =>'users.update-status',
	'uses' => 'UserController@statusUpdate'
]);

Route::get('/edit-user/{user_id}',[
	'as' => 'users.edit-user',
	'uses' => 'UserController@editUser',
]);

Route::post('/update-user/{user_id}',[
	'as' => 'users.update-user.post',
	'uses' => 'UserController@updateUser',
]);

});

