<?php

use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FacebookLoginController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Models\Gig;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('user.dashboard');
})->name('dashboard')->middleware(['auth', 'verified', 'user']);

Route::get('/home-dashboard', [HomeController::class, 'homeDashboard'])->name('home.dashboard');
Route::get('/home-dashboard-details/{gig}', function (Gig $gig) {
    return view('pages.dashboard-details', [
        'gig' => $gig
    ]);
})->name('home.dashboard.details');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search-cities', [HomeController::class, 'searchLocations'])->name('search.cities');
// Route::get('/search/locations', [HomeController::class, 'searchLocations'])->name('search.locations');
Route::get('/filter-gigs', [HomeController::class, 'filterGigs'])->name('filter.gigs');
Route::any('/filter-host', [HomeController::class, 'filterHost'])->name('filter.host');
Route::get('/get-selected-host', [HomeController::class, 'getSelectedHost'])->name('get.selectedhost');
Route::get('/get-host-{host_id}/profile', [HomeController::class, 'hostProfileById'])->name('get.host.profile');
Route::get('/search/gig/task', [HomeController::class, 'gigSearchedOnTask'])->name('home.task');

Route::get('/booking/gig-id-{gig_id}/detail', [HomeController::class, 'bookingDetailByGigId'])->name('booking.detail.byGigId');
Route::post('/store-booking', [HomeController::class, 'storeBooking'])->name('booking.store');

Route::get('check-out/{gig_id}/detail', [PaymentController::class, 'bookingCheckOutPage'])->name('user.booking.checkout');

Route::get('/get-states/{countryId}', [HomeController::class, 'getStates']);
Route::get('/get-cities/{stateId}', [HomeController::class, 'getCities']);
Route::get('/get-zips/{cityId}', [HomeController::class, 'getZips']);
Route::get('/get_equipment_prices', [HomeController::class, 'getEquipmentPrices'])->name('get_equipment_prices');
Route::get('/support',[TokenController::class,'support'])->name('ikoro.support');
Route::post('/support/store',[TokenController::class,'support_store'])->name('ikoro.support.store');
Route::get('/support/show/{id}',[TokenController::class,'support_show'])->name('ikoro.support.show');
Route::post('/user/reply/{id}',[TokenController::class,'user_reply'])->name('user.reply');
Route::get('/user/close_chat/{id}',[TokenController::class,'close_chat'])->name('user.close_chat');

Route::get('/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::controller(FacebookLoginController::class)->group(function(){
    Route::get('auth/facebook', 'redirectToFacebook')->name('auth.facebook');
    Route::get('auth/facebook/callback', 'handleFacebookCallback');
});

Route::get('about-us', function () {
    return view('pages.about-us');
})->name('aboutUs');
Route::get('privacy-policy', function () {
    return view('pages.privacy-policy');
})->name('privacyPolicy');
Route::get('FAQ', function () {
    return view('pages.faq');
})->name('FAQ');
Route::get('term-and-condition', function () {
    return view('pages.term-and-condition');
})->name('termAndCondition');
Route::get('cookie-policy', function () {
    return view('pages.cookie-policy');
})->name('cookiePolicy');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/host.php';
require __DIR__.'/user.php';
