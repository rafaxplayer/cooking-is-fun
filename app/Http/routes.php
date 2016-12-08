<?php


Route::group(['middleware' => 'mantenimiento'], function(){

	Route::get('/', 'HomeController@index');
	Route::get('/home', 'HomeController@index');

	Route::group(['prefix' => 'recipes'], function(){
		Route::get('/favorites','Recipes\RecipesController@searchFavorites');
		Route::get('/favorite/{id}','Recipes\RecipesController@addFavorites');
		Route::get('/favorite/remove/{id}','Recipes\RecipesController@removeFavorites');
		Route::post('/category','Recipes\RecipesController@searchWithCat');
		Route::post('/search','Recipes\RecipesController@search');
		Route::get('/pdf/{id}','PDFController@RecipeToPdf');
	
	});
	
	Route::resource('/recipes','Recipes\RecipesController');

	Route::group(['prefix' => 'user'], function(){

		Route::get('/panel/{param?}','User\UserController@getPanel');
		Route::get('/contact','User\UserController@getContact');
		Route::post('/contact/send','User\UserController@postContact');
		Route::post('/password','User\UserController@postPassword');
		Route::post('/avatar','User\UserController@postAvatar');
		Route::post('/email','User\UserController@postEmail');

	});

	Route::group(['prefix' => 'admin'], function(){
	
		Route::get('/{param}','Admin\adminController@getPanel');
		Route::get('/user/{id}','Admin\adminController@getUserEdit');
		Route::post('/user','Admin\adminController@postUserEdit');
		Route::get('/search/user','Admin\adminController@searchUser');
		Route::get('/search/recipes/withpattern','Admin\adminController@searchRecipesWithPattern');
		Route::get('/search/recipes/withusername','Admin\adminController@searchRecipesWithUsername');
		Route::get('/delete/user/{id}','Admin\adminController@deleteUser');
		Route::post('/manten','Admin\adminController@setMantenimiento');
	});

	Route::get('/setlang/{lang}', function($lang)
	{
	    Session::put('locale', $lang);

	    if(Auth::check()){
	    	$user = Auth::user();
	    	$user->lang = $lang;
	    	$user->save();
	    }

	    $message = Lang::get('messages.setlocale',array(),$lang);

	    return redirect()->back()->with('message',$message);
	});

	Route::get('error/{error}',function($error){
		return view('errors.'.$error);

	});

});



Route::group(['prefix' => 'auth'], function(){

	Route::get('login','Auth\AuthController@loginGetView');

	Route::get('register','Auth\AuthController@registerGetView');

	Route::post('login','Auth\AuthController@loginPost');

	Route::post('register','Auth\AuthController@registerPost');

	Route::get('register/verify/{code}','Auth\AuthController@registerVerify');

	Route::get('logout','Auth\AuthController@logout');
});






