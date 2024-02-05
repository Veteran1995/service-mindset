<?php

use App\Http\Controllers\Admin\Customers\CustomersController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\APIAuthController;

/*

|--------------------------------------------------------------------------

| API Routes

|--------------------------------------------------------------------------

|

| Here is where you can register API routes for your application. These

| routes are loaded by the RouteServiceProvider and all of them will

| be assigned to the "api" middleware group. Make something great!

|

*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});



// Route to log in and get user token

Route::post('/login', [APIAuthController::class, 'login']);

Route::get('/user/tasks/{user}', [APIAuthController::class, 'getUserTasks']);
Route::post('/user/intinerary-reject-comment', [APIAuthController::class, 'rejectComment']);
Route::post('/user/task-reject-comment', [APIAuthController::class, 'rejectTask']);

Route::post('/user/accept-meter-reading/{id}', [APIAuthController::class, 'acceptReading']);
Route::post('/user/accept-task/{id}', [APIAuthController::class, 'acceptTask']);

Route::get('/user/meter-reading/{user}', [APIAuthController::class, 'getMeterReadings']);

Route::get('/user/task-service-order-report/{id}', [APIAuthController::class, 'taskServiceOrderReport']);

Route::put('/user/update-task-status/{id}', [APIAuthController::class, 'updateTaskStatus']);

Route::post('/user/add-meter-reading', [APIAuthController::class, 'addMeterReading']);

Route::post('/user/add-service-order-report', [APIAuthController::class, 'serviceOrderReport']);

Route::post('import-customers', [CustomersController::class, 'importExcel'])->name('input-customers');


Route::post('/user/add', [APIAuthController::class, 'addMeterReading']);
Route::post('/user/add-case', [APIAuthController::class, 'addCase']);

Route::get('/user/meter-reading-detail/{id}', [APIAuthController::class, 'getMeterReadingDetail']);

Route::get('/user/meter-customer/{id}', [APIAuthController::class, 'getMeterCustomer']);

Route::get('/user/messages/{user}', [APIAuthController::class, 'getUserMessages']);

Route::get('/user/crew/{user}', [APIAuthController::class, 'getUserCrew']);

Route::get('/users', [APIAuthController::class, 'getUsers']);

Route::post('/add-user-current-location', [APIAuthController::class, 'addUserCurrentLocation']);

Route::get('/user/crew/tasks/{crew}', [APIAuthController::class, 'getCrewTasks']);

Route::get('/customers', [APIAuthController::class, 'customers']);
Route::post('/update-customer-location', [APIAuthController::class, 'updateCustomerLocation']);


Route::get('/user/comments/{taskId}', [APIAuthController::class, 'getTaskComments']);
Route::get('/settings', [APIAuthController::class, 'getSettings']);


Route::get('/meter/{meter}', [APIAuthController::class, 'getMeter']);

Route::get('/customer/{customer}', [APIAuthController::class, 'getCustomer']);

// Protected routes that require authentication

Route::group(['middleware' => 'auth:sanctum'], function () {

    // Route to log out and invalidate user token

    Route::post('/logout', [APIAuthController::class, 'logout']);

    // Route to get user information

    Route::get('/user', function (Request $request) {

        return $request->user();
    });
});
