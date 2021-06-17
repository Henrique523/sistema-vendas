<?php

Route::post('/agendar', 'SendMailController@sendMail');
Route::get('/usuarios', 'UserController@index');
