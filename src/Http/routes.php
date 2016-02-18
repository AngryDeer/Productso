<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('category/{slug?}', 'Angrydeer\Productso\Http\Controllers\PrsoCategoryController@show');
    Route::get('product/{slug}/{categoryid?}', 'Angrydeer\Productso\Http\Controllers\PrsoProductController@show');
});
