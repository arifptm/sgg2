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

// Route::get('/', function () {
//     return view('welcome');
// }); 

Auth::routes();


Route::get('/active_order', function(){
	$order = App\Order::whereStatus('draft')->where('user_id', Auth::user()->id)->first();
	return $order ? $order->id : '';
});

Route::get('/', 'HomeController@index');

 
Route::middleware('roles')->group(function(){

	////// PRODUCT
	/////
	Route::get('/products', 'ProductController@index');
	Route::get('/product/data', [ 'uses' =>'ProductController@productDatatables']);
	Route::get('/product/{slug}', 'ProductController@ajaxShow');

	Route::get('/block/lineitem', 'ProductController@blockLineitem');


	////// PROPOSAL
	/////
	Route::get('/proposals', 'ProposalController@index');
	Route::get('/proposal/data', 'ProposalController@proposalDatatables');
	Route::post('/proposal/ajax/store', 'ProposalController@ajaxStore');
	Route::post('/proposal/ajax/update', 'ProposalController@ajaxUpdate');
	Route::post('/proposal/ajax/destroy', 'ProposalController@ajaxDestroy');


	////// ORDER
	/////
	Route::get('/orders', 'OrderController@index');
	Route::get('/order/block/index', 'OrderController@ajaxIndex');
	Route::get('/orders/show/{id?}', 'OrderController@show');
	Route::get('/orders/{id}', 'OrderController@ajaxShow');

	Route::post('/orders/destroy', 'OrderController@ajaxDestroy');

	Route::post('/orders/checkout', 'OrderController@checkout');


	////// LINEITEM
	/////
	Route::post('/lineitem/ajax/create', 'LineitemController@ajaxCreate');
	Route::post('/lineitem/ajax/update', 'LineitemController@ajaxUpdate');
	Route::post('/lineitem/ajax/delete', 'LineitemController@ajaxDestroy');

});

Route::middleware('roles')->group(function(){
	Route::prefix('admin')->group(function (){
		////// USER
		/////
		Route::get('users', 'admin\UserController@index');
		Route::get('users/list', 'admin\UserController@list');
		Route::post('users/store','admin\UserController@store');		
		Route::post('users/update','admin\UserController@update');
		Route::post('users/delete','admin\UserController@destroy');

		////// DEPARTEMENT
		/////
		Route::get('departments', 'admin\DepartmentController@index');
		Route::get('departments/list', 'admin\DepartmentController@list');				
		Route::post('departments/store', 'admin\DepartmentController@store');				
		Route::post('departments/update', 'admin\DepartmentController@update');
		Route::post('departments/delete', 'admin\DepartmentController@destroy');
	
		////// PRODUCT
		/////
		Route::get('products', 'admin\ProductController@index');		
		Route::get('products/list/{state?}', 'admin\ProductController@list');
		Route::post('products/update', 'admin\ProductController@update');
		Route::post('products/delete','admin\ProductController@destroy');
		Route::get('products/{slug}', 'admin\ProductController@show');

		////// ORDER
		/////
		Route::get('orders', 'admin\OrderController@index');
		Route::get('orders/list/{state?}', 'admin\OrderController@list');
		Route::get('orders/show/{id?}', 'admin\OrderController@show');
		Route::get('orders/{id}', 'admin\OrderController@ajaxShow');
		
		// Route::post('products/update', 'admin\ProductController@update');
		// Route::post('products/delete','admin\ProductController@destroy');
	});
});


Route::middleware('roles')->group(function(){
	Route::prefix('kalab')->group(function (){

		////// ORDER
		/////
		Route::get('orders/index/{state?}', 'kalab\OrderController@index');	
		Route::get('orders/list/{state?}', 'kalab\OrderController@list');
		Route::get('export', 'kalab\OrderController@export');
		Route::post('export/excel', 'kalab\OrderController@excel');		
		Route::get('orders/show/{id?}', 'kalab\OrderController@show');
		Route::get('orders/{id}', 'kalab\OrderController@ajaxShow');

		Route::post('orders/accept', 'kalab\OrderController@accept');
		Route::post('orders/reject', 'kalab\OrderController@reject');
		Route::post('orders/add-notes', 'kalab\OrderController@addNotes');
		Route::post('orders/update-notes', 'kalab\OrderController@updateNotes');

	});
});



Route::get('s', function(){
	if(Auth::user()->hasAnyRole(['user'])){
		return "metaphone";
	}
});

Route::get('t', function(){	
	
	return (new App\User)->isRoles('super')->get();
	
});

Route::get('myrole', function(){
	$w = Auth::user()->roles;
});

Route::get('/a', function(){
	$p = App\product::find(20);

});