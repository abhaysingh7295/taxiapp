<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
 }

Route::get('/', 'AdminController@dashboard')->name('index');
Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
Route::get('/get/heatmap', 'AdminController@get_heatmap')->name('get_heatmap');
Route::get('/heatmap', 'AdminController@heatmap')->name('heatmap');
Route::get('/godseye', 'AdminController@godseye')->name('godseye');
Route::get('/godseye/list', 'AdminController@godseye_list')->name('godseye_list');
Route::get('/translation',  'AdminController@translation')->name('translation');
Route::get('/fare' , 'AdminController@fare');
Route::get('/cities/{id}','CityController@getCities');
Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/download/{id}', 'AdminController@download')->name('download');

Route::group(['as' => 'dispatcher.', 'prefix' => 'dispatcher'], function () {
	Route::get('/', 'DispatcherController@index')->name('index');
	Route::post('/', 'DispatcherController@store')->name('store');
        Route::get('/trips', 'DispatcherController@trips')->name('trips');
        Route::get('/incoming', 'DispatcherController@incoming')->name('incoming');
        Route::get('/cancelled', 'DispatcherController@cancelled')->name('cancelled');
	Route::get('/cancel', 'DispatcherController@cancel')->name('cancel');
	Route::get('/trips/{trip}/{provider}', 'DispatcherController@assign')->name('assign');
	Route::get('/users', 'DispatcherController@users')->name('users');
	Route::get('/providers', 'DispatcherController@providers')->name('providers');
});

Route::resource('user', 'Resource\UserResource');
Route::resource('country', 'Resource\CountriesResource');
Route::resource('city', 'Resource\CitiesResource');
Route::resource('company', 'Resource\CompanyResource');
Route::resource('cartype', 'Resource\CartypeResource');
Route::resource('cars', 'Resource\CarsResource');
Route::resource('reservations', 'Resource\RreservationsResource');
Route::resource('luggage', 'Resource\CombinantionLuggageResource');
Route::resource('vehicles', 'Resource\VehicleReource');

Route::get('vehicles/{id}/vehiclechecklist','Resource\VehicleReource@vehiclechecklist')->name('vehicles.vehiclechecklist');
Route::patch('vehicles/{id}/vehiclechecklist','Resource\VehicleReource@updatevehiclechecklist')->name('vehicles.vehiclechecklist');
Route::get('vehicles/{id}/vehicledocuments','Resource\VehicleReource@vehicledocuments')->name('vehicles.vehicledocuments');
Route::patch('vehicles/{id}/uploadsvehicledocuments/{vehicleid}/','Resource\VehicleReource@updatevehicledocuments')->name('vehicles.uploadsvehicledocuments');
Route::get('vehicles/{id}/viewvehicledocument/{vehicleid}/','Resource\VehicleReource@viewvehicledocument')->name('vehicles.viewvehicledocument');
Route::patch('vehicles/{id}/approvevehicledocument/{vehicleid}/','Resource\VehicleReource@approvevehicledocument')->name('vehicles.approvevehicledocument');
Route::delete('vehicles/{id}/destroyvehicledocument/{vehicleid}/','Resource\VehicleReource@destroyvehicledocument')->name('vehicles.destroyvehicledocument');


Route::resource('dispatch-manager', 'Resource\DispatcherResource');
Route::resource('account-manager', 'Resource\AccountResource');
Route::resource('dispute-manager', 'Resource\DisputeManagerResource');

Route::resource('provider', 'Resource\ProviderResource');
Route::resource('document', 'Resource\DocumentResource');
Route::resource('service', 'Resource\ServiceResource');
Route::resource('promocode', 'Resource\PromocodeResource');
Route::resource('role', 'Resource\RoleResource');
Route::resource('sub-admins', 'Resource\AdminResource');

Route::group(['as' => 'provider.'], function () {
    Route::get('review/provider', 'AdminController@provider_review')->name('review');
    Route::get('provider/ajax', 'Resource\ProviderResource@ajax')->name('ajax');
    Route::get('provider/{id}/orangeflagon', 'Resource\ProviderResource@orangeflagon')->name('orangeflagon');
    Route::get('provider/{id}/redflagon', 'Resource\ProviderResource@redflagon')->name('redflagon');
    Route::get('provider/{id}/orangeflagoff', 'Resource\ProviderResource@orangeflagoff')->name('orangeflagoff');
    Route::get('provider/{id}/redflagoff', 'Resource\ProviderResource@redflagoff')->name('redflagoff');
    Route::get('provider/{id}/uploaddocuments', 'Resource\ProviderResource@uploaddocuments')->name('uploaddocuments');
    Route::get('provider/{id}/approve', 'Resource\ProviderResource@approve')->name('approve');
    Route::get('provider/{id}/disapprove', 'Resource\ProviderResource@disapprove')->name('disapprove');
    Route::get('provider/{id}/request', 'Resource\ProviderResource@request')->name('request');
    Route::get('provider/{id}/statement', 'Resource\ProviderResource@statement')->name('statement');
    Route::get('provider/{id}/password','Resource\ProviderResource@get_password')->name('password');
    Route::get('provider/{id}/driverchecklist','Resource\ProviderResource@driver_checklist')->name('driverchecklist');
    Route::patch('provider/{id}/driverchecklist','Resource\ProviderResource@update_driverchecklist');
    Route::patch('provider/{id}/password','Resource\ProviderResource@update_password');
    Route::resource('provider/{provider}/document', 'Resource\ProviderDocumentResource');
    Route::delete('provider/{provider}/service/{document}', 'Resource\ProviderDocumentResource@service_destroy')->name('document.service');

});
Route::patch('provider/{id}/updatedocuments/{providerid}/','Resource\ProviderResource@updatedocuments')->name('provider.updatedocuments');
Route::get('review/user', 'AdminController@user_review')->name('user.review');
Route::get('user/{id}/request', 'Resource\UserResource@request')->name('user.request');
Route::get('user/{id}/approve', 'Resource\UserResource@approve')->name('user.approve');
Route::get('user/{id}/disapprove', 'Resource\UserResource@disapprove')->name('user.disapprove');
Route::get('map', 'AdminController@map_index')->name('map.index');
Route::get('map/ajax', 'AdminController@map_ajax')->name('map.ajax');

Route::get('site/settings', 'AdminController@settings')->name('settings');
Route::post('settings/store', 'AdminController@settings_store')->name('settings.store');
Route::get('settings/payment', 'AdminController@settings_payment')->name('settings.payment');
Route::post('settings/payment', 'AdminController@settings_payment_store')->name('settings.payment.store');

Route::get('profile', 'AdminController@profile')->name('profile');
Route::post('profile', 'AdminController@profile_update')->name('profile.update');

Route::get('password', 'AdminController@password')->name('password');
Route::post('password', 'AdminController@password_update')->name('password.update');

Route::get('payment', 'AdminController@payment')->name('payment');
Route::get('dbbackup', 'AdminController@DBbackUp')->name('dbbackup');


// statements

Route::get('/statement', 'AdminController@statement')->name('ride.statement');
Route::get('/statement/provider', 'AdminController@statement_provider')->name('ride.statement.provider');
Route::get('/statement/user', 'AdminController@statement_user')->name('ride.statement.user');
Route::get('/statement/range', 'AdminController@statement_range')->name('ride.statement.range');
Route::get('/statement/today', 'AdminController@statement_today')->name('ride.statement.today');
Route::get('/statement/monthly', 'AdminController@statement_monthly')->name('ride.statement.monthly');
Route::get('/statement/yearly', 'AdminController@statement_yearly')->name('ride.statement.yearly');
Route::get('statement/{id}/statement', 'Resource\ProviderResource@statement')->name('statement');
Route::get('statement_user/{id}/statement_user', 'Resource\ProviderResource@statementUser')->name('statement_user');
//transactions
Route::get('/transactions', 'AdminController@transactions')->name('transactions');
Route::get('transfer/provider', 'AdminController@transferlist')->name('providertransfer');
Route::get('/transfer/{id}/approve', 'AdminController@approve')->name('approve');
Route::get('/transfer/cancel', 'AdminController@requestcancel')->name('cancel');
Route::get('transfer/{id}/create', 'AdminController@transfercreate')->name('transfercreate');
Route::get('transfer/search', 'AdminController@search')->name('transfersearch');
Route::get('users/search', 'AdminController@search_user')->name('usersearch');
Route::get('users/provider', 'AdminController@search_provider')->name('userprovider');
Route::post('ride/search', 'AdminController@search_ride')->name('ridesearch');
Route::post('transfer/store', 'AdminController@transferstore')->name('transferstore');

//reasons
Route::resource('reason', 'Resource\ReasonResource');

//peakhours
Route::resource('peakhour', 'Resource\PeakHourResource');

//disputes
Route::resource('dispute', 'Resource\DisputeResource');

Route::get('disputeusers', 'Resource\DisputeResource@userdisputes')->name('userdisputes');
Route::get('disputelist', 'Resource\DisputeResource@dispute_list');
Route::post('disputeuserstore', 'Resource\DisputeResource@create_dispute')->name('userdisputestore');
Route::post('disputeuserupdate{id}', 'Resource\DisputeResource@update_dispute')->name('userdisputeupdate');
Route::get('disputeusercreate', 'Resource\DisputeResource@userdisputecreate')->name('userdisputecreate');
Route::get('disputeusers/create', 'Resource\DisputeResource@userdisputecreate')->name('userdisputecreate');
Route::get('disputeuseredit/{id}', 'Resource\DisputeResource@userdisputeedit')->name('userdisputeedit');
Route::get('disputeusers/edit/{id}', 'Resource\DisputeResource@userdisputeedit')->name('userdisputeedit');


Route::resource('bookingissuetypes', 'Resource\Bookingissuestypes');
Route::resource('driverfareissuetypes', 'Resource\Driverfareissuetypes');
Route::get('disputedriver', 'Resource\Driverfareissuetypes@driverdisputes')->name('driverdisputes');
Route::get('fareissueslist', 'Resource\Driverfareissuetypes@driverdisputesfare')->name('fareissueslist');
Route::get('disputelists', 'Resource\Driverfareissuetypes@dispute_list');
Route::get('disputedrivercreate', 'Resource\Driverfareissuetypes@driverdisputecreate')->name('driverdisputecreate');
Route::get('disputedrivers/create', 'Resource\Driverfareissuetypes@driverdisputecreate')->name('driverdisputecreate');
Route::get('disputedriveredit/{id}', 'Resource\Driverfareissuetypes@driverdisputeedit')->name('driverdisputeedit');
Route::get('disputedrivers/edit/{id}', 'Resource\Driverfareissuetypes@driverdisputeedit')->name('driverdisputeedit');
Route::post('disputedriverstore', 'Resource\Driverfareissuetypes@create_dispute')->name('driverdisputestore');
Route::post('disputedriverupdate{id}', 'Resource\Driverfareissuetypes@update_dispute')->name('driverdisputeupdate');




//notifications
Route::resource('notification', 'Resource\NotificationResource');

//lost items
Route::resource('lostitem', 'Resource\LostItemResource');

// Static Pages - Post updates to pages.update when adding new static pages.

Route::get('/help', 'AdminController@help')->name('help');
Route::get('/send/push', 'AdminController@push')->name('push');
Route::post('/send/push', 'AdminController@send_push')->name('send.push');
Route::get('/pages', 'AdminController@cmspages')->name('cmspages');
Route::post('/pages', 'AdminController@pages')->name('pages.update');
Route::get('/pages/search/{types}','AdminController@pagesearch');
Route::resource('requests', 'Resource\TripResource');
Route::get('scheduled', 'Resource\TripResource@scheduled')->name('requests.scheduled');

Route::get('push', 'AdminController@push_index')->name('push.index');
Route::post('push', 'AdminController@push_store')->name('push.store');


Route::get('/dispatch', function () {
    return view('admin.dispatch.index');
});

Route::get('/cancelled', function () {
    return view('admin.dispatch.cancelled');
});

Route::get('/ongoing', function () {
    return view('admin.dispatch.ongoing');
});

Route::get('/schedule', function () {
    return view('admin.dispatch.schedule');
});

Route::get('/add', function () {
    return view('admin.dispatch.add');
});

Route::get('/assign-provider', function () {
    return view('admin.dispatch.assign-provider');
});

Route::get('/dropdownlist','DropdownController@index');
Route::get('/get-state-list','DropdownController@getStateList');
Route::get('/get-city-list','DropdownController@getCityList');
