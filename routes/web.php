<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('lang/change', [App\Http\Controllers\LangController::class, 'change'])->name('changeLang');

Route::middleware(['permission:users,user.list'])->group(function () {

    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
});
Route::middleware(['permission:users,user.edit'])->group(function () {

    Route::get('/users/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
});

Route::get('/users/profile', [App\Http\Controllers\UserController::class, 'profile'])->name('users.profile');

Route::post('/users/profile/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('users.profile.update');

Route::middleware(['permission:users,user.view'])->group(function () {
    Route::get('/users/view/{id}', [App\Http\Controllers\UserController::class, 'view'])->name('users.view');
});

Route::middleware(['permission:drivers,driver.list'])->group(function () {

    Route::get('/drivers', [App\Http\Controllers\DriverController::class, 'index'])->name('drivers');
});
Route::middleware(['permission:approve_drivers,approve.driver.list'])->group(function () {

    Route::get('/drivers/approved', [App\Http\Controllers\DriverController::class, 'index'])->name('drivers.approved');
});
Route::middleware(['permission:pending_drivers,pending.driver.list'])->group(function () {

    Route::get('/drivers/pending', [App\Http\Controllers\DriverController::class, 'index'])->name('drivers.pending');
});
Route::middleware(['permission:drivers,driver.edit'])->group(function () {

    Route::get('/drivers/edit/{id}', [App\Http\Controllers\DriverController::class, 'edit'])->name('drivers.edit');
});
Route::middleware(['permission:drivers,driver.view'])->group(function () {

    Route::get('/drivers/view/{id}', [App\Http\Controllers\DriverController::class, 'view'])->name('drivers.view');
});

Route::middleware(['permission:drivers-document,driver.document.list'])->group(function () {

    Route::get('/drivers/document/{id}', [App\Http\Controllers\DriverController::class, 'driverDocuments'])->name('drivers.document');
});

Route::middleware(['permission:drivers-document,driver.document.edit'])->group(function () {

    Route::get('/drivers/document/upload/{driverId}/{id}', [App\Http\Controllers\DriverController::class, 'driverDocumentUpload'])->name('drivers.document.upload');
});

Route::middleware(['permission:tax,tax.list'])->group(function () {

    Route::get('/tax', [App\Http\Controllers\TaxController::class, 'index'])->name('tax');
});
Route::middleware(['permission:tax,tax.edit'])->group(function () {

    Route::get('/tax/edit/{id}', [App\Http\Controllers\TaxController::class, 'edit'])->name('tax.edit');
});
Route::middleware(['permission:tax,tax.create'])->group(function () {

    Route::get('/tax/create', [App\Http\Controllers\TaxController::class, 'create'])->name('tax.create');
});
Route::middleware(['permission:service,service.list'])->group(function () {

    Route::get('/services', [App\Http\Controllers\ServiceController::class, 'index'])->name('services');
});
Route::middleware(['permission:service,service.edit'])->group(function () {

    Route::get('/services/edit/{id}', [App\Http\Controllers\ServiceController::class, 'edit'])->name('services.edit');
});
Route::middleware(['permission:service,service.create'])->group(function () {

    Route::get('/services/create', [App\Http\Controllers\ServiceController::class, 'create'])->name('services.create');
});

Route::middleware(['permission:coupon,coupon.list'])->group(function () {

    Route::get('/coupons', [App\Http\Controllers\CouponController::class, 'index'])->name('coupons');
});
Route::middleware(['permission:deleted-coupon,coupon.delete.list'])->group(function () {

    Route::get('/coupons/deleted', [App\Http\Controllers\CouponController::class, 'deletedIndex'])->name('coupons.deleted.index');
});

Route::middleware(['permission:coupon,coupon.' . ((str_contains($_SERVER['REQUEST_URI'], 'save/')) ? ((explode("save/", $_SERVER['REQUEST_URI'])[1]) == 0 ? "create" : "edit") : $_SERVER['REQUEST_URI'])])->group(function () {

    Route::get('/coupons/save/{id}', [App\Http\Controllers\CouponController::class, 'save'])->name('coupons.save');
});

Route::middleware(['permission:currency,currency.list'])->group(function () {

    Route::get('/currency', [App\Http\Controllers\CurrencyController::class, 'index'])->name('currency');
});
Route::middleware(['permission:currency,currency.edit'])->group(function () {

    Route::get('/currency/edit/{id}', [App\Http\Controllers\CurrencyController::class, 'edit'])->name('currency.edit');
});
Route::middleware(['permission:currency,currency.create'])->group(function () {

    Route::get('/currency/create', [App\Http\Controllers\CurrencyController::class, 'create'])->name('currency.create');
});

Route::middleware(['permission:vehicle-type,vehicle.type.list'])->group(function () {

    Route::get('/vehicle-type', [App\Http\Controllers\VehicleTypeController::class, 'index'])->name('vehicle-type');
});
Route::middleware(['permission:vehicle-type,vehicle.type.edit'])->group(function () {

    Route::get('/vehicle-type/edit/{id}', [App\Http\Controllers\VehicleTypeController::class, 'edit'])->name('vehicle-type.edit');
});
Route::middleware(['permission:vehicle-type,vehicle.type.create'])->group(function () {

    Route::get('/vehicle-type/create', [App\Http\Controllers\VehicleTypeController::class, 'create'])->name('vehicle-type.create');
});

Route::middleware(['permission:documents,document.list'])->group(function () {

    Route::get('/documents', [App\Http\Controllers\DocumentsController::class, 'index'])->name('documents');
});
Route::middleware(['permission:deleted-documents,document.deleted'])->group(function () {


    Route::get('/documents/deleted', [App\Http\Controllers\DocumentsController::class, 'deletedIndex'])->name('documents.deleted');
});
Route::middleware(['permission:documents,document.' . ((str_contains($_SERVER['REQUEST_URI'], 'save/')) ? ((explode("save/", $_SERVER['REQUEST_URI'])[1]) == 0 ? "create" : "edit") : $_SERVER['REQUEST_URI'])])->group(function () {

    Route::get('/documents/save/{id}', [App\Http\Controllers\DocumentsController::class, 'save'])->name('documents.save');
});

Route::middleware(['permission:ride_order,order.list'])->group(function () {

    Route::get('/rides', [App\Http\Controllers\RidesController::class, 'index'])->name('rides');
});
Route::middleware(['permission:ride_order,order.view'])->group(function () {

    Route::get('/rides/show/{id}', [App\Http\Controllers\RidesController::class, 'show'])->name('rides.show');
});

Route::middleware(['permission:intercity_service,intercity.service.list'])->group(function () {

    Route::get('/intercity-service', [App\Http\Controllers\IntercityServiceController::class, 'index'])->name('intercity-service');
});
Route::middleware(['permission:intercity_service,intercity.service.edit'])->group(function () {

    Route::get('/intercity-service/edit/{id}', [App\Http\Controllers\IntercityServiceController::class, 'edit'])->name('intercity-service.edit');
});

Route::middleware(['permission:intercity_order,intercity.order.list'])->group(function () {

    Route::get('/intercity-service-rides', [App\Http\Controllers\IntercityServiceController::class, 'ridesList'])->name('intercity-service-rides');
});
Route::middleware(['permission:intercity_order,intercity.order.view'])->group(function () {

    Route::get('/intercity-service-rides/view/{id}', [App\Http\Controllers\IntercityServiceController::class, 'rideView'])->name('intercity-service-rides.view');
});
Route::middleware(['permission:banners,banners.list'])->group(function () {

    Route::get('/banners', [App\Http\Controllers\BannerController::class, 'index'])->name('banners');
});
Route::middleware(['permission:deleted-banner,banner.delete.list'])->group(function () {

    Route::get('/banners/deleted', [App\Http\Controllers\BannerController::class, 'deletedIndex'])->name('banners.deleted.index');
});
Route::middleware(['permission:banners,banners.' . ((str_contains($_SERVER['REQUEST_URI'], 'save/')) ? ((explode("save/", $_SERVER['REQUEST_URI'])[1]) == 0 ? "create" : "edit") : $_SERVER['REQUEST_URI'])])->group(function () {

    Route::get('/banners/save/{id}', [App\Http\Controllers\BannerController::class, 'save'])->name('banners.save');
});
Route::middleware(['permission:reports,' . ((str_contains($_SERVER['REQUEST_URI'], 'reports/')) ? explode("reports/", $_SERVER['REQUEST_URI'])[1] : $_SERVER['REQUEST_URI']) . '.report'])->group(function () {

    Route::get('/reports/{type}', [App\Http\Controllers\ReportController::class, 'reportGenerate'])->name('reports');
});

Route::middleware(['permission:cms,cms.list'])->group(function () {

    Route::get('cms', [App\Http\Controllers\CmsController::class, 'index'])->name('cms');
});
Route::middleware(['permission:cms,cms.edit'])->group(function () {

    Route::get('/cms/edit/{id}', [App\Http\Controllers\CmsController::class, 'edit'])->name('cms.edit');
});
Route::middleware(['permission:cms,cms.create'])->group(function () {

    Route::get('/cms/create', [App\Http\Controllers\CmsController::class, 'create'])->name('cms.create');
});

Route::middleware(['permission:driver-rules,rule.list'])->group(function () {

    Route::get('/driver-rules', [App\Http\Controllers\DriverController::class, 'rulesIndex'])->name('driver-rules');
});
Route::middleware(['permission:deleted-driver-rules,rule.delete.list'])->group(function () {

    Route::get('/driver-rules/deleted', [App\Http\Controllers\DriverController::class, 'deletedRulesIndex'])->name('driver-rules.deleted.index');
});
Route::middleware(['permission:driver-rules,rule.' . ((str_contains($_SERVER['REQUEST_URI'], 'save/')) ? ((explode("save/", $_SERVER['REQUEST_URI'])[1]) == 0 ? "create" : "edit") : $_SERVER['REQUEST_URI'])])->group(function () {

    Route::get('/driver-rules/save/{id}', [App\Http\Controllers\DriverController::class, 'saveRule'])->name('driver-rules.save');
});
Route::middleware(['permission:on-board,onboard.list'])->group(function () {

    Route::get('/on-board', [App\Http\Controllers\OnBoardController::class, 'index'])->name('on-board');
});

Route::middleware(['permission:on-board,onboard.edit'])->group(function () {

    Route::get('/on-board/save/{id}', [App\Http\Controllers\OnBoardController::class, 'show'])->name('on-board.save');
});
Route::middleware(['permission:payout-request,payout-request'])->group(function () {

    Route::get('/payoutRequest', [App\Http\Controllers\PayoutRequestController::class, 'index'])->name('payoutRequest.index');
});
Route::middleware(['permission:users-wallet-transaction,user.wallet.list'])->group(function () {

    Route::get('/walletTransaction/user', [App\Http\Controllers\TransactionController::class, 'userWalletTransaction'])->name('walletTransaction.user');
});

Route::middleware(['permission:drivers-wallet-transaction,driver.wallet.list'])->group(function () {

    Route::get('/walletTransaction/driver', [App\Http\Controllers\TransactionController::class, 'driverWalletTranscation'])->name('walletTransaction.driver');
});

Route::middleware(['permission:faq,faq.list'])->group(function () {

    Route::get('/faq', [App\Http\Controllers\FAQController::class, 'index'])->name('faq');
});
Route::middleware(['permission:faq,faq.' . ((str_contains($_SERVER['REQUEST_URI'], 'save')) ? (explode("save", $_SERVER['REQUEST_URI'])[1] ? "edit" : "create") : $_SERVER['REQUEST_URI'])])->group(function () {

    Route::get('/faq/save/{id?}', [App\Http\Controllers\FAQController::class, 'save'])->name('faq.save');
});

Route::post('send-notification', [App\Http\Controllers\NotificationController::class, 'sendNotification'])->name('send-notification');

Route::middleware(['permission:sos,sos.list'])->group(function () {

    Route::get('sos', [App\Http\Controllers\SosController::class, 'sos'])->name('sos');
});
Route::middleware(['permission:sos,sos.edit'])->group(function () {

    Route::get('sos/edit/{id}', [App\Http\Controllers\SosController::class, 'sosEdit'])->name('sos.edit');
});

Route::prefix('settings')->group(function () {
    Route::middleware(['permission:global-setting,global-setting'])->group(function () {

        Route::get('globals', [App\Http\Controllers\SettingsController::class, 'globals'])->name('settings.globals');
    });
    Route::middleware(['permission:admin-commission,admin-commision'])->group(function () {

        Route::get('adminCommission', [App\Http\Controllers\SettingsController::class, 'adminCommission'])->name('settings.adminCommission');
    });

    Route::middleware(['permission:payment-method,payment-method'])->group(function () {

        Route::get('payments/stripe', [App\Http\Controllers\SettingsController::class, 'stripe'])->name('settings.payments.stripe');
        Route::get('payments/applepay', [App\Http\Controllers\SettingsController::class, 'applepay'])->name('settings.payments.applepay');
        Route::get('payments/razorpay', [App\Http\Controllers\SettingsController::class, 'razorpay'])->name('settings.payments.razorpay');
        Route::get('payments/cod', [App\Http\Controllers\SettingsController::class, 'cod'])->name('settings.payments.cod');
        Route::get('payments/paypal', [App\Http\Controllers\SettingsController::class, 'paypal'])->name('settings.payments.paypal');
        Route::get('payments/paytm', [App\Http\Controllers\SettingsController::class, 'paytm'])->name('settings.payments.paytm');
        Route::get('payments/wallet', [App\Http\Controllers\SettingsController::class, 'wallet'])->name('settings.payments.wallet');
        Route::get('payments/payfast', [App\Http\Controllers\SettingsController::class, 'payfast'])->name('settings.payments.payfast');
        Route::get('payments/paystack', [App\Http\Controllers\SettingsController::class, 'paystack'])->name('settings.payments.paystack');
        Route::get('payments/flutterwave', [App\Http\Controllers\SettingsController::class, 'flutterwave'])->name('settings.payments.flutterwave');
        Route::get('payments/mercadopago', [App\Http\Controllers\SettingsController::class, 'mercadopago'])->name('settings.payments.mercadopago');
    });

    Route::middleware(['permission:homepageTemplate,home-page'])->group(function () {

        Route::get('/landingPageTemplate', [App\Http\Controllers\SettingsController::class, 'landingPageTemplate'])->name('settings.landingPageTemplate');

    });
    Route::middleware(['permission:header-template,header'])->group(function () {

        Route::get('/headerTemplate', [App\Http\Controllers\SettingsController::class, 'headerTemplate'])->name('settings.headerTemplate');
    });
    Route::middleware(['permission:footer-template,footer'])->group(function () {

        Route::get('/footerTemplate', [App\Http\Controllers\SettingsController::class, 'footerTemplate'])->name('settings.footerTemplate');
    });
    Route::middleware(['permission:privacy,privacy'])->group(function () {

        Route::get('/privacyPolicy', [App\Http\Controllers\SettingsController::class, 'privacyPolicy'])->name('settings.privacyPolicy');
    });
    Route::middleware(['permission:terms,terms'])->group(function () {

        Route::get('/termsAndConditions', [App\Http\Controllers\SettingsController::class, 'termsAndConditions'])->name('settings.termsAndConditions');
    });

    Route::middleware(['permission:language,language.list'])->group(function () {

        Route::get('/languages', [App\Http\Controllers\SettingsController::class, 'languages'])->name('settings.languages');
    });
    Route::middleware(['permission:language,language.' . ((str_contains($_SERVER['REQUEST_URI'], 'save')) ? (explode("save", $_SERVER['REQUEST_URI'])[1] ? "edit" : "create") : $_SERVER['REQUEST_URI'])])->group(function () {


        Route::get('/languages/save/{id?}', [App\Http\Controllers\SettingsController::class, 'saveLanguage'])->name('settings.languages.save');
    });

    Route::middleware(['permission:deleted-language,language.delete.list'])->group(function () {

        Route::get('/languages/deleted', [App\Http\Controllers\SettingsController::class, 'deletedLang'])->name('settings.languages.deleted');
    });
});

Route::middleware(['permission:god-eye,map'])->group(function () {

    Route::get('/map', [App\Http\Controllers\MapController::class, 'index'])->name('map');
    Route::post('/map/get_ride_info', [App\Http\Controllers\MapController::class, 'getRideInfo'])->name('map.getrideinfo');
});
Route::middleware(['permission:freight,freight.list'])->group(function () {

    Route::get('/freight-vehicles', [App\Http\Controllers\FreightVehicleController::class, 'index'])->name('freight-vehicle');
});

Route::middleware(['permission:freight,freight.' . ((str_contains($_SERVER['REQUEST_URI'], 'save')) ? (explode("save", $_SERVER['REQUEST_URI'])[1] ? "edit" : "create") : $_SERVER['REQUEST_URI'])])->group(function () {

    Route::get('/freight-vehicles/save/{id?}', [App\Http\Controllers\FreightVehicleController::class, 'save'])->name('freight-vehicles.save');
});
Route::middleware(['permission:airports,airports.list'])->group(function () {

    Route::get('/airports', [App\Http\Controllers\AirportsController::class, 'index'])->name('airports');
});
Route::middleware(['permission:airports,airports.' . ((str_contains($_SERVER['REQUEST_URI'], 'save')) ? (explode("save", $_SERVER['REQUEST_URI'])[1] ? "edit" : "create") : $_SERVER['REQUEST_URI'])])->group(function () {

    Route::get('/airports/save/{id?}', [App\Http\Controllers\AirportsController::class, 'save'])->name('airport.save');
});
Route::middleware(['permission:admins,admin.list'])->group(function () {

    Route::get('admin-users', [App\Http\Controllers\AdminUsersController::class, 'index'])->name('admin.users.index');
});
Route::middleware(['permission:admins,admin.create'])->group(function () {

    Route::get('admin-users/create', [App\Http\Controllers\AdminUsersController::class, 'create'])->name('admin.users.create');
});

Route::middleware(['permission:admins,admin.store'])->group(function () {

    Route::post('admin-users/store', [App\Http\Controllers\AdminUsersController::class, 'store'])->name('admin.users.store');
});
Route::middleware(['permission:admins,admin.edit'])->group(function () {

    Route::get('admin-users/edit/{id}', [App\Http\Controllers\AdminUsersController::class, 'edit'])->name('admin.users.edit');
});
Route::middleware(['permission:admins,admin.update'])->group(function () {

    Route::post('admin-users/update/{id}', [App\Http\Controllers\AdminUsersController::class, 'update'])->name('admin.users.update');
});
Route::middleware(['permission:admins,admin.delete'])->group(function () {

    Route::get('admin-users/delete/{userid}', [App\Http\Controllers\AdminUsersController::class, 'delete'])->name('admin.users.delete');
});

Route::middleware(['permission:roles,roles.list'])->group(function () {

    Route::get('role', [App\Http\Controllers\RolesController::class, 'index'])->name('role.index');
});
Route::middleware(['permission:roles,roles.create'])->group(function () {

    Route::get('role/create', [App\Http\Controllers\RolesController::class, 'create'])->name('role.create');
});
Route::middleware(['permission:roles,roles.store'])->group(function () {

    Route::post('role/store', [App\Http\Controllers\RolesController::class, 'store'])->name('role.store');
});
Route::middleware(['permission:roles,roles.edit'])->group(function () {

    Route::get('role/edit/{id}', [App\Http\Controllers\RolesController::class, 'edit'])->name('role.edit');
});
Route::middleware(['permission:roles,roles.update'])->group(function () {

    Route::post('role/update/{id}', [App\Http\Controllers\RolesController::class, 'update'])->name('role.update');
});
Route::middleware(['permission:roles,roles.delete'])->group(function () {

    Route::get('role/delete/{userid}', [App\Http\Controllers\RolesController::class, 'delete'])->name('role.delete');
});

//API Url for app
Route::post('payments/getpaytmchecksum', [App\Http\Controllers\PaymentController::class, 'getPaytmChecksum']);
Route::post('payments/validatechecksum', [App\Http\Controllers\PaymentController::class, 'validateChecksum']);
Route::post('payments/initiatepaytmpayment', [App\Http\Controllers\PaymentController::class, 'initiatePaytmPayment']);
Route::get('payments/paytmpaymentcallback', [App\Http\Controllers\PaymentController::class, 'paytmPaymentcallback']);
Route::post('payments/paypalclientid', [App\Http\Controllers\PaymentController::class, 'getPaypalClienttoken']);
Route::post('payments/paypaltransaction', [App\Http\Controllers\PaymentController::class, 'createBraintreePayment']);
Route::post('payments/stripepaymentintent', [App\Http\Controllers\PaymentController::class, 'createStripePaymentIntent']);
Route::get('payment/success', [App\Http\Controllers\PaymentController::class, 'paymentsuccess'])->name('payment.success');
Route::get('payment/failed', [App\Http\Controllers\PaymentController::class, 'paymentfailed'])->name('payment.failed');
Route::get('payment/pending', [App\Http\Controllers\PaymentController::class, 'paymentpending'])->name('payment.pending');