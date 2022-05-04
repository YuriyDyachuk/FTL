<?php

$leadsGroup = [
    [
        'short' => 'tr',
        'long' => 'Train'
    ],
    [
        'short' => 'car',
        'long' => 'Car'
    ],
    [
        'short' => 'wh',
        'long' => 'Warehouse'
    ]
];

Route::group(['namespace' => 'Leads', 'prefix' => 'leads'], function()use($leadsGroup){
    foreach ($leadsGroup as $item) {
        Route::get('/'.$item['short'].'/index', $item['long'].'Controller@index')->name('leads.'.$item['short'].'.index');
        Route::get('/'.$item['short'].'/create', $item['long'].'Controller@create')->name('leads.'.$item['short'].'.create');
        Route::get('/'.$item['short'].'/edit/{lead}', $item['long'].'Controller@edit')->name('leads.'.$item['short'].'.edit');
        Route::get('/'.$item['short'].'/update/{lead}', $item['long'].'Controller@update')->name('leads.'.$item['short'].'.update');
        Route::put('/'.$item['short'].'/validateForm', $item['long'].'Controller@validateForm')->name('leads.'.$item['short'].'.validateform');
        Route::put('/'.$item['short'].'/validateAndSave', $item['long'].'Controller@validateAndSave')->name('leads.'.$item['short'].'.validateandsave');
        Route::get('/'.$item['short'].'/leadssort', $item['long'].'Controller@sort')->name('leads.'.$item['short'].'.sort');
        Route::post('/'.$item['short'].'/destroy', $item['long'].'Controller@destroy')->name('leads.'.$item['short'].'.destroy');
    }
});
