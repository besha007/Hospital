<?php

use App\Http\Controllers\Dashboard_Doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_Doctor\LaboratorieController;
use App\Http\Controllers\Dashboard_Doctor\PatientDetailsController;
use App\Http\Controllers\Dashboard_Doctor\RayController;
use App\Http\Controllers\Dashboard_Ray_Employee\InvoiceController;
use App\Http\Controllers\doctor\InvoicesController;
use Illuminate\Support\Facades\Route;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Backend Ray Employee
*/
//==================================================================================
 
Route::group(
   [
       'prefix' => LaravelLocalization::setLocale(),
       'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
   ], function () {


   //=================================== dashboard RayEmployee ======================================

   Route::get('/dashboard/ray_employee', function () {
       return view('Dashboard.dashboard_RayEmployee.dashboard');
   })->middleware(['auth:ray_employee'])->name('dashboard.ray_employee');
   //=============================== end dashboard RayEmployee ======================================

   Route::middleware(['auth:ray_employee'])->group(function () {

   //====================================== invoices route ==========================================
    Route::resource('invoices_ray_employee', InvoiceController::class);
    
    Route::get('completed_invoices', [InvoiceController::class,'completed_invoices'])->name('completed_invoices');
    Route::get('view_rays/{id}', [InvoiceController::class,'viewRays'])->name('view_rays');

       //=================================== end invoices route ========================================

   });



//---------------------------------------------------------------------------------------------------------------


   require __DIR__ . '/auth.php';

});



