<?php

use App\Http\Controllers\Admin\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DeliveryAreaController;
use App\Http\Controllers\Admin\FooterInfoController;
use App\Http\Controllers\Admin\MenuBuilderController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\ProductOptionController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\WhyChooseUsController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){

    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    /** Profile routes */
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

     /** Slider Routes */
     Route::resource('slider', SliderController::class);
      /** Why choose us */
     Route::put('why-choose-title-update', [WhyChooseUsController::class, 'updateTitle'])->name('why-choose-title.update');
     Route::resource('why-choose-us', WhyChooseUsController::class);

     /** About Routes */
    Route::get('about', [AboutController::class, 'index'])->name('about.index');
    Route::put('about', [AboutController::class, 'update'])->name('about.update');

      /** Contact Routes */
      Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
      Route::put('contact', [ContactController::class, 'update'])->name('contact.update');

     /** Product Category Routes */
    Route::resource('category', CategoryController::class);

    /** Product Routes */
    Route::resource('product', ProductController::class);

    /** Product Gallery Routes */
    Route::get('product-gallery/{product}', [ProductGalleryController::class, 'index'])->name('product-gallery.show-index');
    Route::resource('product-gallery', ProductGalleryController::class);

    /** Product Size Routes */
    Route::get('product-size/{product}', [ProductSizeController::class, 'index'])->name('product-size.show-index');
    Route::resource('product-size', ProductSizeController::class);

    /** Product Option Routes */
    Route::resource('product-option', ProductOptionController::class);

    /** Delivery Area Routes */
    Route::resource('delivery-area', DeliveryAreaController::class);

    /** Footer Routes */
    Route::get('footer-info', [FooterInfoController::class, 'index'])->name('footer-info.index');
    Route::put('footer-info', [FooterInfoController::class, 'update'])->name('footer-info.update');


    /** Menu builder Routes */
    Route::get('menu-builder', [MenuBuilderController::class, 'index'])->name('menu-builder.index');

    /** Order Routes */
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

    Route::get('pending-orders', [OrderController::class, 'pendingOrderIndex'])->name('pending-orders');
    Route::get('inprocess-orders', [OrderController::class, 'inProcessOrderIndex'])->name('inprocess-orders');
    Route::get('delivered-orders', [OrderController::class, 'deliveredOrderIndex'])->name('delivered-orders');
    Route::get('declined-orders', [OrderController::class, 'declinedOrderIndex'])->name('declined-orders');

    Route::get('orders/status/{id}', [OrderController::class, 'getOrderStatus'])->name('orders.status');
    Route::put('orders/status-update/{id}', [OrderController::class, 'orderStatusUpdate'])->name('orders.status-update');

     /** Setting Routes */
     Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
     Route::put('/general-setting', [SettingController::class, 'UpdateGeneralSetting'])->name('general-setting.update');
     Route::put('/pusher-setting', [SettingController::class, 'UpdatePusherSetting'])->name('pusher-setting.update');
     Route::put('/mail-setting', [SettingController::class, 'UpdateMailSetting'])->name('mail-setting.update');
     Route::put('/logo-setting', [SettingController::class, 'UpdateLogoSetting'])->name('logo-setting.update');
     Route::put('/appearance-setting', [SettingController::class, 'UpdateAppearanceSetting'])->name('appearance-setting.update');
     Route::put('/seo-setting', [SettingController::class, 'UpdateSeoSetting'])->name('seo-setting.update');

});
