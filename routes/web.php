<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//API
Route::get('getDepartments','\App\Http\Controllers\ApiController@getDepartments');

//Contact
Route::get('/contact', function(){
    return Inertia::render('Contact');
})->name('contact');

Route::middleware(['auth:sanctum', 'verified'])->prefix('dashboard')->group(function () {
    //Dashboard
    Route::get('/', function(){
        return Inertia::render('Dashboard');
    })->name('dashboard');
    //Department
    Route::resource('department', \App\Http\Controllers\DepartmentController::class);
    //Staff
    Route::resource('staff', \App\Http\Controllers\StaffController::class);
    //Job Description
    Route::resource('job-description', \App\Http\Controllers\JobDescriptionController::class);
    //Machine
    Route::resource('machine', \App\Http\Controllers\MachineController::class);
    //Machine Type
    Route::resource('machine-type', \App\Http\Controllers\MachineTypeController::class);
    //Maintenance
    Route::resource('maintenance', \App\Http\Controllers\MaintenanceController::class);
    //Maintenance Action
    Route::resource('maintenance-action', \App\Http\Controllers\MaintenanceActionController::class);
    //Maintenance Plan
    Route::resource('maintenance-plan', \App\Http\Controllers\MaintenancePlanController::class);
    //Maintenance Type
    Route::resource('maintenance-type', \App\Http\Controllers\MaintenanceTypeController::class);
    //Product
    Route::resource('product', \App\Http\Controllers\ProductController::class);
    //Product Type
    Route::resource('product-type', \App\Http\Controllers\ProductTypeController::class);
    //Product Variation
    Route::resource('product-variation', \App\Http\Controllers\ProductVariationController::class);
    //Product Quality Plan
    Route::resource('product-quality-plan', \App\Http\Controllers\ProductQualityPlanController::class);
    //Recipe
    Route::resource('recipe', \App\Http\Controllers\RecipeController::class);
    //Raw Material
    Route::resource('raw-material', \App\Http\Controllers\RawMaterialController::class);
    //Raw Material Type
    Route::resource('raw-material-type', \App\Http\Controllers\RawMaterialTypeController::class);
    //Raw Material Quality Plan
    Route::resource('raw-material-quality-plan', \App\Http\Controllers\RawMaterialQaulityPlanController::class);
    //Audit
    Route::resource('audit', \App\Http\Controllers\AuditController::class);
    //Audit Type
    Route::resource('audit-type', \App\Http\Controllers\AuditTypeController::class);
    //Audit Plan
    Route::resource('audit-plan', \App\Http\Controllers\AuditPlanController::class);
    //Audit Firm
    Route::resource('audit-firm', \App\Http\Controllers\AuditFirmController::class);
    //Auditor
    Route::resource('auditor', \App\Http\Controllers\AuditorController::class);
    //Standard
    Route::resource('standard', \App\Http\Controllers\StandardController::class);
    //Document
    Route::resource('document', \App\Http\Controllers\DocumentTypeController::class);
    //Document Type
    Route::resource('document-type', \App\Http\Controllers\DocumentTypeController::class);
    //Claim
    Route::resource('claim', \App\Http\Controllers\ClaimController::class);
    //Claim Type
    Route::resource('claim-type', \App\Http\Controllers\ClaimTypeController::class);
    //Claim Action
    Route::resource('claim-action', \App\Http\Controllers\ClaimActionController::class);
    //Claim Decision
    Route::resource('claim-decision', \App\Http\Controllers\ClaimDecisionController::class);
    //Claim Property
    Route::resource('claim-property', \App\Http\Controllers\ClaimPropertyController::class);
    //Customer
    Route::resource('customer', \App\Http\Controllers\Customer::class);
    //Measurement Tool
    Route::resource('measurement-tool', \App\Http\Controllers\MeasurementToolController::class);
    //Measurement Tool Type
    Route::resource('measurement-tool-type', \App\Http\Controllers\MeasurementToolTypeController::class);
    //Measurement Tool Action
    Route::resource('measurement-tool-action', \App\Http\Controllers\MeasurementToolActionController::class);
    //Measurement Tool Property
    Route::resource('measurement-tool-property', \App\Http\Controllers\MeasurementToolPropertyController::class);

});
