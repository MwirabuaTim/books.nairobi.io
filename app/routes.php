<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/*
|--------------------------------------------------------------------------
| Application Account Routes
|--------------------------------------------------------------------------
*/


//removing trailing slashes from urls
Route::get('{any}', function($url){
    return Redirect::to(mb_substr($url, 0, -1), 301);
})->where('any', '(.*)\/$');


Route::get('user/{id}', 'UserController@account', compact('id'))->where('id', '[0-9]+');

Route::get('user/edit', function(){
		if(!Auth::check()){
			return View::make('user/login');
		}
		else{
			$id =  Auth::user()->id;
			$user =  User::find($id);
			return Redirect::to('user/'.$id.'/edit')->with('user', $user);
		}
});
Route::get('user/{id}/edit', 'UserController@getEdit', compact('id'))->where('id', '[0-9]+');
Route::post('user/{id}/edit', 'UserController@postEdit', compact('id'))->where('id', '[0-9]+');

Route::get('login', 'UserController@getLogin');
Route::post('login', 'UserController@postLogin');

// Route::get('logout', 'UserController@getLogout');
// Route::get('register', 'UserController@getRegister');
// Route::post('register', 'UserController@postRegister');
Route::get('accounts', 'UserController@getIndex');
Route::get('account', 'UserController@getIndex');
Route::get('users', 'UserController@getIndex');
Route::controller('user', 'UserController'); //logout, getRegister, postRegister, 

Route::get('user/{id}/bookshelf', function($id){ 
	return Redirect::action('BookshelvesController@indexByUser', compact('id'));
})->where('id', '[0-9]+');
Route::get('user/{id}/wishlist', function($id){ 
	return Redirect::action('WishlistsController@indexByUser', compact('id'));
})->where('id', '[0-9]+');
Route::get('user/{id}/books', function($id){ 
	return Redirect::action('BooksController@indexByUser', compact('id'));
})->where('id', '[0-9]+');

Route::get('user/books', 'BooksController@indexMyBooks'); //ajaxy mybooks


Route::get('oauth/{provider}', 'Oauth2Controller@getIndex');
Route::get('social/auth', 'UserController@auth'); 

//Contact us via gmail
Route::post('gmail', 'Oauth2Controller@email');

// Route::get('user/{name}', function($name){
// 	return "Try user/id ".$name;
// })->where('name', '[A-Za-z]+');


Route::get('howitworks', function(){ return View::make('howitworks');});
Route::get('privacypolicy', function(){ return View::make('privacypolicy');});
Route::get('termsofuse', function(){ return View::make('termsofuse');});
Route::get('customerservice', function(){ return View::make('customerservice');});
Route::get('template', function(){return View::make('template');});
Route::get('contactus', function(){ return View::make('contactus');});


Route::get('colleges/ajax','CollegesController@ajaxByLetters');
Route::get('colleges/search','CollegesController@search');
Route::resource('colleges', 'CollegesController');

Route::get('college/{id}/bookshelf', function($id){ 
	return Redirect::action('BookshelvesController@indexByCollege', compact('id'));
})->where('id', '[0-9]+');
Route::get('college/{id}/bookshelves', function($id){ 
	return Redirect::action('BookshelvesController@indexByCollege', compact('id'));
})->where('id', '[0-9]+');
Route::get('college/{id}/wishlist', function($id){ 
	return Redirect::action('WishlistsController@indexByCollege', compact('id'));
})->where('id', '[0-9]+');
Route::get('college/{id}/wishlists', function($id){ 
	return Redirect::action('WishlistsController@indexByCollege', compact('id'));
})->where('id', '[0-9]+');
Route::get('college/{id}/books', function($id){ 
	return Redirect::action('BooksController@indexByCollege', compact('id'));
})->where('id', '[0-9]+');


Route::get('courses/ajax','CoursesController@ajaxByLetters');
Route::get('courses/search','CoursesController@search');
Route::resource('courselists', 'CourselistsController');
Route::resource('courses', 'CoursesController');

Route::get('donate', function(){return View::make('template');});
Route::get('forums', function(){return View::make('template');});
// Route::get('forum', 'BaseController@forum');
Route::get('blog', 'BaseController@blog');


//BooksController

	//show($id) // view one book
		Route::get('book/{id}','BooksController@show', compact('id'))->where('id', '[0-9]+');

	//index() // all local books
		//Route::get('books', 'BooksController');
		Route::get('books/all', 'BooksController');

	//indexByUser($id) 	// all books by a user
		Route::get('books/user/{id}', 'BooksController@indexByUser', compact('id'))->where('id', '[0-9]+');

	//indexByCollege($id) 	// all books by a college
		Route::get('books/college/{id}', 'BooksController@indexByCollege', compact('id'))->where('id', '[0-9]+');

	//indexSellers($id)	//	sellers for a book
		Route::get('book/{id}/sellers', 'BooksController@indexSellers', compact('id'))->where('id', '[0-9]+');

	//indexBuyers($id)	//	buyers for a book
		Route::get('book/{id}/buyers', 'BooksController@indexBuyers', compact('id'))->where('id', '[0-9]+');

	//searchAmazon //	Amazon search submit, not autocomplete, amazonecs
		Route::get('books/search','BooksController@searchAmazon');
	//searchAmazon2 //	Amazon search submit, not autocomplete, amazonsearch
		Route::get('books/search2','BooksController@searchAmazon2');

	//search()  // all local books ...

	// Route::get("search/{bterm}/{category}/{sort}", function($b, $c, $s){
	// 	return SearchController@search->with()
	// };


//BookshelvesController

	//indexAll() 	// all bookshelf items in system
		Route::get('bookshelves', 'BookshelvesController@index');
		Route::get('bookshelves/all', 'BookshelvesController@indexAll');

	//indexByCollege($id) 	//all bookshelf items by a college
		Route::get('bookshelves/college/{id}', 'BookshelvesController@indexByCollege', compact('id'))->where('id', '[0-9]+');

	//indexByUser($id) // all bookshelf items by a user id
		Route::get('bookshelf/user/{id}', 'BookshelvesController@indexByUser', compact('id'))->where('id', '[0-9]+');

	//add() // add bookshelf item from listings
		Route::get('bookshelf/add', 'BookshelvesController@add');

	//index() // all bookshelf items by logged in user
		Route::resource('bookshelf', 'BookshelvesController');
	 	//index create, store, show, edit, update, destroy // bookshelf items by a user


//WishlistsController

	//indexAll() 	// all wishlist items in system
		Route::get('wishlists', 'WishlistsController@index');
		Route::get('wishlists/all', 'WishlistsController@indexAll');

	//indexByCollege($id) 	//all wishlist items by a college
		Route::get('wishlists/college/{id}', 'WishlistsController@indexByCollege', compact('id'))->where('id', '[0-9]+');

	//indexByUser($id) // all wishlist items by a user id
		Route::get('wishlist/user/{id}', 'WishlistsController@indexByUser', compact('id'))->where('id', '[0-9]+');

	//index() // all wishlist items by logged in user
		Route::resource('wishlist', 'WishlistsController');
	 	//index create, store, show, edit, update, destroy // wishlist items by a user


//bshelf form fields: price:$dollars, location:dropdown, status:radio, available:12/12/12, condition:radio
	//php artisan generate:scaffold bookshelf --fields="userid:integer, query:string, name:string, author:string, price:integer, location:string, status:string, available:datetime, condition:string, deleted_at:timestamp"
//wlist = simple add! 
	//php artisan generate:scaffold wishlist --fields="userid:integer, query:string, name:string, author:string, price:string, deleted_at:timestamp"
//constants from amazon: Author, Published, Edition, ISBN, On Amazon


//getCreate, postCreate, getView, getEdit, postEdit, destroy, getListAll, getListByUser, getListByCollege,
// postSearchAll, postSearchByUser, postSearchByCollege

		// Route::resource('bookshelves', 'BookshelvesController');

		// Route::resource('wishlists', 'WishlistsController');






/*
  |--------------------------------------------------------------------------
  | Testing...
  |--------------------------------------------------------------------------
  |
 */

//get tests...
Route::get('tests', function(){

});

//post tests...
Route::post('tests', ['use'=>function(){
	return [Sentry::check(), Session::token()];
}]);

Route::get('tests/{type}', function($type) {
    if($type == 'environment'){
        return App::environment();
    }
    if($type == 'url'){
        return Config::get('app.url');
    }
    if($type == 'key'){
        return Config::get('app.key');
    }
    if($type == 'host'){
        return gethostname();
    }
    if($type == 'app'){
        return Config::get('app');
    }
    if($type == 'header'){
        return Request::header();
    }
    if($type == 'session'){
        return Session::token();
    }
    if($type == 'auth'){
        return [Sentry::check()];
    }
    if($type == 'user'){
        return Sentry::getUser();
    }
    if($type == 'first'){
        return User::first();
    }
    if($type == 'segments'){
        return Request::segments();
    }
    if($type == 'groups'){
    	return Sentry::findAllGroups();
		// return User::where('permissions', '{"business":1}')->get();
    	return [User::first()->hasAccess('business')];
		// return Sentry::getGroupProvider()->findByName('Businesses');
    }
    if($type == 'time'){
        // return microtime(true);
        // return round(microtime(true) * 100);
        return substr(round(microtime(true) * 100), 3, 9);
    }
});

Route::get('storage/{folder}', function($folder) {
	return Storage::allFiles($folder); //l5
});





Route::controller('/', 'HomeController');

