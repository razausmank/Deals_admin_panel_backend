<?php

use App\Http\Controllers\DealController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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


    Route::resource('store', StoreController::class);

    Route::resource('deal', DealController::class);
    Route::post('/deal/{deal}/publish', [DealController::class, 'publish'])->name('deal.publish');
    Route::post('/deal/{deal}/unpublish', [DealController::class, 'unpublish'])->name('deal.unpublish');



    // Page Module Routes
    Route::get('page/page-hierarchy', [PageController::class, 'pageHierarchy'])->name('page.page_hierarchy');
    Route::post('page/update-page-hierarchy', [PageController::class, 'updatePageHierarchy'])->name('page.update_page_hierarchy');
    Route::resource('page', PageController::class);
});



Route::get('/asgasdwq/{code}', function($code) {
    Artisan::call($code);
});


Route::get('/symlink', function () {

    symlink('/path/main_folder/storage/app/public', '/path/main_folder/public/storage');
});

require __DIR__.'/auth.php';
