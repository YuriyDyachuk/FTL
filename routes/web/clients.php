<?php

Route::resource('clients', 'ClientController');
Route::put('Clients/validateAndSave', 'ClientController@validateAndSave')->name('clients.validateandsave');
Route::post('Clients/addImage','ClientController@addImage')->name('clients.addimage');
