<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\WishlistController;

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
  /** Admin Auth Routes */
  Route::group(['middleware' => 'guest'], function(){
  Route::get('admin/login', [AdminAuthController::class, 'index'])->name('admin.login');
  Route::get('admin/forget-password', [AdminAuthController::class, 'forgetPassword'])->name('admin.forget-password');
  });

  Route::group(['middleware' => 'auth'], function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
    Route::post('address', [DashboardController::class, 'createAddress'])->name('address.store');
    Route::put('address/{id}/edit', [DashboardController::class, 'updateAddress'])->name('address.update');
    Route::delete('address/{id}', [DashboardController::class, 'destroyAddress'])->name('address.destroy');

    // /** Chat Routes */
    // Route::post('chat/send-message', [ChatController::class, 'sendMessage'])->name('chat.send-message');
    // Route::get('chat/get-conversation/{senderId}',[ChatController::class, 'getConversation'])->name('chat.get-conversation');
});




//   Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
Route::get('/', [FrontendController::class, 'index'])->name('home');

/** About Routes */
Route::get('/about', [FrontendController::class, 'about'])->name('about');

/** Contact Routes */
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact.index');
Route::post('/contact', [FrontendController::class, 'sendContactMessage'])->name('contact.send-message');

/** Product page Route*/
// Route::get('/products', [FrontendController::class, 'products'])->name('product.index');

/** Show Product details page */
Route::get('/product/{slug}', [FrontendController::class, 'showProduct'])->name('product.show');

Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->middleware('auth', 'role:admin')->name('admin.dashboard');

/** Product Modal Route */
Route::get('/load-product-modal/{productId}', [FrontendController::class, 'loadProductModal'])->name('load-product-modal');

// Route::post('product-review', [FrontendController::class, 'productReviewStore'])->name('product-review.store');

/** Add to cart Route */
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('get-cart-products', [CartController::class, 'getCartProduct'])->name('get-cart-products');
Route::get('cart-product-remove/{rowId}', [CartController::class, 'cartProductRemove'])->name('cart-product-remove');


/** Wishlist Route */
Route::get('wishlist/{productId}', [WishlistController::class, 'store'])->name('wishlist.store');

/** Cart Page Routes */
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart-update-qty', [CartController::class, 'cartQtyUpdate'])->name('cart.quantity-update');
Route::get('/cart-destroy', [CartController::class, 'cartDestroy'])->name('cart.destroy');

/** Checkout Routes */
Route::group(['middleware' => 'auth'], function(){
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('checkout/{id}/delivery-cal', [CheckoutController::class, 'CalculateDeliveryCharge'])->name('checkout.delivery-cal');
    Route::post('checkout', [CheckoutController::class, 'checkoutRedirect'])->name('checkout.redirect');

    /** Payment Routes */
    Route::get('payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('make-payment', [PaymentController::class, 'makePayment'])->name('make-payment');
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
});
