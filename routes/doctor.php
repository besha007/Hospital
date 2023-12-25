<?php

use App\Http\Controllers\Dashboard_Doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_Doctor\LaboratorieController;
use App\Http\Controllers\Dashboard_Doctor\PatientDetailsController;
use App\Http\Controllers\Dashboard_Doctor\RayController;
use App\Http\Controllers\doctor\InvoicesController;
use Illuminate\Support\Facades\Route;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/* 
|--------------------------------------------------------------------------
| Backend Routes
*/
//==================================================================================
 Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

 Route::get('/dashboard/doctor', function () {
    return view('Dashboard.Doctor.dashboard');
 })->middleware(['auth:doctor', 'verified'])->name('dashboard.doctor');
//=====================================================================================

Route::middleware(['auth:doctor'])->group(function(){
 Route::prefix('doctor')->group(function(){

//=====================================================================================
Route::get('completed_invoices', [InvoicesController::class,'completedInvoices'])->name('completedInvoices');
//=====================================================================================
Route::get('review_invoices', [InvoicesController::class,'reviewInvoices'])->name('reviewInvoices');
//=====================================================================================
Route::resource('invoices',InvoicesController::class);
//================================Diagnostics route====================================
Route::post('add_review',[DiagnosticController::class,'addReview'])->name('add_review');
//=====================================================================================
Route::resource('Diagnostics',DiagnosticController::class);
//================================rays route============================================
Route::resource('rays', RayController::class);
//======================================================================================
Route::resource('Laboratories', LaboratorieController::class);
Route::get('show_laboratorie/{id}', [InvoicesController::class,'showLaboratorie'])->name('show.laboratorie');
//=====================================================================================
Route::get('patient_details/{id}', [PatientDetailsController::class,'index'])->name('patient_details');
//======================================================================================

 });

 Route::get('/404', function () {
   return view('Dashboard.404');
})->name('404');

   
});


        require __DIR__.'/auth.php';

    });


