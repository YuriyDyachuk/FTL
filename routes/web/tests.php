<?php

Route::group(['namespace' => '\App\Http\Controllers\Tests'], function(){
    Route::get('tests/loginPage/index', 'LoginPageController@index')->name('tests.loginpage.index');
    Route::get('tests/automationOrders/index', 'Leads\Train\AutomationOrdersCreatingController@index')->name('tests.automationorders.index');
    Route::get('tests/clientRequest/index', 'ClientRequest\ClientRequestController@index')->name('tests.clientrequest.index');
    Route::get('tests/trainOrder/index', 'Orders\TrainController@index')->name('tests.trainorder.index');
    Route::get('tests/allTests/index', 'AllTestsController@index')->name('tests.alltests.index');
});
