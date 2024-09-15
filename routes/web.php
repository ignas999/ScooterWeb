<?php

use App\Models\Transport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\TransportController;
use App\Models\Rating;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index', [
        'transports' => Transport::all(), 
        'randomrating' => RatingController::getRandomRating(),
    ]);
})->middleware('guest');

Route::get('/about', function () { return view('about');})->middleware('guest');

Route::get('/login', [UserController::class, 'login'])->middleware('guest');

Route::get('/register', [UserController::class, 'register'])->middleware('guest');

//userlogins and register

Route::post('/register' ,[UserController::class , 'store'])->middleware('guest');

Route::get('/dashboard',[UserController::class, 'getDashboard'])->middleware('auth');

Route::post('/login',[UserController::class, 'loginuser'])->middleware('guest')->name('login');

Route::post('/logout' ,[UserController::class , 'logout'])->middleware('auth');

//orders 

//get alltransports or just by category
Route::get('/models', [TransportController::class, 'getTransports'])->middleware('auth');
Route::get('/models/{categoryid}/', [TransportController::class, 'getTransports'])->middleware('auth');

//getsingle transport for order
Route::get('/orders/{transportid}', [OrderController::class, 'DisplayOrder'])->middleware('auth');
Route::post('/orders/makeorder', [OrderController::class, 'StoreOrder'])->middleware('auth');

//order history
Route::get('/orderhistory',[OrderController::class, 'OrderHistory'])->middleware('auth');
Route::post('/cancelorder/{id}',[OrderController::class , 'CancelOrder'])->middleware('auth');

//ratings
Route::get('/ratings',[RatingController::class, 'ratingspage'])->middleware('auth');
Route::get('/addrating/{transport_id}',[RatingController::class , 'addratingpage'])->middleware('auth');
Route::post('/addrating/{transport_id}',[RatingController::class , 'storerating'])->middleware('auth');
Route::delete('rating/delete/{rating_id}', [RatingController::class ,'deleterating'])->middleware('auth');
//view ratings of single model

Route::get('/ratings/transport/{transport_id}' ,[RatingController::class, 'getRatingModel'])->middleware('auth');



//update profile
Route::get('/profileinfo',[UserController::class, 'userprofilepage'])->middleware('auth');
Route::post('/profileinfo',[UserController::class, 'updateprofileinfo'])->middleware('auth');
Route::get('/userbalance', [UserController::class ,'userbalance'])->middleware('auth');