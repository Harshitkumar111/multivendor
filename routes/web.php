<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\BannerController;

use App\Http\Middleware\RedirectIfAuthenticated;
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
// Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', function () {
    return view('frontend.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile/store',[UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout',[UserController::class, 'userDestroy'])->name('user.logout');
    Route::post('/user/update/password',[UserController::class, 'UserUpdatepassword'])->name('user.update.password');

 
});


   
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// admin dashboard
Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard',[AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout',[AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/profile',[AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store',[AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password',[AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password',[AdminController::class, 'AdminUpdatepassword'])->name('update.password');

});

// vendor  dashboard
Route::middleware(['auth','role:vendor'])->group(function(){

    Route::get('/vendor/dashboard',[VendorController::class, 'vendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout',[VendorController::class, 'vendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/profile',[VendorController::class, 'VendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile/store',[VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');
    Route::get('/vendor/change/password',[VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/update/password',[VendorController::class, 'VendorUpdatepassword'])->name('vendor.update.password');

// Vendor Add Product All Route
    Route::controller(VendorProductController::class)->group(function(){
        Route::get('/vendor/all/product', 'VendorAllProduct')->name('vendor.all.product');
        Route::get('/vendor/add/product', 'vendoraddproduct')->name('vendor.add.product');
        Route::POST('/vendor/store/product', 'store')->name('vendor.store.product');
        Route::get('/vendor/edit/product/{id}', 'vendoreditproduct')->name('vendor.edit.product');
        Route::POST('/vendor/update/product/{id}', 'vendorupdateproduct')->name('vendor.update.product');
        Route::post('/vendor/update/product/thambnail/{id}', 'vendorupdateproductthambnail')->name('vendor.update.product.thambnail');
        Route::POST('/vendor/update/products/multi-img', 'vendorupdateproductmultiImage')->name('vendor.update.product.multiimage');
        Route::get('/vendor/products/multiimage/delete/{id}', 'vendorMultiImageDelete')->name('vendor.product.multiimage.delete');
        Route::get('/vendor/products/inactive/{id}', 'vendorproductinactive')->name('vendor.product.inactive');
        Route::get('/vendor/products/active/{id}', 'vendorproductactive')->name('vendor.product.active');
        Route::get('/vendor/delete/product/{id}', 'vendordeleteproduct')->name('vendor.delete.product');

    });


});

Route::get('/admin/login',[AdminController::class, 'AdminLoging'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/vendor/login',[VendorController::class, 'vendorLoging'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become/vendor',[VendorController::class, 'becomevendor'])->name('become.vendor');
Route::post('/register/vendor',[VendorController::class, 'registervendor'])->name('register.vendor');

Route::middleware(['auth','role:admin'])->group(function(){

    //  Brand All Route
    Route::controller(BrandController::class)->group(function(){
        Route::get('/all/brand', 'allBrand')->name('all.brand');
        Route::get('/add/brand', 'AddBrand')->name('add.brand');
        Route::post('/store/brand', 'StoreBrand')->name('brand.store');
        Route::get('/edit/brand/{id}', 'EditBrand')->name('edit.brand');
        Route::post('/update/brand/{id}', 'updateBrand')->name('update.brand');
        Route::get('/delete/brand/{id}', 'deleteBrand')->name('delete.brand');

    });

        // All Category Route
        Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/category', 'allcategory')->name('all.category');
        Route::get('/add/category', 'addcategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('category.store');
        Route::get('/edit/category/{id}', 'Editcategory')->name('edit.category');
        Route::post('/update/category/{id}', 'updatecategory')->name('update.category');
        Route::get('/delete/category/{id}', 'deletecategory')->name('delete.category');
    });

        // All SubCategory Route
        Route::controller(SubCategoryController::class)->group(function(){
        Route::get('/all/subcategory', 'allsubcategory')->name('all.subcategory');
        Route::get('/add/subcategory', 'addsubcategory')->name('add.subcategory');
        Route::post('/store/subcategory', 'StoresubCategory')->name('subcategory.store');
        Route::get('/edit/subcategory/{id}', 'Editsubcategory')->name('edit.subcategory');
        Route::post('/update/subcategory/{id}', 'updatesubcategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}', 'deletesubcategory')->name('delete.subcategory');
        // Route::get('/subcategory/ajax/{id}', 'GetSubCategory')->name('delete.subcategory');

    });


    Route::controller(AdminController::class)->group(function(){
        Route::get('/inactive/vendor', 'inactivevendor')->name('inactive.vendor');
        Route::get('/active/vendor', 'activevendor')->name('active.vendor');
        Route::get('/inactive/vendor/details/{id}', 'inactivevendordetails')->name('inactive.vendor.details');
        Route::post('/active/vendor/approve/{id}', 'activevendorapprove')->name('active.vendor.approve');
        Route::get('/active/vendor/details/{id}', 'activevendordetails')->name('active.vendor.details');
        Route::post('/inactive/vendor/approve/{id}', 'inactivevendorapprove')->name('inactive.vendor.approve');

    });

        // All Product Route
        Route::controller(ProductController::class)->group(function(){
        Route::get('/all/product', 'allproduct')->name('all.product');
        Route::get('/add/product', 'addproduct')->name('add.product');
        Route::post('/store/product', 'storeProduct')->name('store.product');
        Route::get('/edit/product/{id}', 'Editproduct')->name('edit.product');
        Route::post('/update/product/{id}', 'updateproduct')->name('update.product');
        Route::post('/update/product/thambnail/{id}', 'updateproductthambnail')->name('update.product.thambnail');
        Route::POST('/update/products/multi-img', 'updateproductmultiImage')->name('update.product.multiimage');
        Route::get('/products/multiimage/delete/{id}', 'MultiImageDelete')->name('product.multiimage.delete');
        Route::get('/products/inactive/{id}', 'productinactive')->name('product.inactive');
        Route::get('/products/active/{id}', 'productactive')->name('product.active');
        Route::get('/delete/product/{id}', 'deleteproduct')->name('delete.product');
    });

    // All Slider Route
    Route::controller(SliderController::class)->group(function(){
        Route::get('/all/slider', 'allslider')->name('all.slider');
        Route::get('/add/slider', 'addslider')->name('add.Slider');
        Route::post('/store/slider', 'StoreSlider')->name('store.slider');
        Route::get('/edit/slider/{id}', 'EditSlider')->name('edit.slider');
        Route::post('/update/slider/{id}', 'updateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}', 'deleteslider')->name('delete.slider');
    });

    // Banner Slider Route
    Route::controller(BannerController::class)->group(function(){
        Route::get('/all/banner', 'allbanner')->name('all.banner');
        Route::get('/add/banner', 'addbanner')->name('add.banner');
        Route::post('/store/banner', 'StoreBanner')->name('store.banner');
        Route::get('/edit/banner/{id}', 'Editbanner')->name('edit.banner');
        Route::post('/update/banner/{id}', 'updatebanner')->name('update.banner');
        Route::get('/delete/banner/{id}', 'deletebanner')->name('delete.banner');
    });
});