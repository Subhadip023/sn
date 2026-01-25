<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Page;
Route::get('/', function () {
    $pages = Page::where('active', true)->get()->toArray();
    return view('welcome')->with('pages', $pages);
});

Route::get('/{slug}', function ($slug) {
    $page = Page::where('slug', $slug)->first();
    $pages = Page::where('active', true)->get()->toArray();
    return view('page')->with('page', $page)->with('pages', $pages);
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/admin.php';


Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/content', function () {
    return view('admin.content');
})->name('admin.content');

Route::get('/admin/users', function () {
    return view('admin.users');
})->name('admin.users');

Route::get('/admin/content', function () {
    return view('admin.content');
})->name('admin.content');

require __DIR__.'/auth.php';
