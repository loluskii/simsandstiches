<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\SubscribersController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest as NewRegistrationVerificationEmail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', [BaseController::class, 'index'])->name('home');
Route::get('/x', function () {
    return view('coming-soon');
})->name('coming-soon');
Route::post('currency_load', [CurrencyController::class, 'currencyLoad'])->name('currency.load');

Route::get('/wipe', function () {
	DB::table('order_items')->truncate();
	DB::table('orders')->truncate();
	DB::table('payments')->truncate();
});

// Route::get('update/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfillUpdateEmail();
//     return redirect('/');
// })->middleware(['auth', 'signed'])->name('verification.verify.update');

Route::middleware(['force_maintenance'])->group(function () {

    Route::middleware(['guest'])->group(function () {

        Route::get('/login', function () {
            return view('auth.login');
        })->name('login');

        Route::get('/register', function () {
            return view('auth.register');
        })->name('register');

        Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
        Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

        Route::get('/auth/new-password/{token?}', function (Request $request) {
            return view('auth.passwords.reset', ['token' => $request->token, 'email' => $request->email]);
        })->name('password.reset');

        Route::get('/reset-password', function () {
            return view('auth.passwords.email');
        })->name('password.request');

        Route::post('reset-password', [ForgotPasswordController::class, 'sendEmail'])->name('user.reset.password');

        Route::post('password-update', [ForgotPasswordController::class, 'updatePassword'])->name('user.password.update');
    });

    Route::middleware(['auth'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/email/verify/{id}/{hash}', function (NewRegistrationVerificationEmail $request) {
            $request->fulfill();
            return redirect('/');
        })->name('verification.verify');

        // Route::get('/email/verify', function () {
        //     return view('auth.verify');
        // })->name('verification.notice');

        Route::post('/email/verification-notification', function (Request $request) {
            $request->user()->sendEmailVerificationNotification();
            return back()->with('success', 'Verification link sent!');
        })->middleware(['throttle:6,1'])->name('verification.resend');

    });

    Route::get('/collections/all', [BaseController::class, 'viewShop'])->name('shop');
    Route::get('/collections/{category}', [BaseController::class, 'getCategory'])->name('shop.category');
    Route::get('/products/{slug}', [BaseController::class, 'viewProduct'])->name('shop.product.show');
    Route::get('/cart', [BaseController::class, 'viewCart'])->name('shop.cart');
    Route::post('/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/destroy/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    //Checkout Routes
    Route::post('/set-shipping', [PaymentController::class, 'setShipping'])->name('shipping.update');
    Route::post('/set-discount', [PaymentController::class, 'applyCoupon'])->name('shipping.discount');
    Route::get('/checkout/{session}', [PaymentController::class, 'checkout'])->name('checkout.page-1');
    Route::post('/checkout/store', [PaymentController::class, 'contactInformation'])->name('checkout.page-1.store');
    Route::get('/checkout/2/{session}', [PaymentController::class, 'shipping'])->name('checkout.page-2');
    Route::post('/checkout/2/store', [PaymentController::class, 'postShipping'])->name('checkout.page-2.store');
    Route::get('/checkout/3/{session}', [PaymentController::class, 'showPayment'])->name('checkout.page-3');
    Route::post('/checkout/3/store', [PaymentController::class, 'getPaymentMethod'])->name('checkout.page-3.store');
    Route::get('/orders/{reference}', [PaymentController::class, 'checkoutSuccessful'])->name('checkout.success');

    //Payment Routes
    Route::get('/payment/callback', [PaymentController::class, 'paystackHandleGatewayCallback'])->name('payment');

    //Flutterwave Checkout
    // Route::post('/pay', [PaymentController::class, 'flutterInit'])->name('pay.flutter');
    // Route::get('/rave/callback', [PaymentController::class,'flutterwaveCallback'])->name('flutter.callback');

    //User Routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::get('/user/order/{ref}', [UserController::class, 'show'])->name('user.order.show');
        Route::post('/user/update', [UserController::class, 'edit'])->name('user.edit.address');
    });

    Route::post('/subscriber/store', [SubscribersController::class, 'store'])->name('store.subscriber');

});

//CMS Routes
Route::get('/contact', function () {
    return view('cms.contact');
})->name('contact');

Route::get('/about', function () {
    return view('cms.about');
})->name('about');

Route::get('/return-policy', function () {
    return view('cms.returns');
})->name('returns');

Route::get('/shipping', function () {
    return view('cms.shipping');
})->name('shipping');

Route::get('/terms-and-conditions', function () {
    return view('cms.terms-and-conditions');
})->name('terms_conditions');

Route::get('/privacy-policy', function () {
    return view('cms.privacy-policy');
})->name('privacy_policy');

Route::get('/mailtest', function () {
    File::deleteDirectory(public_path('images/products'));
    // return view('mail.order-invoice');
})->name('mail');
