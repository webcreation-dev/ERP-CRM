<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SSO\SSOController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ComfileController;
use App\Http\Controllers\HomeControlleur;
use App\Http\Livewire\Home;
use App\Http\Controllers\PDFController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|s
*/



require __DIR__.'/auth.php';

Route::group([
    "middleware" => ["auth"],

], function(){

    Route::get('/print-pdf/{id}', [PDFController::class, 'printPDF'])->name('print.pdf');
    Route::get('/export-pdf', [PDFController::class, 'exportPDF'])->name('export.pdf');

    Route::get('/home', [HomeControlleur::class, 'index'])->name('home');

    Route::get('s_salesforces', Home::class)->name('comfiles.index');
    Route::post('comfiles', [ComfileController::class, 'store'])->name('comfiles.store');
    Route::get('comfiles/create', [ComfileController::class, 'create'])->name('comfiles.create');
    Route::get('comfiles/{comfile}/edit', [ComfileController::class, 'edit'])->name('comfiles.edit');
    Route::get('comfiles/{comfile}', [ComfileController::class, 'show'])->name('comfiles.show');
    Route::get('comfiles/{comfile}', [ComfileController::class, 'passClient'])->name('comfile.client');
    Route::put('comfiles/{comfile}', [ComfileController::class, 'update'])->name('comfiles.update');
    Route::delete('comfiles/{comfile}', [ComfileController::class, 'destroy'])->name('comfiles.destroy');


    Route::get('appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::put('appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
});

Route::get('/', function () {
    return view('welcome1');
})->name("welcome");

Route::get("/sso/login", [SSOController::class, 'getLogin'])->name("sso.login");
Route::get("/callback", [SSOController::class, 'getCallback'])->name("sso.callback");
Route::get("/sso/connect", [SSOController::class, 'connectUser'])->name("sso.connect");

