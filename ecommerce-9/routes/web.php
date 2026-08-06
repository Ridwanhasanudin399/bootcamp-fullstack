<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function () {
    return view('products');
});

Route::get('/cart', function () {
    echo 'Cart Page';
});

Route::get('/checkout', function () {
    echo 'Checkout Page';
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::prefix('contact')->group(function () {
    Route::get('/create', function () {
        return view('contact.email');
    });

    Route::get('/update', function () {
        return view('contact.phone');
    });
});

// Saya membuat Limiter di app/Providers/AppServiceProvider.php
// seperti ini:
// PHP
// use Illuminate\Cache\RateLimiting\Limit;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\RateLimiter;

// public function boot(): void
// {
//     RateLimiter::for('global', function (Request $request) {
//         return Limit::perMinute(5)->by($request->ip());
//     });
// }

// kemudian saya Otomatiskan di Kernel / App Config dengan menambahkan kode berikut di bootstrap/app.php:

// PHP
// ->withMiddleware(function (Middleware $middleware) {
//     // Pasang 'throttle:global' secara otomatis ke seluruh route 'web'
//     $middleware->web(append: [
//         'throttle:global',
//     ]);
// })

// Hasilnya pada File routes/web.php ini 100% otomatis menggunakan rate limiting global, jadi setiap IP hanya bisa mengakses halaman ini maksimal 5 kali dalam 1 menit. Jika melebihi batas tersebut, maka akan mendapatkan response error 429 (Too Many Requests).
