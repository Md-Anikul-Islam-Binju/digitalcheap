<?php

use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\AccountManageController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CounterController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\CurrencyController;
use App\Http\Controllers\admin\FaqController;
use App\Http\Controllers\admin\LabSetupController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\NoticeBoardController;
use App\Http\Controllers\admin\ObjectOfProjectController;
use App\Http\Controllers\admin\OttController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProjectCategoryController;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\ProjectFileCategoryController;
use App\Http\Controllers\admin\ProjectFileController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\ShowcaseController;
use App\Http\Controllers\admin\SiteSettingController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\TeamController;
use App\Http\Controllers\admin\TermsAndConditionController;
use App\Http\Controllers\admin\TrainingCategoryController;
use App\Http\Controllers\admin\TrainingController;
use App\Http\Controllers\admin\UserMessageController;
use App\Http\Controllers\admin\VenueController;
use App\Http\Controllers\frontend\AboutPageController;
use App\Http\Controllers\frontend\ContactUsController;
use App\Http\Controllers\frontend\HomePageController;
use App\Http\Controllers\frontend\NewsPageController;
use App\Http\Controllers\frontend\NoticeController;
use App\Http\Controllers\frontend\ProjectPageController;
use App\Http\Controllers\frontend\TeamMemberController;
use App\Http\Controllers\frontend\TrainingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
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

Route::get('/', function () {
    return view('welcome');
});
//Account Manage
Route::get('/account-registration-for-user', [AccountManageController::class, 'showRegistrationFormForUser'])->name('account.registration.for.user');
Route::get('/account-registration-for-agent', [AccountManageController::class, 'showRegistrationFormForAgent'])->name('account.registration.for.agent');



Route::post('/account-registration', [AccountManageController::class, 'storeRegisterInfo'])->name('account.registration');
Route::get('/account-verify', [AccountManageController::class, 'showVerificationForm'])->name('account.verification');
Route::post('/account-verify-complete', [AccountManageController::class, 'verify'])->name('account.verify.complete');


Route::middleware(['auth', 'account'])->group(callback: function () {
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


    //Role and User Section
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    //Site Setting
    Route::get('/site-setting', [SiteSettingController::class, 'index'])->name('site.setting');
    Route::post('/site-settings-store-update/{id?}', [SiteSettingController::class, 'createOrUpdate'])->name('site-settings.createOrUpdate');

    //Site About
    Route::get('/terms-and-condition', [TermsAndConditionController::class, 'index'])->name('admin.termsAndCondition');
    Route::post('/terms-and-condition-update/{id?}', [TermsAndConditionController::class, 'createOrUpdateTermsAndCondition'])->name('admin.termsAndCondition.createOrUpdate');

});

require __DIR__.'/auth.php';
