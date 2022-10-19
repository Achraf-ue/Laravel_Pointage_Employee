<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Pointage_Employee;
use App\Http\Controllers\Pointage_Employee_Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/Api_Teste',[Pointage_Employee_Controller::class,'Function_1'])->name('Api_Teste');
Route::get('/Api_Teste/{id}',[Pointage_Employee_Controller::class,'Function_2']);
Route::put('/Api_Teste/{id}',[Pointage_Employee_Controller::class,'Function_3']);
/*
Route::get('/Api_Teste',[Controller::class,'Function_1'])->name('Api_Teste');
Route::post('/Managers/Insert',[Controller_Managers::class,'Managers_Insert'])->name('Managers_Insert');
*/