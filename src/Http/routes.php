<?php

Route::group(['middleware' => ['web']], function () {
//    Route::get('category/{slug?}', 'Angrydeer\Productso\Http\Controllers\PrsoCategoryController@show');
    Route::get('category/{slug?}', 'Angrydeer\Productso\Http\Controllers\PrsoCategoryController@show');
});

