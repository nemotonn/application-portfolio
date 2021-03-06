<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendardataController;
use App\Http\Controllers\Auth\LoginController;

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
    return redirect('/login');

});


Route::prefix('calendardatas')->group(function () {

      Route::get('/show/{date}', [CalendardataController::class, 'show'])
                  ->name('calendardatas.show');
      Route::get('/edit/{calendardata_id}', [CalendardataController::class, 'edit'])
                  ->name('calendardatas.edit');
      Route::post('/update/{calendardata_id}',[CalendardataController::class, 'update'])
                  ->name('calendardatas.update');
      Route::get('/percentagelist/{year?}/{month?}',[CalendardataController::class, 'percentagelist'])
                  ->name('calendardatas.percentagelist');
      Route::get('/percentageupdate/{scheduleId}/{done}',[CalendardataController::class, 'percentageupdate'])
                  ->name('calendardatas.percentageupdate');


      Route::get('/create',[CalendardataController::class, 'create'])
                  ->name('calendardatas.create');
      Route::get('/editlist', [CalendardataController::class, 'editlist'])
                  ->name('calendardatas.editlist');
      Route::post('/', [CalendardataController::class, 'store'])
                  ->name('calendardatas.store');

      Route::get('/{year?}/{month?}', [CalendardataController::class, 'index'])
                  ->name('calendardatas.index');
      Route::delete('/{calendardata_id}',[CalendardataController::class, 'destroy'])
                  ->name('calendardatas.destroy');

});

//ゲストログイン
Route::get('guest', [App\Http\Controllers\Auth\LoginController::class, 'guestLogin'])->name('login.guest');

Auth::routes();
