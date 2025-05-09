<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\StripPaymentController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'user'])->prefix('user')->group(function () {
    Route::get('dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('payments', function () {
        return view('user.payment.index');
    })->name('user.payment');

    Route::get('bookings', [BookingController::class, 'clientIndex'])->name('user.booking');
    Route::get('booking/action/{booking_id}/{host_id}', [BookingController::class, 'action'])->name('user.booking.action');
    Route::get('booking-{booking_id}/details', [BookingController::class, 'bookingDetailByBookingId'])->name('user.booking.byBookingId');
    Route::get('/booking/{booking_id}/invoice', [BookingController::class, 'downloadInvoice'])->name('booking.invoice.download');

    Route::post('pay', [PaymentController::class, 'redirectToGateway'])->name('pay');
    Route::get('payment/callback', [PaymentController::class, 'handleGatewayCallback'])->name('callback');;
    Route::get('wallet', [WalletController::class, 'index'])->name('user.wallet');

    Route::get('supports', function () {
        return view('user.support');
    })->name('user.support');

    Route::get('jobs/pending', function () {
        return view('user.job.pending');
    })->name('user.job.pending');

    Route::get('jobs/completed', function () {
        return view('user.job.completed');
    })->name('user.job.completed');
});


Route::middleware(['auth', 'verified', 'user'])->group(function () {
    Route::get('/strip/payment', [StripPaymentController::class, 'stripPaymentForm'])->name('user.strip.payment');
    Route::post('/strip/payment', [StripPaymentController::class, 'stripPaymentSubmit'])->name('user.strip.paymentSubmit');

    Route::post('/payment/create', [PayPalController::class, 'createPayment'])->name('payment.create');
    Route::get('/payment/execute', [PayPalController::class, 'executePayment'])->name('payment.execute');
    Route::get('/payment/cancel', [PayPalController::class, 'cancelPayment'])->name('payment.cancel');
});

Route::post('/store-booking-data', [BookingController::class, 'storeBookingData'])->name('store.booking.data');
Route::get('/get-matching-bookings', [BookingController::class, 'getMatchingBookings']);
