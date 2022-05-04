<?php

Auth::routes();

//Route::post('register', '\App\Http\Controllers\Auth\RegisterController@register')->name('register');

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::put('order/report/{gettingAct}', 'OrderController@report')->name('order.report');
    Route::get('order/createSingle', 'OrderController@createSingle')->name('order.createsingle');
    Route::resource('order', 'OrderController');
    Route::put('Order/validateAndSave', 'OrderController@validateAndSave')->name('order.validateandsave');
    Route::put('Order/validateGoods', 'OrderController@validateGoods')->name('order.validategoods');


    Route::put('Order/updateBlock', 'OrderController@updateBlock')->name('order.updateblock');
    Route::post('Order/bindSingleToLead/{order}', 'OrderController@bindSingleToLead')->name('order.bindsingletolead');
    Route::post('Order/getexportform/{order}', 'OrderController@getExportForm')->name('order.getexportform');

    require app_path('../routes/web/leads.php');
    require app_path('../routes/web/clientrequests.php');
    require app_path('../routes/web/ktktypecatalog.php');
    require app_path('../routes/web/packingsizecatalog.php');
    require app_path('../routes/web/clients.php');
    require app_path('../routes/web/tests.php');


    Route::get('carorders', 'OrderController@carIndex')->name('carorders.index');
    Route::get('singleorders', 'OrderController@singleIndex')->name('singleorders.index');
    Route::get('warehouseorders', 'OrderController@whIndex')->name('warehouseorders.index');
    Route::get('trainorders', 'OrderController@trIndex')->name('trainorders.index');
    Route::post('forwarding', 'ForwardingController@create')->name('forwarding.create');
    Route::put('Forwarding/addphoto', 'ForwardingController@addPhoto')
        ->name('forwarding.addphoto');
    Route::put('Photo/upload', 'PhotoController@upload')
        ->name('photo.upload');
    Route::resource('users', 'UsersController');
    Route::resource('permissions', 'PermissionsController');
    Route::resource('roles', 'RolesController');
    Route::post('orderNotes/saveNote', 'OrderNotesController@saveNote')->name('ordernotes.savenote');
    Route::post('orderNotes/getNotes', 'OrderNotesController@getNotes')->name('ordernotes.getnotes');
    Route::get('tasks/car', 'TasksController@car')->name('tasks.car');

    Route::get('tasks/wh', 'TasksController@wh')->name('tasks.wh');
    Route::get('tasks/whgt', 'TasksController@whgt')->name('tasks.whgt');
    Route::get('tasks/whktk', 'TasksController@whktk')->name('tasks.whktk');

    Route::get('tasks/tr', 'TasksController@tr')->name('tasks.tr');

    Route::get('tasks/trfrom', 'TasksController@trfrom')->name('tasks.trfrom');
    Route::get('tasks/trto', 'TasksController@trto')->name('tasks.trto');
    Route::get('tasks/trcross', 'TasksController@trcross')->name('tasks.trcross');

    Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('profile/update', 'ProfileController@update')->name('profile.update');

    //Route::put('ftlblock/update', 'Block\FtlController@update')->name('ftlblock.update');
    //Route::put('datetimeblock/update', 'Block\DateTimeController@update')->name('datetimeblock.update');
    //Route::put('agentblock/update', 'Block\AgentController@update')->name('agentblock.update');
    //Route::put('clientblock/update', 'Block\ClientController@update')->name('clientblock.update');
    //Route::put('terminalblock/update', 'Block\TerminalController@update')->name('terminalblock.update');
    //Route::put('trainblock/update', 'Block\TrainController@update')->name('trainblock.update');
    //Route::put('providerblock/update', 'Block\ProviderController@update')->name('providerblock.update');
    //Route::put('driverblock/update', 'Block\DriverController@update')->name('driverblock.update');
    //Route::put('heavyrentblock/update', 'Block\HeavyRentController@update')->name('heavyrentblock.update');
    //Route::put('speccondsblock/update', 'Block\SpecCondsController@update')->name('speccondsblock.update');
    //Route::put('trainorderblock/update', 'Block\TrainOrderController@update')->name('trainorderblock.update');
    Route::put('ordercargo/create', 'OrderCargoController@create')->name('ordercargo.create');

    //Route::group(['prefix'=>'ajax', 'as'=>'ajax::'], function() {
        Route::post('message/send', 'MessageController@ajaxSendMessage')->name('message.new');
        //Route::delete('message/delete/{id}', 'MessageController@ajaxDeleteMessage')->name('message.delete');
    //});

    //Route::get('message/{id}', 'MessageController@chatHistory')->name('message.read');

    Route::put('driverreport/update/{id}', 'Report\DriverController@update')->name('driverreport.update');
    Route::get('driverreport/getModalForm/{id}', 'Report\DriverController@getModalForm')->name('driverreport.getmodalform');

    Route::put('cargoreport/update/{id}', 'Report\CargoController@update')->name('cargoreport.update');
    Route::get('cargoreport/getModalForm/{id}', 'Report\CargoController@getModalForm')->name('cargoreport.getmodalform');

    Route::put('trainreport/update/{id}', 'Report\TrainController@update')->name('trainreport.update');
    Route::get('trainreport/getModalForm/{id}', 'Report\TrainController@getModalForm')->name('trainreport.getmodalform');

    Route::put('forwardingreport/update/{id}', 'Report\ForwardingController@update')->name('forwardingreport.update');
    Route::get('forwardingreport/getModalForm/{id}', 'Report\ForwardingController@getModalForm')->name('forwardingreport.getmodalform');

    Route::put('carpointreport/update/{id}', 'Report\CarPointController@update')->name('carpointreport.update');
    Route::get('carpointreport/getModalForm/{id}', 'Report\CarPointController@getModalForm')->name('carpointreport.getmodalform');

    Route::put('waybillreport/update/{id}', 'Report\WaybillController@update')->name('waybillreport.update');
    Route::get('waybillreport/getModalForm/{id}', 'Report\WaybillController@getModalForm')->name('waybillreport.getmodalform');

    Route::put('routetrackreport/update/{id}', 'Report\RouteTrackController@update')->name('routetrackreport.update');
    Route::get('routetrackreport/getModalForm/{id}', 'Report\RouteTrackController@getModalForm')->name('routetrackreport.getmodalform');

    Route::put('heavyrentreport/update/{id}', 'Report\HeavyRentController@update')->name('heavyrentreport.update');
    Route::get('heavyrentreport/getModalForm/{id}', 'Report\HeavyRentController@getModalForm')->name('heavyrentreport.getmodalform');

    Route::put('whgettingreport/update/{id}', 'Report\WhGettingController@update')->name('whgettingreport.update');
    Route::get('whgettingreport/getModalForm/{id}', 'Report\WhGettingController@getModalForm')->name('whgettingreport.getmodalform');

    Route::put('powerofattorneyreport/update/{id}', 'Report\PowerOfAttorneyController@update')->name('powerofattorneyreport.update');

    Route::put('carreport/update/{id}', 'Report\CarController@update')->name('carreport.update');
    Route::get('carreport/getModalForm/{id}', 'Report\CarController@getModalForm')->name('carreport.getmodalform');

    Route::resource('gettingactcargo', 'GettingActCargoController');

    Route::resource('gettingact', 'GettingActController');
    Route::post('gettingact.savecargo', 'GettingActController@saveCargo')->name('gettingact.savecargo');
    Route::post('gettingact.getcargotypefields', 'GettingActController@getCargoTypeFields')->name('gettingact.getcargotypefields');

    Route::get('warehousecargo', 'WarehouseCargoController@index')->name('warehousecargo.index');
    Route::post('warehousecargo/getexportform', 'WarehouseCargoController@getExportForm')->name('warehousecargo.getexportform');
    Route::post('warehousecargo/exportcargo', 'WarehouseCargoController@exportCargo')->name('warehousecargo.exportcargo');
    Route::put('warehousecargo/updatestatus', 'WarehouseCargoController@updateStatus')->name('warehousecargo.updatestatus');

    Route::post('cargotypes/autocompleteList', 'CargoTypesController@autocompleteList')->name('cargotypes.autocompletelist');
    Route::resource('cargotypes', 'CargoTypesController');


    Route::post('ktkreport/getModalForm/{lead}', 'Report\KtkController@getModalForm')->name('ktkreport.getmodalform');


});
