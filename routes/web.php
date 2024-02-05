<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Agent\AgentDashboard;

use App\Http\Controllers\Admin\Customers\CustomersController;
use App\Http\Controllers\Admin\Customers\AddCustomersController;
use App\Http\Controllers\Admin\Users\AddUsersController;
use App\Http\Controllers\Admin\Users\UsersController;
use App\Http\Controllers\Admin\Connections\ConnectionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\Task\TaskController;
use App\Http\Controllers\Admin\Meters\MetersController;
use App\Http\Controllers\Admin\Crews\CrewsController;
use App\Http\Controllers\Admin\Email\EmailController;
use App\Http\Controllers\Admin\AutoComplete\AutoCompleteController;
use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Export\Customers;
use App\Http\Controllers\Admin\AIR\AIR;
use App\Http\Controllers\Admin\Campaigns\Campaigns;
use App\Http\Controllers\Admin\CommunityEngagement\CommunityEngagement;
use App\Http\Controllers\Admin\LossReduction\LossReduction;
use App\Http\Controllers\Admin\WRM\WRM;
use App\Http\Controllers\Admin\WRM\ServiceInventoryManagement;
use App\Http\Controllers\Admin\WRM\TaskMaintenace;
use App\Http\Controllers\Admin\AIR\StolenMeterIdentification;
use App\Http\Controllers\Admin\DataReconciliation;
use App\Http\Controllers\Admin\ItineraryController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('home');
    Route::get('inbox', [EmailController::class, 'inbox'])->name('inbox');
    Route::get('compose', [EmailController::class, 'compose'])->name('compose');
    Route::get('sent', [EmailController::class, 'sent'])->name('sent');
    Route::get('read', [EmailController::class, 'messageRead'])->name('message-read');
    Route::get('unread', [EmailController::class, 'unread'])->name('unread');
    Route::get('read/{email_id}', [EmailController::class, 'read'])->name('read');
    Route::post('/autocomplete/fetch', [AutoCompleteController::class, 'fetch'])->name('autocomplete.fetch');
    Route::get('emails/{email}/download-all-attachments', [EmailController::class, 'downloadAllAttachments'])
        ->name('emails.download-all-attachments');
});

Route::group(['middleware' => 'role:admin'], function () {
    Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
    // other admin routes
    Route::get('customers', [CustomersController::class, 'index'])->name('customers');
    Route::get('customer-profile/{customer_id}', [CustomersController::class, 'customerProfile'])->name('customer-profile');
    Route::post('import-customers', [CustomersController::class, 'importExcel'])->name('input-customers');
    Route::post('import-consumptions', [CustomersController::class, 'importExcelConsumption'])->name('input-consumptions');
    Route::get('add-customers', [AddCustomersController::class, 'index'])->name('add-customers');
    Route::get('users', [UsersController::class, 'index'])->name('users');
    Route::get('crews', [CrewsController::class, 'crews'])->name('crews');
    Route::get('crew-members/{crew_id}', [CrewsController::class, 'crewMembers'])->name('crew-members');
    Route::get('single-crew/{crew_id}', [CrewsController::class, 'singleCrew'])->name('single-crew');
    Route::get('add-crew-members/{crew_id}', [CrewsController::class, 'addCrewMembers'])->name('add-crew-members');
    Route::get('los-reduction', [LossReduction::class, 'lossReduction'])->name('los-reduction');
    Route::get('registerd-case', [LossReduction::class, 'registeredCase'])->name('registerd-case');
    Route::get('reported-case', [LossReduction::class, 'reportedCase'])->name('reported-case');
    Route::get('case-dashboard', [LossReduction::class, 'caseDashboard'])->name('case-dashboard');
    Route::get('los-reduction-case-detail/{id}', [LossReduction::class, 'lossReductionCaseDetail'])->name('los-reduction-case-detail');
    Route::get('itinerary-detail/{itinerary_id}', [ItineraryController::class, 'itineraryDetail'])->name('itinerary-detail');

    Route::get('add-los-reduction', [LossReduction::class, 'addlossReduction'])->name('add-lost-reduction');
    Route::get('community-engagement', [CommunityEngagement::class, 'communityEngagement'])->name('community-engagement');
    
    Route::get('customers-engagement', [LossReduction::class, 'customerEngagement'])->name('customers-engagement');
    Route::get('customers-outbound-engagement', [LossReduction::class, 'OutboundEngagement'])->name('customers-outbound-engagement');
    Route::get('customers-inbound-engagement', [LossReduction::class, 'InboundEngagement'])->name('customers-inbound-engagement');
    Route::get('customers-hotline-engagement', [LossReduction::class, 'HotlineEngagement'])->name('customers-hotline-engagement');
    Route::get('customers-engagement-dashboard', [LossReduction::class, 'EngagmentDashboard'])->name('customers-engagement-dashboard');


    Route::get('campaigns', [Campaigns::class, 'campaigns'])->name('campaigns');
    Route::get('air', [AIR::class, 'air'])->name('air');
    Route::get('wrm', [WRM::class, 'wrm'])->name('wrm');
    Route::get('task-maintenance', [TaskMaintenace::class, 'taskMaintenance'])->name('task-maintenance');
    Route::get('service-inventory-management', [ServiceInventoryManagement::class, 'serviceInventoryManagement'])->name('service-inventory-management');
    Route::get('data-reconciliation', [DataReconciliation::class, 'dataReconciliation'])->name('data-reconciliation');
    Route::get('stolen-meter-identification', [StolenMeterIdentification::class, 'stolenMeterIdentification'])->name('stolen-meter-identification');
    Route::get('/ajax-get-customers', [CustomersController::class, 'getCustomers']);
    Route::get('export-import-customers', [Customers::class, 'importCustomer'])->name('export-import-customer');
    Route::get('export-import-service-orders', [Customers::class, 'importServiceOrder'])->name('export-import-service-orders');
    Route::get('export-import-meters', [Customers::class, 'importMeter'])->name('export-import-meters');

    Route::get('user-profile/{user_id}', [UsersController::class, 'userProfile'])->name('user-profile');
    Route::get('add-users', [AddUsersController::class, 'index'])->name('add-users');
    Route::get('service-order', [ConnectionController::class, 'serviceOrder'])->name('service-order');
    Route::get('new-service-order', [ConnectionController::class, 'newServiceOrder'])->name('new-service-order');
    Route::get('single-service-order/{service_order_id}', [ConnectionController::class, 'singleServiceOrder'])->name('single-service-order');
    Route::get('add-customer-service-order/{customer_id}', [ConnectionController::class, 'addCustomerServiceOrder'])->name('add-customer-service-order');
    Route::get('meters', [MetersController::class, 'meters'])->name('meters');
    Route::get('meter-detail/{meter_id}', [MetersController::class, 'meterDetail'])->name('meter-detail');
    Route::get('system-settings', [SettingsController::class, 'settings'])->name('system-settings');
    Route::get('meter-reading-tasks', [TaskController::class, 'meterReadingTasks'])->name('meter-reading-tasks');
    Route::get('meter-readings-list', [TaskController::class, 'meterReadingList'])->name('meter-reading-list');
    Route::get('meter-reading-detail/{id}', [TaskController::class, 'meterReadingDetail'])->name('meter-reading-detail');
    Route::get('user-meter-reading-itineraries/{user_id}', [TaskController::class, 'userMeterReadingItineraries'])->name('user-meter-reading-itineraries');

    Route::get('service-order-task-report', [TaskController::class, 'serviceOrderTaskReport'])->name('service-order-task-report');
    Route::get('service-order-task-report-detail/{id}', [TaskController::class, 'serviceOrderTaskReportDetail'])->name('service-order-task-report-detail');

    Route::get('meter-reading-task-detail/{task_id}', [TaskController::class, 'readingTaskDetail'])->name('meter-reading-task-detail');
    Route::get('new-connection-tasks', [TaskController::class, 'newConnectionTasks'])->name('new-connection-tasks');
    Route::get('add-tasks', [TaskController::class, 'addTasks'])->name('add-tasks');
    Route::get('my-tasks', [TaskController::class, 'myTasks'])->name('my-tasks');
    Route::get('single-task/{task_id}', [TaskController::class, 'singleTask'])->name('single-task');
    Route::get('edit-task/{task_id}', [TaskController::class, 'editTask'])->name('edit-task');
});

Route::group(['middleware' => 'role:agent'], function () {
    Route::get('/agent', 'AgentDashboard@index')->name('agent.dashboard');
    // other agent routes
});
