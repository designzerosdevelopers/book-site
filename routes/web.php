<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesSettingController;
use App\Http\Controllers\SiteViewController;
use App\Http\Controllers\StripeController;
use App\Mail\ExampleMail;
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

Route::post('/charge', [StripeController::class, 'charge'])->name('charge');
Route::get('/checkout/cancel',  [StripeController::class, 'cancel'])->name('checkout.cancel');

Route::get('/dashboard', function () {
    return view('adminpages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// clientside controller
Route::get('/', [SiteViewController::class, 'index'])->name('index');
Route::get('/product-details', [SiteViewController::class, 'productdetails'])->name('product.details');
Route::get('/about', [SiteViewController::class, 'about'])->name('about');

Route::get('/shop', [SiteViewController::class, 'shop'])->name('shop');
Route::get('/blog', [SiteViewController::class, 'blog'])->name('blog');
Route::get('/cart', [SiteViewController::class, 'cart'])->name('cart');
Route::get('/remove-from-cart/{itemId}', [SiteViewController::class, 'removeFromCart'])->name('remove_from_cart');
Route::post('/checkout', [SiteViewController::class, 'checkout'])->name('checkout');
Route::get('/contact', [SiteViewController::class, 'contact'])->name('contact');
Route::get('/thankyou', [SiteViewController::class, 'thankyou'])->name('thankyou');
Route::get('/cartItemCount', [SiteViewController::class, 'getCartItemCount'])->name('cartcount');

// user details and profile settings 
Route::get('/user', [SiteViewController::class, 'user'])->name('user');

Route::get('/passwordreset', [SiteViewController::class, 'passwordreset']);


 // adminside controller
Route::middleware('auth')->group(function () {   
    //homepage setting  route
    Route::get('/indexhomesettings', [PagesSettingController::class, 'indexhome'])->name('indexhome');
    Route::put('/updatehomesettings', [PagesSettingController::class, 'updatehome'])->name('updatehome');
    Route::get('/homeedit', [PagesSettingController::class, 'homeedit'])->name('homeedit');

    //category routes
    Route::get('/indexcategories', [PagesSettingController::class, 'indexcategories'])->name('indexcategories');
    Route::put('/updatecategory/{id}', [PagesSettingController::class, 'updatecategory'])->name('updatecategory');
    Route::delete('/deletecategory', [PagesSettingController::class, 'deletecategory'])->name('deletecategory');
    Route::put('/createcategory', [PagesSettingController::class, 'createcategory'])->name('createcategory');

    // csv import export route
    Route::get('/csv-import', [PagesSettingController::class, 'CsvImport'])->name('csv.import');
    Route::post('/save-csv', [PagesSettingController::class, 'CsvSave'])->name('csv.save');
    Route::get('/export-csv', [PagesSettingController::class, 'ExportCsv'])->name('export.csv');
    

    //item routes
    Route::get('/indexitem', [PagesSettingController::class, 'indexitem'])->name('indexitem');
    Route::get('/createitem', [PagesSettingController::class, 'createitem'])->name('createitem');
    Route::get('/edititem/{id}', [PagesSettingController::class, 'edititem'])->name('edititem');
    Route::put('/updateitem/{id}', [PagesSettingController::class, 'updateitem'])->name('updateitem');
    Route::post('/storeitem', [PagesSettingController::class, 'storeitem'])->name('storeitem');
    Route::delete('/deleteitem/{id}', [PagesSettingController::class, 'deleteitem'])->name('deleteitem');

    // uploads routes
    Route::get('/uploadsindex', [PagesSettingController::class, 'uploadsindex'])->name('uploads.index');
    Route::post('/saveuploads', [PagesSettingController::class, 'saveuploads'])->name('save.uploads');
    Route::get('/deleteuploads', [PagesSettingController::class, 'deleteuploads'])->name('delete.uploads');

    // purchases routes
    Route:: get('/purchases', [PagesSettingController::class, 'purchases']) -> name ('purchases.index') ;
    
    // setting routes
    Route::get('/settings', [PagesSettingController::class,'settingsindex'])->name('settings.index');
    Route::post('/updatesettings', [PagesSettingController::class,'updatesettings'])->name('update.settings');
});