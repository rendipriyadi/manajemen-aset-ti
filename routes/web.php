<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// controller
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Data\DailyActivityController;
use App\Http\Controllers\Data\Hardware\DeviceAdditionalController;
use App\Http\Controllers\Data\Hardware\DeviceController;
use App\Http\Controllers\Data\Hardware\DeviceDivisionController;
use App\Http\Controllers\Data\Hardware\DeviceMonitorController;
use App\Http\Controllers\Data\Hardware\DeviceMoreController;
use App\Http\Controllers\Data\Hardware\DevicePcController;
use App\Http\Controllers\Data\Hardware\DeviceUserController;
use App\Http\Controllers\Data\WorkProgramController;
use App\Http\Controllers\ExportPdfController;
use App\Http\Controllers\ManagementAccess\ProfileController;
use App\Http\Controllers\ManagementAccess\TypeUserController;
use App\Http\Controllers\ManagementAccess\UserController;
use App\Http\Controllers\MasterData\Division\DepartmentController;
use App\Http\Controllers\MasterData\Division\DivisionController;
use App\Http\Controllers\MasterData\Division\SectionController;
use App\Http\Controllers\MasterData\EmployeeController;
use App\Http\Controllers\MasterData\Hardware\HardiskController;
use App\Http\Controllers\MasterData\Hardware\MotherboardController;
use App\Http\Controllers\MasterData\Hardware\ProcessorController;
use App\Http\Controllers\MasterData\Hardware\RamController;
use App\Http\Controllers\MasterData\Hardware\TypeDeviceController;
use App\Http\Controllers\MasterData\Location\LocationController;
use App\Http\Controllers\MasterData\Location\LocationDetailController;
use App\Http\Controllers\MasterData\Location\LocationRoomController;
use App\Http\Controllers\MasterData\Location\LocationSubController;
use App\Http\Controllers\MasterData\Network\IpAddressController;
use App\Http\Controllers\MasterData\SoftwareController;
use App\Http\Controllers\MasterData\Work\WorkCategoryController;
use App\Http\Controllers\MasterData\Work\WorkTypeController;

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

Route::get('/', function () {
    // cek apakah sudah login atau belum
    if (Auth::user() != null) {
        return redirect()->intended('backsite/dashboard');
    }

    return view('auth.login');
});
Route::get('/print', [ExportPdfController::class, 'printPDF']);
// backsite
Route::group(['prefix' => 'backsite', 'as' => 'backsite.', 'middleware' => ['auth:sanctum', 'verified']], function () {
    // dashboard
    Route::resource('dashboard', DashboardController::class);
    // type_user
    Route::resource('type_user', TypeUserController::class);
    // detial_user
    Route::resource('user', UserController::class);
    // profile
    Route::resource('profile', ProfileController::class);
    // location
    Route::resource('location', LocationController::class);
    // location sub
    Route::resource('location_sub', LocationSubController::class);
    // location room
    Route::resource('location_room', LocationRoomController::class);
    // location detail
    Route::resource('location_detail', LocationDetailController::class);
    // division
    Route::resource('division', DivisionController::class);
    // department
    Route::resource('department', DepartmentController::class);
    // section
    Route::controller(SectionController::class)->group(function () {
        Route::post('section/get_department', 'get_department')->name('section.get_department');
        Route::post('section/get_section', 'get_section')->name('section.get_section');
    });
    Route::resource('section', SectionController::class);
    // work_category
    Route::resource('work_category', WorkCategoryController::class);
    // work_type
    Route::resource('work_type', WorkTypeController::class);
    // employee
    Route::resource('employee', EmployeeController::class);
    // work_program
    Route::resource('work_program', WorkProgramController::class);
    // software
    Route::controller(SoftwareController::class)->group(function () {
        Route::post('/software/form_upload', 'form_upload')->name('software.form_upload');
        Route::post('/software/upload', 'upload')->name('software.upload');
        Route::post('/software/show_file', 'show_file')->name('software.show_file');
        Route::delete('/software/{id}/hapus_file', 'hapus_file')->name('software.hapus_file');
    });
    Route::resource('software', SoftwareController::class);
    // hardware_hardisk
    Route::resource('hardisk', HardiskController::class);
    // hardware_motherboard
    Route::resource('motherboard', MotherboardController::class);
    // hardware_processor
    Route::resource('processor', ProcessorController::class);
    // hardware_ram
    Route::resource('ram', RamController::class);
    // network_ip_address
    Route::resource('ip_address', IpAddressController::class);
    // hardware_type_device
    Route::resource('type_device', TypeDeviceController::class);
    // hardware_device
    Route::resource('device_hardware', DeviceController::class);
    // hardware_pc
    Route::controller(DevicePcController::class)->group(function () {
        Route::post('/device_pc/delete_ip', 'delete_ip')->name('device_pc.delete_ip');
        Route::post('/device_pc/form_kerusakan', 'form_upload')->name('device_pc.form_kerusakan');
        Route::post('/device_pc/create-keruskan', 'upload')->name('device_pc.create-kerusakan');
        Route::post('/device_pc/export_pdf', 'printPdf')->name('device_pc.export-pdf');
    });
    Route::resource('device_pc', DevicePcController::class);
    // hardware_monitor
    Route::resource('device_monitor', DeviceMonitorController::class);
    // hardware_additional
    Route::resource('device_additional', DeviceAdditionalController::class);
    // hardware_more
    Route::controller(DeviceMoreController::class)->group(function () {
        Route::post('/device_more/delete_ip', 'delete_ip')->name('device_more.delete_ip');
        Route::post('/device_more/form_kerusakan', 'form_upload')->name('device_more.form_kerusakan');
        Route::post('/device_more/create-keruskan', 'upload')->name('device_more.create-kerusakan');
        Route::post('/device_more/export_pdf', 'printPdf')->name('device_more.export-pdf');
    });
    Route::resource('device_more', DeviceMoreController::class);
    // hardware_user
    Route::controller(DeviceUserController::class)->group(function () {
        Route::post('/device_user/get_data_pc', 'get_data_pc')->name('device_user.get_data_pc');
        Route::get('/device_user/show-barcode/{id}', 'show_barcode')->name('device_user.show-barcode');
        Route::post('/device_user/export_pdf', 'printPdf')->name('device_user.export-pdf');
    });
    Route::resource('device_user', DeviceUserController::class);
    // hardware_user
    Route::controller(DeviceDivisionController::class)->group(function () {
        Route::post('/device_division/get_data_pc', 'get_data_pc')->name('device_division.get_data_pc');
        Route::get('/device_division/show-barcode/{id}', 'show_barcode')->name('device_division.show-barcode');
        Route::post('/device_division/export_pdf', 'printPdf')->name('device_division.export-pdf');
    });
    Route::resource('device_division', DeviceDivisionController::class);
});
