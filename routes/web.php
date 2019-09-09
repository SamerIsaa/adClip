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

Route::get('admin/login', 'Auth\AdminAuthController@showLoginForm');

Route::post('admin/login', 'Auth\AdminAuthController@login')->name('admin.login');


Route::get('/admin', function () {
    return redirect('admin/index');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('admin/index', 'Controller@statistics')->name('admin.index1');


    Route::get('admin/logout', 'Auth\AdminAuthController@logout')->name('admin.logout');


    /*
     *
     * Routes for admin operation
     * and pages
     *
     */
    Route::resource('admin', 'AdminController')->except(['destroy', 'show']);
    Route::post('admin/delete', 'AdminController@destroy')->name('admin.destroy');
    Route::get('admin/settings', 'AdminController@showSettingPage')->name('admin.showSettings');
    Route::post('admin/settings', 'AdminController@updateProfile')->name('admin.settings');
    Route::post('admin/datatable', 'AdminController@datatable');


    /*
     *
     * Routes for catagories operation
     * and pages
     *
     */

    Route::resource('admin/catagory', 'CatagoriesController')->except(['destroy', 'show']);
    Route::post('catagories/datatable', 'CatagoriesController@datatable');
    Route::post('catagory/delete', 'CatagoriesController@destroy')->name('catagory.destroy');

    /*
     *
     * Routes for cities operation
     * and pages
     *
     */

    Route::resource('admin/city', 'CitiesController')->except(['destroy', 'show']);
    Route::post('cities/datatable', 'CitiesController@datatable');
    Route::post('city/delete', 'CitiesController@destroy')->name('city.destroy');


    /*
      *
      * Routes for cities operation
      * and pages
      *
      */

    Route::resource('admin/company', 'CompaniesController')->except(['destroy']);
    Route::get('companies/ended', 'CompaniesController@ended')->name('company.ended');
    Route::get('company/{id}/deactivate', 'CompaniesController@deactivate')->name('company.deactivate');
    Route::post('companies/datatable', 'CompaniesController@datatable');
    Route::post('companies/datatable/ended', 'CompaniesController@Endeddatatable');
    Route::post('company/delete', 'CompaniesController@destroy')->name('company.destroy');

    Route::get('admin/company/{id}/ad', 'CompanyVideoController@index');
    Route::post('company-ad/datatable', 'CompanyVideoController@datatable');
    Route::post('company-ad', 'CompanyVideoController@store')->name('company-ad.store');
    Route::post('company-ad/destroy', 'CompanyVideoController@destroy')->name('company-ad.destroy');


    /*
      *
      * Routes for Contact operation
      * and pages
      *
      */

    Route::resource('admin/contacts', 'ContactController')->except([ 'create','edit' , 'update']);
    Route::post('contacts/datatable', 'ContactController@datatable');
    Route::get('admin/contacts/{id}/replay', 'ContactController@replay');
    Route::post('admin/contacts/replay', 'ContactController@sendReplay')->name('contact.sendReplay');



    /*
      *
      * Routes for Contact operation
      * and pages
      *
      */

    Route::get('admin/about/social', 'AboutController@socialView')->name('about.social');
    Route::post('admin/about/social', 'AboutController@socialStore')->name('social.store');

    Route::get('admin/about/about-us', 'AboutController@aboutUsView')->name('about.about-us');
    Route::post('admin/about/about-us', 'AboutController@aboutUsStore')->name('about-us.store');

    Route::get('admin/mailing-news' , 'MailingListController@create')->name('mailingNews.create');
    Route::post('admin/mailing-news' , 'MailingListController@send')->name('mailingNews.send');


});

Route::get('locale/{locale}', 'Controller@changeLang');

Route::get('/' , 'Controller@indexSite');
Route::post('mail/store' , 'MailingListController@store')->name('mail.store');
Route::get('contact' , 'ContactController@create')->name('contact.create');
Route::post('contact' , 'ContactController@store')->name('contact.store');
Route::get('about' , 'AboutController@index')->name('about.index');
Route::get('clients' , 'CompaniesController@siteClients')->name('clients.index');
Route::get('client/{id}' , 'CompaniesController@showCompany')->name('clients.showCompany');
Route::get('comp-ad' , 'CompanyVideoController@getAd');
Route::get('comp-ad/{id}' , 'CompanyVideoController@getAdForCompany');

