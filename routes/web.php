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
Route::get('/', [SiteViewController::class, 'index'])->name('index');
Route::get('/product-details', [SiteViewController::class, 'productdetails'])->name('product.details');
Route::get('/about', [SiteViewController::class, 'about'])->name('about');
Route::get('/contact', [SiteViewController::class, 'contact'])->name('contact');
Route::get('/shop', [SiteViewController::class, 'shop'])->name('shop');
Route::get('/products/{category}', [SiteViewController::class, 'getProductsByCategory'])->name('products.by.category');
Route::get('/blog', [SiteViewController::class, 'blog'])->name('blog');
Route::get('/cart', [SiteViewController::class, 'cart'])->name('cart');
Route::get('/remove-from-cart/{itemId}', [SiteViewController::class, 'removeFromCart'])->name('remove_from_cart');
Route::get('/checkout', [SiteViewController::class, 'checkout'])->name('checkout');
Route::get('/thankyou', [SiteViewController::class, 'thankyou'])->name('thankyou');
Route::get('/cartItemCount', [SiteViewController::class, 'getCartItemCount'])->name('cartcount');

// user details and profile settings 
Route::get('/user', [SiteViewController::class, 'user'])->name('user');
Route::get('/passwordreset', [SiteViewController::class, 'passwordreset']);




    // adminside controller
    Route::middleware('auth', 'checkUserRole')->group(function () {
        
        // dashboard
        Route::get('/dashboard', [PagesSettingController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

        //pages setting route
        Route::get('/home', [PagesSettingController::class, 'indexhome'])->name('indexhome');
        Route::get('/About', [PagesSettingController::class, 'about_edit'])->name('about.edit');
        Route::get('/Contact', [PagesSettingController::class, 'contact_edit'])->name('contact.edit');
        Route::put('/updatepagesettings', [PagesSettingController::class, 'updatehome'])->name('updatehome');
        Route::get('/homeedit', [PagesSettingController::class, 'homeedit'])->name('homeedit');
        Route::get('/footer', [PagesSettingController::class, 'footer'])->name('footer');
        Route::post('/footer', [PagesSettingController::class, 'update_footer'])->name('update.footer');

        Route::get('/products', [PagesSettingController::class, 'product'])->name('product.index');
        Route::get('/shopadmin', [PagesSettingController::class, 'shop'])->name('shop.index');
        Route::post('/shop', [PagesSettingController::class, 'update_component'])->name('update.shop');


        // edit manu
        Route::get('/navbar', [NavbarController::class, 'index'])->name('edit.manu');
        Route::put('/navbar/update/{id}', [NavbarController::class, 'update'])->name('navitems.update');
        // delete manu
        // Route::delete('/deletemanu', [PagesSettingController::class, 'deleteManu'])->name('delete.manu');
        

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

        // setting routes
        Route::get('/settings', [PagesSettingController::class, 'settingsindex'])->name('settings.index');
        Route::post('/updatesettings', [PagesSettingController::class, 'updatesettings'])->name('update.settings');
    });
    Route::middleware('auth')->group(function () {
        // purchases routes
        Route::get('/purchases', [PagesSettingController::class, 'purchases'])->name('purchases.index');
    });

    // Route::get('/{navrout}', [SiteViewController::class, 'dynamic'])->name('dynamic.route');
});


