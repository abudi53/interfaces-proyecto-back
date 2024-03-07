<?php

use Illuminate\Support\Facades\Route;
use App\Mail\FacturaMail;
use Illuminate\Support\Facades\Mail;

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

Route::get('/factura', function () {

    $filePath = public_path('favicon.ico');

    Mail::to('abdallahffh@gmail.com')->send(new FacturaMail($filePath));
});
