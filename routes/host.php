<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\GigController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'host'])->prefix('host')->group(function () {
    Route::get('dashboard', function () {
        return view('host.dashboard');
    })->name('host.dashboard');

    Route::get('destination', function () {
        return view('host.destination.index');
    })->name('host.destination');

    Route::get('earning', function () {
        return view('host.earning.index');
    })->name('host.earning');

    Route::get('earning/host-details', function () {
        return view('host.earning.host-details');
    })->name('host.earning.hostdetails');

    Route::get('gigs/index/{status?}', [GigController::class, 'index'])->name('host.gig.index');
    Route::get('gig/addedit/{gig_id?}', [GigController::class, 'addedit'])->name('host.gig.addedit');
    Route::post('gig/store', [GigController::class, 'store'])->name('host.gig.store');   

    Route::post('gig/storeMedia/{gig_id?}', [GigController::class, 'storeMedia'])->name('host.gig.storeMedia');
    Route::GET('gig/deleteMedia/{gig_id}', [GigController::class, 'deleteMedia'])->name('host.gig.deleteMedia');


    
    Route::GET('gig/deleteMediaOffer/{gig_id}', [GigController::class, 'deleteMediaOffer'])->name('host.gig.deleteMediaOffer');
    //28 apr 25
    
    Route::get('contract/booking', [BookingController::class, 'hostIndex'])->name('host.contract.booking');
    Route::get('contract/booking/action/{booking_id}/{host_id}', [BookingController::class, 'action'])->name('host.booking.action');
    Route::get('booking-{booking_id}/details', [BookingController::class, 'hostBookingDetailByBookingId'])->name('host.booking.byBookingId');
    Route::get('/booking/{booking_id}/invoice', [BookingController::class, 'hostDownloadInvoice'])->name('host.booking.invoice.download');
    
    Route::get('wallet', [WalletController::class, 'hostWallet'])->name('host.wallet');

    Route::get('contract/task', function () {
        return view('host.contract.task');
    })->name('host.contract.task');


    Route::get('profile', [ProfileController::class, 'host_profile'])->name('host.profile');
    Route::post('profile/update', [ProfileController::class, 'host_profile_update'])->name('host.profile.update');

    Route::get('bank/add-edit', [BankController::class, 'host_addEditBank'])->name('host.addEditBank');
    Route::post('bank/store', [BankController::class, 'host_saveBankDetail'])->name('host.save.bank');

});