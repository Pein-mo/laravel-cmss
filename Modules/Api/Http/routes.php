<?php

Route::group(['middleware' => 'web', 'prefix' => 'api', 'namespace' => 'Modules\Api\Http\Controllers'], function()
{

    Route::get('/api/hook','ApiController@hook')->name('hook');
});
