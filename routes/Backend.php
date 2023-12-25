<?php

use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\AppointmentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\LaboratorieEmployeeController;
use App\Http\Controllers\Dashboard\MedicineController;
use App\Http\Controllers\Dashboard\ParmacyEmployeeController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Http\Controllers\Dashboard\ReceiptAccountController;
use App\Http\Controllers\Dashboard\SingleServiceController;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Backend Routes
|
*/
Route::get('/Dashboard_Admin',[DashboardController::class,'index']);
//==================================================================================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
//================================Dashboard User======================================
        Route::get('/dashboard/user', function () {
            return view('Dashboard.User.dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard.user');
//================================Dashboard Admin=====================================
    Route::get('/dashboard/admin', function () {
            return view('Dashboard.Admin.dashboard');
        })->middleware(['auth:admin', 'verified'])->name('dashboard.admin');
        
//=====================================================================================
Route::middleware(['auth:admin'])->group(function(){
//==================Sections===========================================================
Route::resource('Sections',SectionController::class);
//=================Doctors=============================================================
Route::resource('Doctors', DoctorController::class);
Route::post('update_password', [DoctorController::class, 'update_password'])->name('update_password');
Route::post('update_status', [DoctorController::class, 'update_status'])->name('update_status');
//=====================================================================================
Route::resource('Service', SingleServiceController::class);
//
//=============================== GroupServices route==================================

Route::view('Add_GroupServices','livewire.GroupServices.include_create')->name('Add_GroupServices');

Route::view('Print_single_invoices','livewire.single_invoices.print')->name('Print_single_invoices');
//===============================insurance route ======================================

Route::resource('insurance', InsuranceController::class);
//=============================== Ambulance route =====================================

Route::resource('Ambulance', AmbulanceController::class);
//============================= Patients route=========================================

Route::resource('Patients', PatientController::class);
//=============================== SingleInvoices route==================================

Route::view('single_invoices','livewire.single_invoices.index')->name('single_invoices');
//=================================Receipt===============================================
Route::resource('Receipt', ReceiptAccountController::class);
//===============================Payment=================================================
Route::resource('Payment', PaymentAccountController::class);
//===========================Rays Employee===============================================
Route::resource('ray_employee', RayEmployeeController::class);
//=======================================================================================
Route::resource('laboratorie_employee', LaboratorieEmployeeController::class);
//========================================================================================
Route::view('group_invoices','livewire.Group_invoices.index')->name('group_invoices');
//=======================================================================================
Route::view('group_Print_group_invoices','livewire.Group_invoices.print')->name('group_Print_group_invoices');
//=======================================================================================
Route::get('appointments',[AppointmentController::class,'index'])->name('appointments.index');
Route::put('appointments/approval/{id}',[AppointmentController::class,'approval'])->name('appointments.approval');
Route::get('appointment/approval',[AppointmentController::class,'index2'])->name('appointment.approval');
Route::get('appointment/unapproval',[AppointmentController::class,'index3'])->name('appointment.unapproval');
//======================================================================================================
Route::resource('ParmacyEmployee',ParmacyEmployeeController::class);
//======================================================================================================
Route::resource('medicines',MedicineController::class);
Route::view('medicine-invoice','livewire.Medicine.index')->name('medicine-invoice');
});

        require __DIR__.'/auth.php';

    });


