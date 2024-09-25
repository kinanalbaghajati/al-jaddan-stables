<?php

use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\ContentController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Front\frontController;
use App\Http\Controllers\Backend\HorseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::get('/login', function () {
    return redirect()->route('login');
});
Route::fallback(function () {
    return view('404');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {

    Route::get('/', [frontController::class, 'index'])->name('front.index');
    Route::get('/{type}/all', [frontController::class, 'horsesIndex'])->name('front.horses.index');
    Route::get('/horse/details/{id}', [frontController::class, 'details'])->name('horse.details');
    Route::get('/contact-us', [frontController::class, 'contact'])->name('front.contact');

});


Route::get('/dashboard', function () {
//    $lang = session(['locale'=>'ar']);


//    App::setLocale($lang);
//    session()->put('locale', 'ar');

    return view('backend/index_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('contact/mail/send', [frontController::class, 'sendMail'])->name('contact.mail');

Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['permission:roles_tab'])->prefix('roles')->controller(RoleController::class)->group(function () {
        Route::get('role/index', 'index')->name('role.index');
        Route::get('/role/show/{id}', 'show')->name('roles.show');
        Route::post('/role/store', 'store')->name('roles.store');
        Route::get('/role/create', 'create')->name('roles.create');
        Route::get('/role/edit/{id}', 'edit')->name('roles.edit');
        Route::post('/role/update/{id}', 'update')->name('roles.update');
        Route::delete('/role/destroy/{id}', 'destroy')->name('roles.destroy');
    });


    Route::middleware(['permission:admin_tab'])->prefix('admins')->controller(UserController::class)->group(function () {
        Route::get('admins', 'index')->name('admins.index');
        Route::post('admins/store', 'store')->name('admins.store');
        Route::post('admins/update/{id}', 'update')->name('admins.update');
        Route::delete('admins/destroy/{id}', 'destroy')->name('admins.destroy');
    });

    Route::prefix('contents')->controller(ContentController::class)->group(function () {
        Route::get('content', 'index')->name('first.content.index')->middleware('permission:first_section');
        Route::post('content/update', 'update')->name('first.text.update');
        Route::post('content/update/image', 'updateImage')->name('first.image.update');

        Route::get('content/second', 'indexSecond')->name('second.content.index')->middleware('permission:second_section');
        Route::post('content/second/update', 'updateSecond')->name('second.text.update');
        Route::post('content/second/update/image', 'updateImageSecond')->name('second.image.update');

        Route::get('main-title', 'mainTitleIndex')->name('main.title.index')->middleware('permission:main_title');
        Route::post('main-title/update', 'mainTitleUpdate')->name('main.title.update');

    });

    Route::middleware(['role:Super|kinan'])->prefix('gallery')->controller(GalleryController::class)->group(function () {
        Route::get('content/gallery', 'index')->name('gallery.index')->middleware('permission:gallery');
        Route::post('content/gallery/upload/{id}', 'store')->name('gallery.upload.images');
        Route::delete('content/gallery/delete/{id}', 'destroy')->name('gallery.image.delete');
    });

    Route::middleware(['permission:horses'])->prefix('horses')->controller(HorseController::class)->group(function () {
        Route::get('horses/{type}/all', 'index')->name('horses.index');
        Route::get('horse/create', 'create')->name('horse.create')->middleware('permission:create_horse');
        Route::post('horse/store/', 'store')->name('horse.store');
        Route::get('horse/ancestors/{id}', 'ancestors')->name('horse.ancestors');
        Route::post('horse/store/ancestors', 'storeAncestors')->name('horse.store.ancestors');
        Route::get('horse/images/{id}', 'horseGallery')->name('horse.gallery');
        Route::post('horse/gallery/upload/{id}', 'storeImages')->name('horse.upload.images');
        Route::delete('horse/image/delete/{id}', 'destroy')->name('horse.image.delete');
        Route::get('horse/view/{id}', 'show')->name('horse.view');
        Route::post('horse/main-image/update', 'updateMainImage')->name('horse.update.main.image');
        Route::post('horse/cover-image/update', 'updateCoverImage')->name('horse.update.cover.image');
        Route::post('horse/info/update', 'updateInfo')->name('horse.update.info');
        Route::delete('horse/delete/{id}', 'destroyHorse')->name('horse.delete');
    });

    Route::middleware(['permission:contact_us'])->prefix('contact')->controller(ContactController::class)->group(function () {
        Route::get('contact/index', 'index')->name('contact.index');
        Route::post('contact/store', 'store')->name('contact.store');
        Route::delete('contact/delete/{id}', 'destroy')->name('contact.delete');
    });

});

require __DIR__ . '/auth.php';
