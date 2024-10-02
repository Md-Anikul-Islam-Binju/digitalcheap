<?php

use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\CounterController;
use App\Http\Controllers\admin\LabSetupController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\NoticeBoardController;
use App\Http\Controllers\admin\ObjectOfProjectController;
use App\Http\Controllers\admin\OttController;
use App\Http\Controllers\admin\ProjectCategoryController;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\ProjectFileCategoryController;
use App\Http\Controllers\admin\ProjectFileController;
use App\Http\Controllers\admin\ShowcaseController;
use App\Http\Controllers\admin\SiteSettingController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\TeamController;
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


Route::middleware('auth')->group(callback: function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/unauthorized-action', [AdminDashboardController::class, 'unauthorized'])->name('unauthorized.action');
    //News Section
    Route::get('/news-section', [NewsController::class, 'index'])->name('news.section');
    Route::post('/news-store', [NewsController::class, 'store'])->name('news.store');
    Route::put('/news-update/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::get('/news-delete/{id}', [NewsController::class, 'destroy'])->name('news.destroy');





    //Team Section
    Route::get('/team-section', [TeamController::class, 'index'])->name('team.section');
    Route::post('/team-store', [TeamController::class, 'store'])->name('team.store');
    Route::put('/team-update/{id}', [TeamController::class, 'update'])->name('team.update');
    Route::get('/team-delete/{id}', [TeamController::class, 'destroy'])->name('team.destroy');

    //About Section
    Route::get('/about-section', [AboutController::class, 'index'])->name('about.section');
    Route::post('/about-store', [AboutController::class, 'store'])->name('about.store');
    Route::put('/about-update/{id}', [AboutController::class, 'update'])->name('about.update');
    Route::get('/about-delete/{id}', [AboutController::class, 'destroy'])->name('about.destroy');


    //Slider Section
    Route::get('/slider-section', [SliderController::class, 'index'])->name('slider.section');
    Route::post('/slider-store', [SliderController::class, 'store'])->name('slider.store');
    Route::put('/slider-update/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::get('/slider-delete/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');

    //Role and User Section
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    //Site Setting
    Route::get('/site-setting', [SiteSettingController::class, 'index'])->name('site.setting');
    Route::post('/site-settings-store-update/{id?}', [SiteSettingController::class, 'createOrUpdate'])->name('site-settings.createOrUpdate');

});

require __DIR__.'/auth.php';
