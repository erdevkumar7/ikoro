<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\HostController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;

Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('admin/problems', [TokenController::class, 'admin_problems'])->name('admin.problems');
    Route::get('admin/support/view/{tokenid}', [TokenController::class, 'admin_support_view'])->name('admin.support.view');
    Route::post('admin/support/store/{tokenid}', [TokenController::class, 'admin_support_store'])->name('admin.support.store');
    Route::get('tasks', [TaskController::class, 'index'])->name('admin.tasks');
    Route::post('task/store', [TaskController::class, 'store'])->name('admin.task.store');
    Route::post('task/delete', [TaskController::class, 'destroy'])->name('admin.task.delete');

    Route::get('hosts', [HostController::class, 'index'])->name('admin.host');
    Route::get('hosts/add', [HostController::class, 'add'])->name('admin.host.add');
    Route::get('hosts/approved', [HostController::class, 'approved'])->name('admin.host.approved');
    Route::get('hosts/blocked', [HostController::class, 'blocked'])->name('admin.host.blocked');
    Route::post('host/store', [HostController::class, 'store'])->name('admin.host.store');
    Route::get('host/edit/{host}', [HostController::class, 'edit'])->name('admin.host.edit');
    Route::get('host/delete', [HostController::class, 'destroy'])->name('admin.host.delete');
    Route::get('host/status/{host}', [HostController::class, 'status'])->name('admin.host.status');
    Route::post('host/recommended_sequence/{host_id}', [HostController::class, 'setRecommendedSequence'])->name('admin.host.setRecommendedSequence');
    Route::get('host/wallet/{host_id}', [WalletController::class, 'hostWalletAdmin'])->name('admin.host.wallet');

    Route::post('transfer-to-host/{wallet_id}', [WalletController::class, 'transfertoHost'])->name('admin.host.transfer');

    Route::get('users', [UserController::class, 'index'])->name('admin.user');
    Route::get('users/delete', [UserController::class, 'destroy'])->name('admin.user.delete');

    Route::get('booking/list/{status?}', [BookingController::class, 'index'])->name('admin.booking.order');
    Route::get('booking/match/{booking_id}', [BookingController::class, 'match'])->name('admin.booking.match');
    Route::get('booking/action/{booking_id}/{host_id}', [BookingController::class, 'action'])->name('admin.booking.action');
    Route::post('booking/pricing/', [BookingController::class, 'savePricing'])->name('admin.booking.pricing');
    Route::get('new-bookings-cnt', [BookingController::class, 'newBookingsCnt'])->name('admin.new-bookings-cnt');

    Route::get('booking/payment/{booking_id}/', [BookingController::class, 'doingHostbookingPayment'])->name('admin.booking.payment');
    Route::get('booking-{booking_id}/details', [BookingController::class, 'adminBookingDetailByBookingId'])->name('admin.booking.byBookingId');
    Route::get('/booking/{booking_id}/invoice', [BookingController::class, 'adminDownloadInvoice'])->name('admin.booking.invoice.download');

    Route::get('booking/report-problem', function () {
        return view('admin.booking.problem');
    })->name('admin.booking.problem');

    Route::get('locations', [LocationController::class, 'index'])->name('admin.location');
    Route::post('location/storeCountry', [LocationController::class, 'storeCountry'])->name('admin.location.storeCountry');
    Route::post('location/storeState', [LocationController::class, 'storeState'])->name('admin.location.storeState');
    Route::post('location/storeCity', [LocationController::class, 'storeCity'])->name('admin.location.storeCity');
    Route::post('location/storeZipCode', [LocationController::class, 'storeZipCode'])->name('admin.location.storeZipCode');
    Route::get('locations/get_cities', [LocationController::class, 'getCities'])->name('admin.location.getcities');
    Route::get('locations/get_states', [LocationController::class, 'getStates'])->name('admin.location.getstates');
    Route::get('locations/get_zipcodes', [LocationController::class, 'getZipCodes'])->name('admin.location.getzipcodes');

    // Route::post('host/delete', [LocationController::class, 'destroy'])->name('admin.host.delete');


    Route::get('payments', [PaymentController::class, 'adminGetAllPayment'])->name('admin.payment');
    Route::get('/payment/trans-{payment_id}/details', [PaymentController::class, 'adminGetPaymenByPaymentId'])->name('admin.payment.ByPayId');

    Route::get('support', function () {
        return view('admin.support');
    })->name('admin.support');

    Route::get('support/host-details', function () {
        return view('admin.host.detail.index');
    })->name('admin.host.detail');

    Route::get('jon/pending', function () {
        return view('admin.job.pending');
    })->name('admin.job.pending');

    Route::get('job/completed', function () {
        return view('admin.job.completed');
    })->name('admin.job.completed');

    //ErDev
    Route::get('commission/add-update', [BankController::class, 'adminCommissionForm'])->name('admin.commission.form');
    Route::post('commission', [BankController::class, 'storeCommission'])->name('admin.storeCommission');
    Route::put('commission/{id}', [BankController::class, 'updateCommission'])->name('admin.updateCommission');
});
