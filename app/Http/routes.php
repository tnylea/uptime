<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'UptimeController@index');
Route::post('/check', 'UptimeController@check');
Route::post('/sendEmail', 'UptimeController@send');

Route::get('tst', function(){
	\Mail::raw('Uptime Status Error: Please check ' . \URL::to('/'), function($message)
		{
		    $message->from(getenv('EMAIL_ADDRESS'), 'Uptime Monitor');

		    $message->to(getenv('EMAIL_ADDRESS'));
		});
});