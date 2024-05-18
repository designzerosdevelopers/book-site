<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesSettingController;
use App\Http\Controllers\SiteViewController;
use App\Http\Controllers\StripeController;
use App\Mail\ExampleMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\NavbarController;


Route::get('setup', [App\Http\Controllers\SetupController::class, 'create'])->name('setup.create');
Route::post('check/database', [App\Http\Controllers\SetupController::class, 'setConfig'])->name('setup.config');
Route::post('admin/register', [App\Http\Controllers\SetupController::class, 'migrate'])->name('db.migrate');
Route::get('register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])
->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);


Route::middleware('check.database')->group(function () {
    // Your routes here
    Route::get('createTransaction', [StripeController::class, 'createTransaction'])->name('createTransaction');
    Route::get('process-transaction', [StripeController::class, 'processTransaction'])->name('processTransaction');
    Route::get('success-transaction', [StripeController::class, 'successTransaction'])->name('successTransaction');
    Route::get('cancel-transaction', [StripeController::class, 'cancelTransaction'])->name('cancelTransaction');
    Route::post('/paypalcharge', [StripeController::class, 'paypalcharge'])->name('paypalcharge');

    Route::post('/stripecharge', [StripeController::class, 'stripecharge'])->name('stripecharge');
    Route::get('/checkout/cancel',  [StripeController::class, 'cancel'])->name('checkout.cancel');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__ . '/auth.php';

// clientside controller
Route::get('/', function(){ return view('clientpages.index');})->name('index');
Route::get('/about', function(){ return view('clientpages.about');})->name('about');
Route::get('/contact', function(){ return view('clientpages.contact');})->name('contact');
Route::get('/shop', function(){ return view('clientpages.shop');})->name('shop');
Route::get('/products/{category}', [SiteViewController::class, 'getProductsByCategory'])->name('products.by.category');
Route::get('/cart/{id}', [SiteViewController::class, 'cart'])->name('cart');
Route::get('/remove-from-cart/{itemId}', [SiteViewController::class, 'removeFromCart'])->name('remove_from_cart');
Route::get('/checkout', [SiteViewController::class, 'checkout'])->name('checkout');
Route::get('/thankyou', [SiteViewController::class, 'thankyou'])->name('thankyou');
Route::get('/cartItemCount', [SiteViewController::class, 'getCartItemCount'])->name('cartcount');

// user details and profile settings 
Route::get('/user', [SiteViewController::class, 'user'])->name('user');
Route::get('/passwordreset', [SiteViewController::class, 'passwordreset']);




    // Adminside Routes
    Route::middleware('auth', 'checkUserRole')->group(function () {
        
        // Dashboard
        Route::get('/dashboard', [PagesSettingController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

        //Pages setting route
        Route::get('/home-settings', function(){ return view('adminpages.pages-settings.home-settings');})->name('edit.home');
        Route::get('/about-settings', function(){ return view('adminpages.pages-settings.about-settings');})->name('edit.about');
        Route::get('/item-design-settings', function(){ return view('adminpages.pages-settings.item-design-settings');})->name('edit.item.design');
        Route::get('/contact-settings', function(){ return view('adminpages.pages-settings.contact-settings');})->name('edit.contact');
        Route::get('/footer-settings', function(){ return view('adminpages.pages-settings.footer-settings');})->name('edit.footer');
        Route::get('/navbar-settings', function(){ return view('adminpages.pages-settings.navbar-settings');})->name('edit.navbar');
        Route::get('/shop-settings', function(){ return view('adminpages.pages-settings.shop-settings');})->name('edit.shop');
        Route::get('/product-detail-settings', function(){ return view('adminpages.pages-settings.product.detail-settings');})->name('edit.product.detail');

        Route::get('/theme-settings', [PagesSettingController::class, 'editTheme'])->name('edit.theme');
        Route::post('/theme-update',[PagesSettingController::class, 'themeUpdate'])->name('theme.update');


        Route::post('/updatepage', [PagesSettingController::class, 'updatePage'])->name('update.page');
        Route::post('/store-site-settings', [PagesSettingController::class, 'storeSiteSettings'])->name('store-site.settings');


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

        // uploads routes updatePage
        Route::get('/uploadsindex', [PagesSettingController::class, 'uploadsindex'])->name('uploads.index');
        Route::post('/saveuploads', [PagesSettingController::class, 'saveuploads'])->name('save.uploads');
        Route::get('/deleteuploads', [PagesSettingController::class, 'deleteuploads'])->name('delete.uploads');

        // setting routes
        Route::get('/settings', [PagesSettingController::class, 'settingsindex'])->name('settings.index');
        Route::post('/updatesettings', [PagesSettingController::class, 'updatesettings'])->name('update.settings');
    });
    Route::middleware('auth')->group(function () {
        // purchases routes
        Route::get('/purchases', [PagesSettingController::class, 'purchases'])->name('purchases.index');
    });

     
});

Route::get('/{product}', [SiteViewController::class, 'productDetail'])->name('product.detail');

