<?php

Route::get('/dashboard',[
	'as'=>'dashboard',
	'uses'=>'DashboardController@dashboard',
]);

