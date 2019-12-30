<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware(['auth'])->group(function () {


	Route::view('/', 'admin.dashboard');
	Route::resource('accounts', 'AccountsController');
	Route::post('/changePassword', 'AccountsController@changePassword');
	Route::get('/changePassword', 'AccountsController@getChangePassword');
	Route::view('/account/profile', 'admin.accounts.profile');


	Route::resource('customer', 'CustomerController');
	Route::get('/customers/editremarks/{id}', 'CustomerController@editremarks');
	Route::post('/customers/return_remarks_edit', 'CustomerController@return_remarks_update');
	Route::post('/customers/reject_remarks_edit', 'CustomerController@reject_remarks_update');
	Route::get('/customer/destroy/{id}', 'CustomerController@destroy');
	Route::get('/customers/pendingCustomer', 'CustomerController@pendingCustomer');
	Route::get('/customers/returnCustomer', 'CustomerController@returnCustomer');
	Route::get('/customers/doneCustomer', 'CustomerController@doneCustomer');
	Route::get('/customers/completedCustomer', 'CustomerController@completedCustomer');
	Route::get('/customers/rejetedCustomer', 'CustomerController@rejetedCustomer');
	Route::get('/customers/rejected/{id}', 'CustomerController@rejected');
	Route::get('/customers/done/{id}', 'CustomerController@done');
	Route::get('/customers/pending/{id}', 'CustomerController@pending');
	Route::get('/customers/getCompleted/{id}', 'CustomerController@getCompleted');
	Route::get('/customers/getReturned/{id}', 'CustomerController@getReturned');
	Route::get('/customers/getRejected/{id}', 'CustomerController@getRejected');
	Route::post('/customers/postCompleted/{id}', 'CustomerController@postCompleted');
	Route::post('/customers/postReturned/{id}', 'CustomerController@postReturned');
	Route::post('/customers/postRejected/{id}', 'CustomerController@postRejected');
	Route::get('/customers/getMeterDetail/{id}', 'CustomerController@getMeterDetail');
	Route::get('/customers/view/{id}', 'CustomerController@view');
	Route::get('/customers/pdfview', 'CustomerController@pdf');
	Route::post('/customers/generatepdf', 'CustomerController@generatepdf');
	Route::post('/customers/selectedCustomerpdf', 'CustomerController@selectedCustomerpdf');
	Route::post('/customers/nepalipdf', "CustomerController@nepaliPdf");
	Route::get('/customers/getVauchers', 'CustomerController@getVauchers');
	Route::get('/customers/myVauchers', 'CustomerController@myVauchers');
	Route::get('/customers/viewVauchers/{id}', 'CustomerController@viewVauchers');

	Route::get('/customers/remove/{meter}', 'CustomerController@parmanentRemove');
	Route::get('/customers/trash', 'CustomerController@trash')->name('customer.trash');
	Route::get('/customers/recover/{id}', 'CustomerController@recoverCustomer')->name('meter.recover');
	Route::get('/customers/showtrashed/{id}', 'CustomerController@showTrashed');


	Route::get('/customers/sendMail/{id}', 'CustomerController@sendMail');
	Route::get('/customers/customerDetail/{id}', 'CustomerController@customerDetail');

	//Receiver Controller
	Route::resource('receivers', 'ReceiverController');
	Route::post('receiver/update', 'ReceiverController@receiverUpdate');

	Route::get('/meter', 'MeterController@index');
	Route::get('/meter/show/{id}', 'MeterController@show');
	Route::get('/meter/create', 'MeterController@create');
	Route::post('/meter/store', 'MeterController@store');
	Route::get('/meter/destroy/{id}', 'MeterController@destroy');
	Route::get('/meter/edit/{id}', 'MeterController@edit');
	Route::put('/meter/update/{id}', 'MeterController@update');
	Route::get('/meter/getAvailableMeter', 'MeterController@getAvailableMeter');
	Route::get('/meter/getAssignedMeter', 'MeterController@getAssignedMeter');
	Route::get('/meter/all', 'MeterController@getAll');

	Route::get('/meter/remove/{meter}', 'MeterController@parmanentRemove');
	Route::get('/meter/trash', 'MeterController@trash')->name('meter.trash');
	Route::get('/meter/recover/{id}', 'MeterController@recoverMeter')->name('meter.recover');
	Route::get('/meter/showtrashed/{id}', 'MeterController@showTrashed');

	Route::get('/meter/returnmeter', 'MeterController@getReturnMeter');
	Route::get('/meter/getMeterAndCustomerDetail/{id}', 'MeterController@getMeterAndCustomerDetail');
	Route::get('/meter/savereturnedMeter/{id}', 'MeterController@savereturnedMeter');


	Route::resource('backups', 'BackupController');

	Route::get('backups/delete/{name}', 'BackupController@deleteBackup');
	Route::get('backups/download/{name}', 'BackupController@downloadBackup');
	Route::post('backups/restoreBackup', 'BackupController@restoreBackup');

	Route::get('settings/email', "SettingsController@getEmailTemplate")->name('settings.email');
	Route::post('settings/email', "SettingsController@postEmailTemplate");
	Route::put('settings/emailupdate/{id}', "SettingsController@updateEmailTemplate");
	Route::get('settings/test', "SettingsController@test");


	Route::resource('customer_category', 'CustomerCategoryController');
	Route::resource('registration', 'RegistrationBookController');
	Route::post('/registrations/export', 'RegistrationBookController@export');
	Route::get('/registrations/getCategoryBy/{id}', 'RegistrationBookController@getCategoryBy');
	Route::get('/registrations/freelist', 'RegistrationBookController@freelist')->name('registration.freelist');

	// reconciliation start
	Route::resource('reconciliation','ReconciliationController');
	Route::post('reconciliations/update','ReconciliationController@update');
	Route::get('reconciliations/meter_got_report','ReconciliationController@meter_got_report');
	Route::get('reconciliations/meter_expenditure_report','ReconciliationController@meter_expenditure_report');
});
