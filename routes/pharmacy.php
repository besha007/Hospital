<?php

use App\Http\Controllers\Dashboard_Pharmacy\PharmacyInvoiceController;
use Illuminate\Support\Facades\Route;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Backend Pharmacy Employee
*/
//==================================================================================
 
Route::group(
   [
       'prefix' => LaravelLocalization::setLocale(),
       'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
   ], function () {


   //=================================== dashboard Pharmacy ======================================

   Route::get('/dashboard/dashboard_Pharmacy', function () {
       return view('Dashboard.dashboard_Pharmacy.dashboard');
   })->middleware(['auth:pharmacy'])->name('dashboard.dashboard_Pharmacy');
   //=============================== end dashboard RayEmployee ======================================

   Route::middleware(['auth:pharmacy'],['auth.admin'])->group(function () {

    Route::resource('pharmacyinvoices', PharmacyInvoiceController::class);

    Route::view('medicine-invoice','livewire.Medicine.index')->name('medicine-invoice');
    Route::view('Print_medicine-invoice','livewire.Medicine.print')->name('Print_medicine-invoice');
   });

//---------------------------------------------------------------------------------------------------------------
   require __DIR__ . '/auth.php';

});



