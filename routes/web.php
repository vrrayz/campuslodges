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

Route::get('/','IndexController@index');
Route::get('/contact','NormalPagesController@contact')->name('contact');
Route::get('/about', 'NormalPagesController@about')->name('about');
Route::get('/agents','NormalPagesController@agent')->name('becomeAnAgent');

Auth::routes(['verify'=>true]);
//Route::get('/login','Auth/LoginController@show')->name('login');
Route::get('/user/account/index', 'HomeController@index')->name('home');
Route::get('/user/account/edit', 'HomeController@edit');
Route::put('/user/account/edit', 'HomeController@update');
Route::get('/user/account/changepass', 'UserPasswordController@edit')->name('changepass');
Route::put('/user/account/changepass', 'UserPasswordController@update');

Route::post('/user/agent/application', 'HomeController@apply');

Route::get('/user/properties/upload', 'SellPropertiesController@create');
Route::post('/user/properties/upload', 'SellPropertiesController@store');

Route::get('/user/properties/{approval_status}', 'SellPropertiesController@index');

Route::get('/user/property/{property}', 'SellPropertiesController@show');
Route::put('/user/property/{property}', 'SellPropertiesController@update');

Route::get('/user/property/{property}/photos', 'SellPropertiesPictureController@show');
Route::post('/user/property/{property}/photo', 'SellPropertiesPictureController@store');
Route::put('/user/property/{property}/photo/{photo}', 'SellPropertiesPictureController@update');
Route::delete('/user/property/{property}/{photo}', 'SellPropertiesPictureController@delete');

Route::get('/user/address/edit', 'UserAddressController@edit')->name('address.edit');
Route::get('/user/address/state/{s}', 'UserAddressController@states');
Route::put('/user/address/edit', 'UserAddressController@update');

Route::get('/user/picture/edit', 'ProfilePictureController@edit')->name('picture.edit');
Route::put('/user/picture/edit', 'ProfilePictureController@update');

Route::put('/user/push_property/{property}', 'PropertiesPublishController@pushOnline');
Route::put('/user/pull_property/{property}', 'PropertiesPublishController@pull');

Route::post('/user/renew_property/{property}', 'SellPropertiesController@renew');

Route::get('/home', function () {
   return redirect('/user/account/index');
})->name('home');


Route::get('/add_department', 'DepartmentController@create');
Route::post('/add_department', 'DepartmentController@store');
Route::get('/getSearchLocation/{vicinity}', 'LodgeSpotController@getLodgeSpot');
Route::get('/lodgeSearch/lodges/{vicinity}', 'LodgeSearchController@showLodge');
Route::get('/getRoomLocation/{vicinity}', 'RoomController@getRoomType');

//Admin Routes
Route::get('/admin','AdminController@index')->middleware('admin');
Route::get('/admin/user/{user}','AdminUserController@show')->middleware('admin');
Route::get('/admin/user/{user}/edit','AdminUserController@edit')->middleware('admin');
Route::get('/admin/users/create','AdminUserController@create')->middleware('admin');
Route::post('/admin/user','AdminUserController@store')->middleware('admin');
Route::patch('/admin/user/{user}','AdminUserController@update')->middleware('admin');

Route::post('/admin/search/users','AdminSearchController@index')->middleware('admin');

Route::get('/admin/lodgespots','LodgeSpotController@index')->middleware('admin');
Route::post('/admin/lodgespots','LodgeSpotController@store')->middleware('admin');
Route::delete('/admin/lodgespots/{lodgeSpot}','LodgeSpotController@destroy')->middleware('admin');

Route::get('/admin/room_types','RoomController@index')->middleware('admin');
Route::post('/admin/room_types','RoomController@store')->middleware('admin');
Route::delete('/admin/room_types/{roomType}','RoomController@destroy')->middleware('admin');

Route::get('/admin/lodges','AdminLodgeController@index')->middleware('admin');

Route::get('/admin/lodges/{lodge}','AdminLodgeController@show')->middleware('admin');
Route::post('/admin/lodges/{lodge}/verification','AdminLodgeController@verification')->middleware('admin');

Route::get('/admin/properties','AdminPropertyController@index')->middleware('admin');

Route::get('/admin/properties/{property}','AdminPropertyController@show')->middleware('admin');
Route::post('/admin/properties/{property}/verification','AdminPropertyController@verification')->middleware('admin');


Route::get('/admin/agent/{agent_id}/verification','AdminAgentVerificationController@edit')->middleware('admin');
Route::post('/admin/agent/{agent_id}/verification','AdminAgentVerificationController@store')->middleware('admin');

Route::get('/admin/agent/{user_id}/agent_application','AdminAgentApplicationController@show')->middleware('admin');
Route::post('/admin/user/{user_id}/make_agent','AdminAgentApplicationController@update')->middleware('admin');

Route::get('/admin/requests/lodge_visits/{notification}','AdminLodgeVisitsController@show')->middleware('admin');

//Agent Routes
Route::get('/agent/profile','AgentController@index')->middleware('agent');
Route::post('/agent/profile/update','AgentProfileController@store')->middleware('agent');

Route::get('/agent/kyc','AgentKycController@index')->middleware('agent');
Route::post('/agent/kyc','AgentKycController@update')->middleware('agent');

Route::put('/agent/push/{lodge}','AgentHouseStatusController@pushOnline')->middleware('agent');
Route::put('/agent/pull/{lodge}','AgentHouseStatusController@pull')->middleware('agent');


Route::post('/agent/houseRule/{rule}/edit/{value}','AgentLodgeRuleController@update')->middleware('agent');

Route::get('/agent/houses','AgentHouseController@show')->middleware('agent');
Route::get('/agent/house/{lodge_id}','AgentHouseController@showHouse')->middleware('agent');
Route::post('/agent/house/{lodge_id}','AgentHouseController@update')->middleware('agent');

Route::post('/agent/house/{lodge}/renew','AgentHouseController@renew')->middleware('agent');

Route::get('/agent/houses/{approval_status}','AgentHouseStatusController@index')->middleware('agent');

Route::get('/agent/house/{lodge_id}/photos','AgentHousePictureController@show')->middleware('agent');
Route::post('/agent/house/photo/{lodge_pic_id}','AgentHousePictureController@update')->middleware('agent');
Route::post('/agent/house/category/{lodge_pic_id}','AgentHousePictureController@updateCategory')->middleware('agent');
Route::post('/agent/house/photo/{lodge_pic_id}/delete','AgentHousePictureController@delete')->middleware('agent');


Route::get('/agent/upload_house','AgentHouseController@index')->middleware('agent','agent_verified');
Route::post('/agent/upload_house','AgentHouseController@store')->middleware('agent','agent_verified');

Route::get('/admin/upload_house/getLevel/{department}','AgentHouseController@getLevel')->middleware('agent');

Route::post('/user/lodge/save/{lodge}','SavedLodgeController@store');
Route::get('/user/saved_lodges','SavedLodgeController@index');

Route::post('/user/lodge/flag/{lodge}','FlaggedLodgeController@store');
Route::post('/user/property/flag/{property}','FlaggedPropertyController@store');

Route::post('/user/property/save/{property}','SavedPropertyController@store');
Route::get('/user/saved_properties','SavedPropertyController@index');
Route::post('/user/request_visit/{lodge}','RequestVisitController@sendRequest');

Route::get('/lodges','LodgeController@index');
Route::get('/lodges/{lodge}','LodgeController@show');
Route::get('/props','PropertyController@index');
Route::get('/props/{property}','PropertyController@show');
