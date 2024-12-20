<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\staffController;
use App\Models\Comment; 


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
    return view('layout.home');
});


Route::get('/login', function(){
    return view('login');
})->name('login');



Route::get('/landing', [SessionController::class, 'landing'])->name('article.landing');


Route::post('/login.proses', [SessionController::class, 'loginProses'])->name('login.proses');
Route::get('/logout', [SessionController::class, 'logout'])->name('logout.proses');
Route::get('/landing-page', [SessionController::class, 'index'])->name('landing_page');

Route::get('/report/create', [ReportController::class, 'create'])->name('report.create');
Route::post('/report/store', [ReportController::class, 'store'])->name('report.store');
Route::post('/reports/{id}/vote', [ReportController::class, 'vote'])->name('reports.vote');
Route::get('/reports/{id}', [ReportController::class, 'show'])->name('reports.show');
Route::post('/repcoorts/{id}/comments', [ReportController::class, 'storeComment'])->name('reports.comment.store');
Route::post('/reports/{id}/increment-viewers', [ReportController::class, 'incrementViewers'])->name('reports.incrementViewers');
Route::get('/monitoring', [ReportController::class, 'monitoring'])->name('reports.monitoring');
Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('reports.destroy');

Route::get('/report', [staffController::class, 'report'])->name('staff.report');


