<?php

$data = [
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

//Route::resource('clientrequests', 'ClientRequestsController', ['parameters' => ['clientrequests' => 'client']]);

Route::group(['namespace' => 'ClientRequests', 'prefix' => 'clientrequests'], function()use($data){
    foreach ($data as $datum) {
        Route::post('/'.$datum['short'].'/getKtkTypeWeightData', $datum['long'].'Controller@getKtkTypeWeightData')->name('clientrequests.'.$datum['short'].'.getktktypeweightdata');
        Route::get('/'.$datum['short'].'/index', $datum['long'].'Controller@index')->name('clientrequests.'.$datum['short'].'.index');
        Route::get('/'.$datum['short'].'/create/{lead}', $datum['long'].'Controller@create')->name('clientrequests.'.$datum['short'].'.create');
        Route::get('/'.$datum['short'].'/{client}/edit', $datum['long'].'Controller@edit')->name('clientrequests.'.$datum['short'].'.edit');
        Route::get('/'.$datum['short'].'/{client}/update', $datum['long'].'Controller@update')->name('clientrequests.'.$datum['short'].'.update');
        Route::get('/'.$datum['short'].'/{client}/destroy', $datum['long'].'Controller@destroy')->name('clientrequests.'.$datum['short'].'.destroy');
        Route::put('/'.$datum['short'].'/setstatus', $datum['long'].'Controller@setStatus')->name('clientrequests.'.$datum['short'].'.setstatus');
        Route::put('/'.$datum['short'].'/validateAndSave', $datum['long'].'Controller@validateAndSave')->name('clientrequests.'.$datum['short'].'.validateandsave');
        Route::post('/'.$datum['short'].'/pickOrders', $datum['long'].'Controller@pickOrders')->name('clientrequests.'.$datum['short'].'.pickorders');
        Route::post('/'.$datum['short'].'/getimportform', $datum['long'].'Controller@getImportForm')->name('clientrequests.'.$datum['short'].'.getimportform');
        Route::post('/'.$datum['short'].'/importcargo', $datum['long'].'Controller@importCargo')->name('clientrequests.'.$datum['short'].'.importcargo');
        Route::put('/'.$datum['short'].'/createOrders', $datum['long'].'Controller@createOrders')->name('clientrequests.'.$datum['short'].'.createorders');
        Route::get('/'.$datum['short'].'/getJobStatusProgress/{jobStatusId}', $datum['long'].'Controller@getJobStatusProgress')->name('clientrequests.'.$datum['short'].'.getjobstatusprogress');
    }
});

//Route::put('clientRequests/cancel', 'ClientRequestsController@cancel')->name('clientrequests.cancel');
//Route::put('clientRequests/getDeliveryTypeFields', 'ClientRequestsController@getDeliveryTypeFields')->name('clientrequests.getdelfields');
//Route::put('clientRequests/getUnloadingData', 'ClientRequestsController@getUnloadingData')->name('clientrequests.getunldata');
//Route::put('clientRequests/getContainerPlaceData', 'ClientRequestsController@getContainerPlaceData')->name('clientrequests.getcontplacedata');
//Route::put('clientRequests/setStatus', 'ClientRequestsController@setStatus')->name('clientrequests.setstatus');
//Route::put('clientRequests/validateAndSaveKtk', 'ClientRequestsController@validateAndSaveKtk')->name('clientrequests.validateandsavektk');
//
//Route::post('clientRequests/updateCargosFromKtkReport', 'ClientRequestsController@updateCargosFromKtkReport')->name('clientrequests.updatecargosfromktkreport');
//

