<?php
 Route::get('api/v1/couriers/{country_code}/{service_category}', 'AnzilSystems\Beba\BebaController@getCouriers');
 Route::get('api/v1/rates/{pickup_latitude}/{pickup_longitude}/{delivery_latitude}/{delivery_longitude}', 'AnzilSystems\Beba\BebaController@getCouriers');
