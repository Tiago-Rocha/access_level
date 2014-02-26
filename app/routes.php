<?php

/**
 * Description of routes
 *
 * @author trocha
 */

Route::get('api/dropdown', function(){
        $input = Input::get('option');
	$company = Company::find($input);
        $contracts = Company::contracts($company->id);
        return Response::json($contracts);
   });
   
Route::get('api/clients', 'ApiSearchController@getclients');

Route::get('api/servicereports', 'ApiSearchController@getclients');   
   
Route::resource('users', 'UsersController');

Route::resource('utilizadors', 'UtilizadorsController');

Route::resource('companies', 'CompaniesController');

Route::resource('clients', 'ClientsController');

Route::resource('contracts', 'ContractsController');

Route::resource('invoices', 'InvoicesController');

Route::resource('invoicelines', 'InvoiceLinesController');

Route::resource('servicereports', 'ServicereportsController');

Route::resource('globalvars', 'GlobalvarsController');

Route::post('invoices/srsearch', 'InvoicesController@srsearch');

Route::post('searchpastservices', 'ServiceReportsController@searchpastservices');

Route::post('atualizar' , 'UtilizadorsController@changeState');

Route::post('UpdateServiceReportState' , 'ServicereportsController@changeState');

Route::post('UpdateCompanyState' , 'CompaniesController@changeState');

Route::get('/', 'HomeController@getIndex');

Route::get('dashboard', 'HomeController@getDashboard');

Route::get('login', 'HomeController@getLogin');

Route::post('login', 'HomeController@postLogin');

Route::get('logout', 'HomeController@Logout');

Route::get('admin', 'HomeController@getPainel');

Route::get('user', 'HomeController@getIndex');

Route::get('list', 'InvoicesController@previewList');


