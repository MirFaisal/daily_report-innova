<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportDateController;
use App\Http\Controllers\ReportItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/', [ReportDateController::class, 'index'])->name('report.show');
    Route::post('/store/report/', [ReportDateController::class, 'store'])->name('report.store');
    Route::get('/create/report', [ReportDateController::class, 'createReport'])->name('REPORT::CREATE::VIEW');
    Route::post('/store/report', [ReportDateController::class, 'storeReport'])->name('REPORT::CREATE::ACTION');
    Route::get('report/item/{report_date_id}', [ReportItemController::class, 'index'])->name('REPORT_ITEM::CREATE::VIEW');
    Route::post('/store/report-item', [ReportItemController::class, 'storeReportItem'])->name('REPORT_ITEM::CREATE::ACTION');
    Route::get('report/item/delete/{report_item_id}', [ReportItemController::class, 'deleteReportItem'])->name('REPORT_ITEM::DELETE::ACTION');


    // search page
    Route::get('search', [ReportDateController::class, 'search'])->name('SEARCH::VIEW');
    Route::post('search/result', [ReportDateController::class, 'result'])->name('SEARCH::ACTION');

});

require __DIR__ . '/auth.php';