<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\QRGenerator;

Route::get('/', QRGenerator::class);
