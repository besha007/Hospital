<?php

use App\Http\Controllers\Dashboard_Laboratorie_Employee\InvoiceController;
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

   Route::get('/dashboard/laboratorie_employee', function () {
       return view('Dashboard.dashboard_LaboratorieEmployee.dashboard');
   })->middleware(['auth:laboratorie'])->name('dashboard.laboratorie_employee');
   //=============================== end dashboard RayEmployee ======================================

   Route::middleware(['auth:laboratorie'])->group(function () {


    //############################# invoices route ##########################################
     Route::resource('invoices_laboratorie_employee', InvoiceController::class);
     Route::get('completed_invoices', [InvoiceController::class,'completed_invoices'])->name('completed_invoices');
     Route::get('view_laboratories/{id}', [InvoiceController::class,'view_laboratories'])->name('view_laboratories');
    //############################# end invoices route ######################################

    });



//---------------------------------------------------------------------------------------------------------------


   require __DIR__ . '/auth.php';

});



