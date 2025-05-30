<?php


use App\Http\Controllers\AboutController;
use App\Http\Controllers\admin\AccountManageController;
use App\Http\Controllers\admin\AccountSettingController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CategoryController;

use App\Http\Controllers\admin\CommissionController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\CurrencyController;
use App\Http\Controllers\admin\FaqController;

use App\Http\Controllers\admin\JoinCategoryController;
use App\Http\Controllers\admin\OrderManageController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\admin\PartnerController;
use App\Http\Controllers\admin\ProductController;

use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\admin\ServiceController;

use App\Http\Controllers\admin\SiteSettingController;
use App\Http\Controllers\admin\SliderController;

use App\Http\Controllers\admin\TermsAndConditionController;

use App\Http\Controllers\BlogSectionController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProductManageController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TermsConditionController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\user\CheckoutController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', [HomePageController::class, 'frontend'])->name('home');
Route::get('/how-to-use', [HomePageController::class, 'howToUse'])->name('how.to.use');
Route::get('/how-to-access', [HomePageController::class, 'howToAccess'])->name('how.to.access');
Route::get('/search', [HomePageController::class, 'search'])->name('search');

Route::get('/how-to-become-affiliate', [HomePageController::class, 'howToBecomeAffiliate'])->name('how.to.become.affiliate');

Route::get('/about', [AboutController::class, 'about'])->name('about');
Route::get('/blog', [BlogSectionController::class, 'blog'])->name('blog');
Route::get('/blog-details/{id}', [BlogSectionController::class, 'blogDetails'])->name('blog.details');
Route::get('/terms-condition', [TermsConditionController::class, 'termsAndCondition'])->name('terms.condition');

//Account Manage
Route::get('/account-registration-for-user', [AccountManageController::class, 'showRegistrationFormForUser'])->name('account.registration.for.user');
Route::get('/account-registration-for-agent', [AccountManageController::class, 'showRegistrationFormForAgent'])->name('account.registration.for.agent');


//product
Route::get('/products', [ProductManageController::class, 'products']);
Route::get('/product-details/{id}', [ProductManageController::class, 'productDetails']);

Route::post('/cart/add', [CartController::class, 'productAddToCart']);
Route::post('/cart/package/add', [CartController::class, 'packageAddToCart']);
Route::get('/cart', [CartController::class, 'showCart']);
Route::post('/cart/update', [CartController::class, 'updateCart']);
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon']);

Route::post('/account-registration', [AccountManageController::class, 'storeRegisterInfo'])->name('account.registration');
Route::get('/account-verify', [AccountManageController::class, 'showVerificationForm'])->name('account.verification');
Route::post('/account-verify-complete', [AccountManageController::class, 'verify'])->name('account.verify.complete');

//google login
Route::get('login/google', [GoogleLoginController::class, 'redirectToGoogle']);
Route::get('login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);


Route::middleware(['auth', 'account'])->group(callback: function () {

    Route::get('/report', [ReportController::class, 'index'])->name('report');

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/unauthorized-action', [AdminDashboardController::class, 'unauthorized'])->name('unauthorized.action');


    //Coupon Section
    Route::get('/coupon-section', [CouponController::class, 'index'])->name('coupon.section');
    Route::post('/coupon-store', [CouponController::class, 'store'])->name('coupon.store');
    Route::put('/coupon-update/{id}', [CouponController::class, 'update'])->name('coupon.update');
    Route::get('/coupon-delete/{id}', [CouponController::class, 'destroy'])->name('coupon.destroy');

    //Category Section
    Route::get('/category-section', [CategoryController::class, 'index'])->name('category.section');
    Route::post('/category-store', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category-update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category-delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');


    //Currency Section
    Route::get('/currency-section', [CurrencyController::class, 'index'])->name('currency.section');
    Route::post('/currency-store', [CurrencyController::class, 'store'])->name('currency.store');
    Route::put('/currency-update/{id}', [CurrencyController::class, 'update'])->name('currency.update');
    Route::get('/currency-delete/{id}', [CurrencyController::class, 'destroy'])->name('currency.destroy');

    //Faq Section
    Route::get('/faq-section', [FaqController::class, 'index'])->name('faq.section');
    Route::post('/faq-store', [FaqController::class, 'store'])->name('faq.store');
    Route::put('/faq-update/{id}', [FaqController::class, 'update'])->name('faq.update');
    Route::get('/faq-delete/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');


    //Slider Section
    Route::get('/slider-section', [SliderController::class, 'index'])->name('slider.section');
    Route::post('/slider-store', [SliderController::class, 'store'])->name('slider.store');
    Route::put('/slider-update/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::get('/slider-delete/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');



    //Partner Section
    Route::get('/partner-section', [PartnerController::class, 'index'])->name('partner.section');
    Route::post('/partner-store', [PartnerController::class, 'store'])->name('partner.store');
    Route::put('/partner-update/{id}', [PartnerController::class, 'update'])->name('partner.update');
    Route::get('/partner-delete/{id}', [PartnerController::class, 'destroy'])->name('partner.destroy');


    //Slider Section
    Route::get('/service-section', [ServiceController::class, 'index'])->name('service.section');
    Route::post('/service-store', [ServiceController::class, 'store'])->name('service.store');
    Route::put('/service-update/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::get('/service-delete/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');

    //Slider Section
    Route::get('/product-section', [ProductController::class, 'index'])->name('product.section');
    Route::post('/product-store', [ProductController::class, 'store'])->name('product.store');
    Route::put('/product-update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product-delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    //Package Section
    Route::get('/package-section', [PackageController::class, 'index'])->name('package.section');
    Route::post('/package-store', [PackageController::class, 'store'])->name('package.store');
    Route::put('/package-update/{id}', [PackageController::class, 'update'])->name('package.update');
    Route::get('/package-delete/{id}', [PackageController::class, 'destroy'])->name('package.destroy');

    //Blog Section
    Route::get('/blog-section', [BlogController::class, 'index'])->name('blog.section');
    Route::post('/blog-store', [BlogController::class, 'store'])->name('blog.store');
    Route::put('/blog-update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('/blog-delete/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');


    Route::get('/review-section', [ReviewController::class, 'index'])->name('review.section');
    Route::post('/review-store', [ReviewController::class, 'store'])->name('review.store');
    Route::put('/review-update/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::get('/review-delete/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');

    //Join Category Section
    Route::get('/join-category-section', [JoinCategoryController::class, 'index'])->name('join.category.section');
    Route::post('/join-category-store', [JoinCategoryController::class, 'store'])->name('join.category.store');
    Route::put('/join-category-update/{id}', [JoinCategoryController::class, 'update'])->name('join.category.update');
    Route::get('/join-category-delete/{id}', [JoinCategoryController::class, 'destroy'])->name('join.category.destroy');

    //Country Section
    Route::get('/country-section', [CountryController::class, 'index'])->name('country.section');
    Route::post('/country-store', [CountryController::class, 'store'])->name('country.store');
    Route::put('/country-update/{id}', [CountryController::class, 'update'])->name('country.update');
    Route::get('/country-delete/{id}', [CountryController::class, 'destroy'])->name('country.destroy');


    //Commission Section
    Route::get('/commission-section', [CommissionController::class, 'index'])->name('commission.section');
    Route::post('/commission-store', [CommissionController::class, 'store'])->name('commission.store');
    Route::put('/commission-update/{id}', [CommissionController::class, 'update'])->name('commission.update');
    Route::get('/commission-delete/{id}', [CommissionController::class, 'destroy'])->name('commission.destroy');

    //Role and User Section
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    //Site Setting
    Route::get('/site-setting', [SiteSettingController::class, 'index'])->name('site.setting');
    Route::post('/site-settings-store-update/{id?}', [SiteSettingController::class, 'createOrUpdate'])->name('site-settings.createOrUpdate');

    //Site About
    Route::get('/terms-and-condition', [TermsAndConditionController::class, 'index'])->name('admin.termsAndCondition');
    Route::post('/terms-and-condition-update/{id?}', [TermsAndConditionController::class, 'createOrUpdateTermsAndCondition'])->name('admin.termsAndCondition.createOrUpdate');

    Route::get('/checkout', [CheckoutController::class, 'showCheckoutPage'])->name('checkout');
    Route::post('/checkout/order', [CheckoutController::class, 'placeOrder'])->name('checkout.order');
    Route::get('/payment', [CheckoutController::class, 'payment'])->name('payment');


    //Order Section
    Route::get('/order-list', [OrderManageController::class, 'index'])->name('order.list');
    Route::get('/order-invoice/{id}', [OrderManageController::class, 'invoice'])->name('order.invoice');
    Route::get('/active-order-list', [OrderManageController::class, 'orderActive'])->name('order.active');

    Route::get('/user-list', [OrderManageController::class, 'userManageByAdmin'])->name('user.list');
    Route::get('/order-list-manage-by-admin/{id}', [OrderManageController::class, 'orderManageByAdmin'])->name('order.list.manage.by.admin');

    //Site Setting
    Route::get('/account-setting', [AccountSettingController::class, 'index'])->name('account.setting');
    Route::get('/my-active-subscription', [AccountSettingController::class, 'activeSubscription'])->name('active.subscription');
    Route::post('/account-settings-create-update/{id?}', [AccountSettingController::class, 'createOrUpdateAccount'])->name('account.settings.create.update');

    Route::get('/account-setting-agent', [AccountSettingController::class, 'agent'])->name('account.setting.agent');
    Route::post('/account-settings-create-update-agent/{id?}', [AccountSettingController::class, 'createOrUpdateAccountAgent'])->name('account.settings.create.update.agent');

    Route::get('/my-affiliate', [AccountManageController::class, 'myAffiliateUnderUser'])->name('my.affiliate');
    Route::get('/agent-under-user-report', [AccountManageController::class, 'agentUnderUserReport'])->name('agent.under.user.report');
    Route::get('/agent-under-user', [AccountManageController::class, 'agentUnderUser'])->name('agent.under.user');
    //User Manage
    Route::get('/active-user-list', [AdminDashboardController::class, 'activeUser'])->name('active.user');
    Route::post('/active-user-send-email/{id}', [AdminDashboardController::class, 'sendEmail'])->name('send.email');


    Route::put('/user-status-change/{id}', [AdminDashboardController::class, 'changeStatus'])->name('change.status');
    Route::get('/order-manage/{id}', [AdminDashboardController::class, 'manageOrder'])->name('order.manage');
    Route::get('/order-invoice-manage/{id}', [AdminDashboardController::class, 'invoiceManage'])->name('order.invoice.manage');
    Route::put('/user-info-update/{id}', [AdminDashboardController::class, 'userInfoUpdate'])->name('user.info.update');
    Route::post('/user-assign-tools/{id}', [AdminDashboardController::class, 'userAssignTools'])->name('user.assign.tools');
    Route::get('/inactive-user-list', [AdminDashboardController::class, 'inactiveUser'])->name('inactive.user');

    Route::get('/password/update', [AdminDashboardController::class, 'editPassword'])->name('password.edit');
    Route::post('/password/change', [AdminDashboardController::class, 'updatePassword'])->name('password.change');
});

require __DIR__.'/auth.php';
