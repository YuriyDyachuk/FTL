<?php

Route::resource('packingsizecatalog', 'PackingSizeCatalogController', ['parameters' => [
    'packingsizecatalog' => 'size'
]]);
Route::get('packingsizecatalogsort', 'PackingSizeCatalogController@sort')->name('packingsizecatalog.sort');
