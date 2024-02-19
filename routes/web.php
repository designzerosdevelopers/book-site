<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesSettingController;
use App\Http\Controllers\SiteviewController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('adminpages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/indexitem', [PagesSettingController::class, 'indexitem'])->name('indexitem');
Route::get('/createitem', [PagesSettingController::class, 'createitem'])->name('createitem');
Route::delete('/deleteitem/{id}', [PagesSettingController::class, 'deleteitem'])->name('deleteitem');

// admin index pages setting controller route
Route::get('/indexhomesettings', [PagesSettingController::class, 'indexhome'])->name('indexhome');
// admin update pages setting controller route
Route::put('/updatehomesettings', [PagesSettingController::class, 'updatehome'])->name('updatehome');
// admin category pages setting controller route
Route::get('/indexcategories', [PagesSettingController::class, 'indexcategories'])->name('indexcategories');
// admin category pages setting controller route
Route::put('/updatecategory', [PagesSettingController::class, 'updatecategory'])->name('updatecategory');
// admin category pages setting controller route
Route::delete('/deletecategory', [PagesSettingController::class, 'deletecategory'])->name('deletecategory');

// index client pages route
Route::get('/', [SiteViewController::class, 'index'])->name('index');

// about pages route
Route::get('/about', function () {
    return view('clientpages.about');
})->name('about');


// shop pages route
Route::get('/shop', function () {
    return view('clientpages.shop');
})->name('shop');

// blog pages route
Route::get('/blog', function () {
    return view('clientpages.blog');
})->name('blog');

// cart pages route
Route::get('/cart', function () {
    return view('clientpages.cart');
})->name('cart');

// checkout pages route
Route::get('/checkout', function () {
    return view('clientpages.checkout');
})->name('checkout');

// contact pages route
Route::get('/contact', function () {
    return view('clientpages.contact');
})->name('contact');

// thankyou pages route
Route::get('/thankyou', function () {
    return view('clientpages.thankyou');
})->name('thankyou');

// thankyou pages route
Route::get('/homeedit', function () {
    return view('adminpages.editpages.homeedit');
})->name('homeedit');