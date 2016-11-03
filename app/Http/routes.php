<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'auth'], function(){

	Route::get('login','Auth\AuthController@loginGetView');

	Route::get('register','Auth\AuthController@registerGetView');

	Route::post('login','Auth\AuthController@loginPost');

	Route::post('register','Auth\AuthController@registerPost');

	Route::get('register/verify/{code}','Auth\AuthController@registerVerify');

	Route::get('logout','Auth\AuthController@logout');
});



Route::group(['prefix' => 'recipes'], function(){
	Route::get('/favorites','Recipes\RecipesController@searchFavorites');
	Route::get('/favorite/{id}','Recipes\RecipesController@addFavorites');
	Route::get('/favorite/remove/{id}','Recipes\RecipesController@removeFavorites');
	Route::post('/category','Recipes\RecipesController@searchWithCat');
	Route::post('/search','Recipes\RecipesController@search');
	

});
Route::resource('/recipes','Recipes\RecipesController');

Route::group(['prefix' => 'admin'], function(){

});


