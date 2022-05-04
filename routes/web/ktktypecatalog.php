<?php

Route::resource('ktktypecatalog', 'KtkTypeCatalogController', ['parameters' => [
    'ktktypecatalog' => 'type'
]]);
Route::get('ktktypecatalogsort', 'KtkTypeCatalogController@sort')->name('ktktypecatalog.sort');
