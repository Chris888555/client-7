<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/', function () {
   return view('home');
});

Route::get('/company-profile', function () {
   return view('company-profile');
});

Route::get('/products', function () {
   return view('products');
});

Route::get('/login', function () {
   return view('auth.login');

});
