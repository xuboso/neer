<?php

use Neer\Foundation\Http\Route;

//Route::get('/hello', 'HelloController@index');
//Route::get('/home', 'HelloController@home');
Route::get("/test/{name}", 'TestController@sayHello');