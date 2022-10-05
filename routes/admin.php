<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LandownerController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\User\UserController;

//admin part start
Route::group(['prefix' =>'admin/', 'middleware' => ['auth', 'is_admin']], function(){
    Route::get('dashboard', [HomeController::class, 'adminHome'])->name('admin.dashboard')->middleware('is_admin');
    //profile
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('profile/{id}', [AdminController::class, 'adminProfileUpdate']);
    Route::post('changepassword', [AdminController::class, 'changeAdminPassword']);
    Route::put('image/{id}', [AdminController::class, 'adminImageUpload']);
    //profile end
    //admin registration
    Route::get('register','App\Http\Controllers\Admin\AdminController@adminindex');
    Route::post('register','App\Http\Controllers\Admin\AdminController@adminstore');
    Route::get('register/{id}/edit','App\Http\Controllers\Admin\AdminController@adminedit');
    Route::put('register/{id}','App\Http\Controllers\Admin\AdminController@adminupdate');
    Route::get('register/{id}', 'App\Http\Controllers\Admin\AdminController@admindestroy');
    //admin registration end
    //agent registration
    Route::get('agent-register','App\Http\Controllers\Admin\AdminController@agentindex');
    Route::post('agent-register','App\Http\Controllers\Admin\AdminController@agentstore');
    Route::get('agent-register/{id}/edit','App\Http\Controllers\Admin\AdminController@agentedit');
    Route::put('agent-register/{id}','App\Http\Controllers\Admin\AdminController@agentupdate');
    Route::get('agent-register/{id}', 'App\Http\Controllers\Admin\AdminController@agentdestroy');
    // certificate update
    // Route::post('image-upload', 'App\Http\Controllers\Admin\AdminController@agentCertificateUpdate')->name('image.upload.post');
    //agent registration end
    //user registration
    Route::get('user-register','App\Http\Controllers\Admin\AdminController@userindex');
    Route::post('user-register','App\Http\Controllers\Admin\AdminController@userstore');
    Route::get('user-register/{id}/edit','App\Http\Controllers\Admin\AdminController@useredit');
    Route::put('user-register/{id}','App\Http\Controllers\Admin\AdminController@userupdate');
    Route::get('user-register/{id}', 'App\Http\Controllers\Admin\AdminController@userdestroy');
    //user registration end
    //code master 
    Route::resource('softcode','App\Http\Controllers\Admin\SoftcodeController');
    Route::resource('master','App\Http\Controllers\Admin\MasterController');
    //code master end
    //company details
    Route::resource('company-detail','App\Http\Controllers\Admin\CompanyDetailController');
    //company details end
    //slider 
    Route::resource('sliders','App\Http\Controllers\Admin\SliderController');
    Route::get('activeslider','App\Http\Controllers\Admin\SliderController@activeslider');
    //slider end
    Route::resource('seo-settings','App\Http\Controllers\Admin\SeoSettingController');


    Route::resource('role','App\Http\Controllers\RoleController');
    Route::post('roleupdate','App\Http\Controllers\RoleController@roleUpdate');
    Route::resource('staff','App\Http\Controllers\StaffController');

    // client 
    Route::get('/client', [ClientController::class, 'index'])->name('admin.client');
    Route::post('/client', [ClientController::class, 'store']);
    Route::get('/client/{id}/edit', [ClientController::class, 'edit']);
    Route::post('/client/{id}', [ClientController::class, 'update']);
    Route::get('/client/{id}', [ClientController::class, 'delete']);

    // buyer 
    Route::get('/', [BuyerController::class, 'index'])->name('admin.buyer');
    Route::post('/buyer', [BuyerController::class, 'store']);
    Route::get('/buyer/{id}/edit', [BuyerController::class, 'edit']);
    Route::post('/buyer/{id}', [BuyerController::class, 'update']);
    Route::get('/buyer/{id}', [BuyerController::class, 'delete']);

    // buyer 
    Route::get('/buyer', [BuyerController::class, 'index'])->name('admin.buyer');
    Route::post('/buyer', [BuyerController::class, 'store']);
    Route::get('/buyer/{id}/edit', [BuyerController::class, 'edit']);
    Route::post('/buyer/{id}', [BuyerController::class, 'update']);
    Route::get('/buyer/{id}', [BuyerController::class, 'delete']);

    // land owner  
    Route::get('/landowner', [LandownerController::class, 'index'])->name('admin.landowner');
    Route::post('/landowner', [LandownerController::class, 'store']);
    Route::get('/landowner/{id}/edit', [LandownerController::class, 'edit']);
    Route::post('/landowner/{id}', [LandownerController::class, 'update']);
    Route::get('/landowner/{id}', [LandownerController::class, 'delete']);


    // land details  
    Route::get('/land/{id}', [LandownerController::class, 'land'])->name('admin.land');
    Route::post('/land', [LandownerController::class, 'landstore']);
    Route::get('/land/{id}/edit', [LandownerController::class, 'landedit']);
    Route::post('/land/{id}', [LandownerController::class, 'landupdate']);
    Route::get('/land-delete/{id}', [LandownerController::class, 'landdelete']);


});
//admin part end