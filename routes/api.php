<?php

use App\Http\Controllers\PdfController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/resume/download', [PdfController::class, 'download']);
